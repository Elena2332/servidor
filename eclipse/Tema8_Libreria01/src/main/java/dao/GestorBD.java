/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import java.sql.Connection;
import java.sql.Date;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.LinkedHashMap;
import java.util.logging.Level;
import java.util.logging.Logger;

import org.apache.tomcat.dbcp.dbcp2.BasicDataSource;

import beans.Autor;
import beans.Libro;
import beans.LibroPrestado;

/**
 *
 * @author Amaia
 */
public class GestorBD {
    private static final String DRIVER = "com.mysql.cj.jdbc.Driver";
    private static final String URL = "jdbc:mysql://localhost:3306/biblioteca?zeroDateTimeBehavior=CONVERT_TO_NULL";
    private static final String USER = "root";
    private static final String PASS = "";
    private static BasicDataSource dataSource;

    public GestorBD() {
        //Creamos el pool de conexiones
        dataSource = new BasicDataSource();
        dataSource.setDriverClassName(DRIVER);
        dataSource.setUrl(URL);
        dataSource.setUsername(USER);
        dataSource.setPassword(PASS);
        //Indicamos el tama�o del pool de conexiones
        dataSource.setInitialSize(50);
    }
    
/////  SELECT
    public ArrayList<Libro> libros(){
        ArrayList<Libro> libros = new ArrayList<Libro>();
        String sql = "SELECT * FROM libro";
        try {
            Connection con = dataSource.getConnection();
            Statement st = con.createStatement();
            ResultSet rs = st.executeQuery(sql);
            while(rs.next()){
                Libro libro = new Libro(rs.getInt("id"), rs.getString("titulo"),
                                        rs.getInt("paginas"), rs.getString("genero"), 
                                        rs.getInt("idAutor"));
                libros.add(libro);
            }
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
            System.err.println("Error en metodo libros: " + ex);
        }
        return libros;
    }
    
