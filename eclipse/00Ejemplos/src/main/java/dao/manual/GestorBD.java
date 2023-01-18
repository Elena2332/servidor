/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao.manual;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.LinkedHashMap;
import java.util.logging.Level;
import java.util.logging.Logger;

import org.apache.tomcat.dbcp.dbcp2.BasicDataSource;

import beans.Item;
import beans.Puja;


/**
 *
 * @author Amaia
 */
public class GestorBD {
    private static final String DRIVER = "com.mysql.cj.jdbc.Driver";
    private static final String URL = "jdbc:mysql://localhost:3306/subastas?zeroDateTimeBehavior=CONVERT_TO_NULL";
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
        //Indicamos el tamaño del pool de conexiones
        dataSource.setInitialSize(50);	
    	
    }
    
    public ArrayList<Item> items(){
        ArrayList<Item> items = new ArrayList<Item>();
        String sql = "SELECT * FROM Items";
        try {
            Connection con = dataSource.getConnection();
            Statement st = con.createStatement();
            ResultSet rs = st.executeQuery(sql);
            while(rs.next()){
            	Item item = new Item(rs.getInt("id"),rs.getInt("id_cat"),rs.getInt("id_user"), 
            							rs.getString("nombre"),rs.getInt("preciopartida"),rs.getString("descripcion"),
                                        rs.getDate("fechafin"));
                items.add(item);
            }
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
            System.err.println("Error en metodo libros: " + ex);
        }
        return items;
    }
    
    public ArrayList<Puja> pujas(){
        ArrayList<Puja> pujas = new ArrayList<Puja>();
        String sql = "SELECT * FROM pujas";
        try {
            Connection con = dataSource.getConnection();
            Statement st = con.createStatement();
            ResultSet rs = st.executeQuery(sql);
            while(rs.next()){
            	Puja puja = new Puja(rs.getInt("id"),rs.getInt("id_item"),rs.getInt("id_user"), 
            							rs.getInt("cantidad"),
                                        rs.getDate("fecha"));
            	pujas.add(puja);
            }
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
            System.err.println("Error en metodo libros: " + ex);
        }
        return pujas;
    }
    
    public LinkedHashMap<Integer, String> mapaPujaCantidades(){
        LinkedHashMap<Integer, String> pujas = new LinkedHashMap<Integer, String>();
        String sql = "SELECT id, cantidad FROM puja";
        Connection con;
        try {
            con = dataSource.getConnection();
            Statement st = con.createStatement();
            ResultSet rs = st.executeQuery(sql);
            while(rs.next()){
                pujas.put(rs.getInt("id"), rs.getString("cantidad"));
            }
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
            Logger.getLogger(GestorBD.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        return pujas;
    }
    
    public boolean existeItem(Item item){
        boolean existe = false;
        String sql = "SELECT id FROM items WHERE nombre = '" + item.getNombre() +
                "'";
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
   
}