    public LinkedHashMap<Integer, String> autores(){
        LinkedHashMap<Integer, String> autores = new LinkedHashMap<Integer, String>();
        String sql = "SELECT id, nombre FROM autor";
        Connection con;
        try {
            con = dataSource.getConnection();
            Statement st = con.createStatement();
            ResultSet rs = st.executeQuery(sql);
            while(rs.next()){
                autores.put(rs.getInt("id"), rs.getString("nombre"));
            }
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
            Logger.getLogger(GestorBD.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        return autores;
    }
    
    public ArrayList<Autor> datosAutores()  
    {
    	ArrayList<Autor> autores = new ArrayList<Autor>();
        String sql = "SELECT id, nombre, fechanac, nacionalidad FROM autor";
        try {
            Connection con = dataSource.getConnection();
            Statement st = con.createStatement();
            ResultSet rs = st.executeQuery(sql);
            while(rs.next())
                autores.add(new Autor(rs.getInt("id"), rs.getString("nombre"), rs.getDate("fechanac"), rs.getString("nacionalidad")));
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
            Logger.getLogger(GestorBD.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        return autores;
    } 

    public ArrayList<Libro> librosAutor(String idAutor)
    {
    	ArrayList<Libro> libros = new ArrayList<Libro>();
    	String sql = "SELECT id,titulo,paginas,genero,idAutor FROM libro where idautor= ?";
        try {
            Connection con = dataSource.getConnection();
            PreparedStatement st = con.prepareStatement(sql);
            st.setString(1, idAutor);
            ResultSet rs = st.executeQuery();
            while(rs.next())
                libros.add(new Libro(rs.getInt("id"), rs.getString("titulo"),rs.getInt("paginas"), rs.getString("genero"), rs.getInt("idAutor")));
            
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
            System.err.println("Error en metodo librosAutor: " + ex);
        }
    	return libros;
    }
    
    public ArrayList<LibroPrestado> sacarPrestamos()
    {
    	ArrayList<LibroPrestado> prestamos = new ArrayList<LibroPrestado>();
    	String sql = "select p.id,p.fecha, l.titulo "
    			+ "from prestamo p, libro l "
    			+ "where p.idlibro = l.id "
    			+ "order by fecha desc ";
        try {
            Connection con = dataSource.getConnection();
            PreparedStatement st = con.prepareStatement(sql);
            ResultSet rs = st.executeQuery();
            while(rs.next())
            {
            	LibroPrestado lib = new LibroPrestado(rs.getInt("id"), rs.getDate("fecha"),rs.getString("titulo"),diasTranscurridos(rs.getDate("fecha")));
            	if(!prestamos.contains(lib))
                	prestamos.add(lib); 
            }
            
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
            System.err.println("Error en metodo sacarPrestamos: " + ex);
        }
    	return prestamos;
    }
    /*
    public ArrayList<LibroPrestado> filtrarPrestamos(ArrayList<LibroPrestado> prestamos)
    {
    	ArrayList<LibroPrestado> filtrados = new ArrayList<LibroPrestado>();
    	for(LibroPrestado pres : prestamos)
    	{
    		if(!filtrados.contains(pres))   // evitar que aparezcan prestamos con los mismo libros
    		{
	    		int idLibro = pres.getIdLibro();
	    		pres.setLibro(libroPorId(idLibro));
	    		pres.setDiasPrestado(diasTranscurridos(pres.getFecha()));
	    		filtrados.add(pres);	
    		}    		
    	}
    	return filtrados;
    }
   
    
    public Libro libroPorId(int id)
    {
    	Libro libro = null;
    	String sql = "select * from libro where id = "+id;
        try {
            Connection con = dataSource.getConnection();
            PreparedStatement st = con.prepareStatement(sql);
            ResultSet rs = st.executeQuery();
            if(rs.next())
            	libro = new Libro(rs.getInt("id"), rs.getString("titulo"),rs.getInt("paginas"),rs.getString("genero"),rs.getInt("idautor")); 
            
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
            System.err.println("Error en metodo libroPorId: " + ex);
        }
    	return libro;
    }
     */
    
    public long diasTranscurridos(Date fecha)
    {
    	long milisegDia = 24*60*60*1000;    // milisegundos en un dia
    	long fechaActual = new java.util.Date().getTime();  //milisegundos desde 1970
    	long fechaPrestado = fecha.getTime(); //milisegundos desde 1970
    	long dias = (fechaActual - fechaPrestado)/milisegDia;    //conversion dias
    	return dias;
    }
    
    
    public boolean existeLibro(Libro libro){
        boolean existe = false;
        String sql = "SELECT id FROM libro WHERE titulo = '" + libro.getTitulo() +
                "' AND idautor = " + libro.getIdAutor();
        try {
            Connection con = dataSource.getConnection();
            Statement st = con.createStatement();
            ResultSet rs = st.executeQuery(sql);
            if(rs.next()){
                existe = true;
            }
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
            Logger.getLogger(GestorBD.class.getName()).log(Level.SEVERE, null, ex);
        }
        return existe;
    }

    public boolean existeAutor(Autor autor)
    {
    	boolean existe = false;
        String sql = "select id from autor where nombre = '"+ autor.getNombre() +"' and nacionalidad = '" + autor.getNacionalidad()+"'";
        try {
            Connection con = dataSource.getConnection();
            Statement st = con.createStatement();
            ResultSet rs = st.executeQuery(sql);
            if(rs.next())
                existe = true;
            
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        	return existe;
        }
        return existe;
    }
    
    
////// INSERT
    public int insertarLibro(Libro libro){
        int id = -1;
        String sql = "INSERT INTO libro(titulo, paginas, genero, idautor) "
                + " VALUES(?, ?, ?, ?)";
        try {
            Connection con = dataSource.getConnection();
            PreparedStatement st = con.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS);
            st.setString(1, libro.getTitulo());
            st.setInt(2, libro.getPaginas());
            st.setString(3, libro.getGenero());
            st.setInt(4, libro.getIdAutor());
            
            st.executeUpdate();
            
            ResultSet rs = st.getGeneratedKeys();
            if(rs.next()){
                id = rs.getInt(1);
            }
            
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
            System.err.println("Error en metodo insertarLibro: " + ex);
        }
        
        return id;
    }
    
    public int insertarAutor(Autor autor)
    {   	
        try {
        	if(!existeAutor(autor))
        	{
        		String sql = "INSERT INTO autor(nombre, fechanac, nacionalidad) VALUES(?, ?, ?)";
                Connection con = dataSource.getConnection();
                PreparedStatement st = con.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS);
                st.setString(1, autor.getNombre());
                st.setDate(2, (Date) autor.getFechaSQL());
                st.setString(3, autor.getNacionalidad());
                
                st.executeUpdate();
                
                ResultSet rs = st.getGeneratedKeys();
                rs.next();
            
            	int id = rs.getInt(1);
            	rs.close();   
                st.close();
                con.close();
                return id;
                	
        	}
        	else
    			return 0;
            
        } catch (SQLException ex) {
            System.err.println("Error en metodo insertarAutor: " + ex);
            return -1;
        }    	
    }
    
}
