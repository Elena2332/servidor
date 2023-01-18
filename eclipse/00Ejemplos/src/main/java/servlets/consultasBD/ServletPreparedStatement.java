package servlets.consultasBD;

import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import javax.servlet.ServletContext;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import beans.Item;

/**
 * @author Amaia
 * Servlet implementation class ServletPreparedStatement
 */
public class ServletPreparedStatement extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public ServletPreparedStatement() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
	
		ServletContext contexto=request.getServletContext();
		
		//Ejemplo 1: prepared statement con bind variables para consultas de tipo select
		obtenerNombresPorId();	
		//Ejemplo 2: prepared statement con bind variables para consultas de tipo insert
		insertarItem();
		//Ejemplo 3: prepared statement con bind variables para consultas de tipo insert con datos recogidos de fichero
		insertarItemDesdeFichero(contexto); 
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}
	
	
	/**
	 * Ejemplo 1 - Consultas prepared statement 
	 */
	private void obtenerNombresPorId() {
		Connection con;
		List<String> lista;
		
		try {
			
			DriverManager.registerDriver(new com.mysql.cj.jdbc.Driver());	                
			con = DriverManager.getConnection ("jdbc:mysql://localhost/subastas","root", "");
	
			//ArrayList con los elementos a buscar
			List<Integer> arrayIds= new ArrayList<Integer>();
			arrayIds.add( 1);
			arrayIds.add( 2);
					
			lista=new ArrayList<String>();
			
			for(int i=0;i<arrayIds.size();i++) {
				
				PreparedStatement ps = con.prepareStatement("SELECT * FROM Items WHERE id  =    ? ");
				ps.setInt(1, arrayIds.get(i));
		
				ResultSet rs = ps.executeQuery();
				
				while (rs.next()) {
					lista.add(rs.getString("nombre"));
				}
				rs.close();
				ps.close();
			}
			
			con.close();
			
			System.out.println(lista.toString());
			
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
	
	/**
	 * Ejemplo 2 - Inserción de items con prepared statement y bind variables
	 */
	private void insertarItem() {
		Connection con;
		
		SimpleDateFormat formateador = new SimpleDateFormat("dd/MM/yyyy");
		Date fechaActual= new Date();
		String strFechaActual=formateador.format(fechaActual);
		
		Item[] items={
				 new Item(50,2,20,"Prueba1",1000, "descripcion1", fechaActual), new Item(41,2,20,"Prueba2",2000, "descripcion2", fechaActual), new Item(43,2,20,"Prueba3",3000, "descripcion3", fechaActual)};
				
		try {
				DriverManager.registerDriver(new com.mysql.cj.jdbc.Driver());
					                
				con = DriverManager.getConnection ("jdbc:mysql://localhost/subastas","root", "");
						
				String sql ="INSERT INTO items (id,id_cat,id_user,nombre,preciopartida,descripcion,fechafin) VALUES( ? , ?,  ? ,? , ?,  ?,  ?)";
				PreparedStatement ps = con.prepareStatement (sql);   // Se precompila la consulta

				int contadorRegistros=0;
				
				for (int i=0; i<items.length; i++){
					ps.setInt (1, items[i].getId());
					ps.setInt (2, items[i].getId_cat());
					ps.setInt (3, items[i].getId_user());
					ps.setString (4,items[i].getNombre());
					ps.setInt (5, items[i].getPreciopartida());
					ps.setString (6, items[i].getDescripcion());
					ps.setDate(7, new java.sql.Date(items[i].getFechafin().getTime()));
					int n = ps.executeUpdate( );   		 // Cada ejecución de la consulta es más rápida,al estar precompilada}
					
					contadorRegistros++;
				}
				
				ps.close();
				con.close();
				
				System.out.println("Numero de registros insertados:"+contadorRegistros);
				
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

	}
	
	/**
	 * Ejemplo 3 - Inserción de items con prepared statement y bind variables - Insertar nuevas filas en la tabla de compras anterior (extraídas de un fichero de texto)
	 * @throws FileNotFoundException ,IOException
	 */
	private void insertarItemDesdeFichero(ServletContext servletContext) throws FileNotFoundException,IOException {
		
		 Connection con;
		
		try {
			DriverManager.registerDriver(new com.mysql.cj.jdbc.Driver());
        
			con = DriverManager.getConnection ("jdbc:mysql://localhost/subastas","root", "");
			
			PreparedStatement ps = con.prepareStatement("INSERT INTO items (id,id_cat,id_user,nombre,preciopartida,descripcion,fechafin) VALUES( ? , ?,  ? ,? , ?,  ?,  ?)");
	
			BufferedReader br=new BufferedReader(new FileReader(servletContext.getRealPath("/WEB-INF/items.txt")));
					
			String str=br.readLine();
			while(str!=null ){
				String[ ] partes = str.split(",");
				
				ps.setInt (1, Integer.parseInt(partes[0]));
				ps.setInt (2, Integer.parseInt(partes[1]));
				ps.setInt (3, Integer.parseInt(partes[2]));
				ps.setString (4,partes[3]);
				ps.setInt (5, Integer.parseInt(partes[4]));
				ps.setString (6, partes[5]);
				ps.setDate(7, new java.sql.Date(new Date().getTime()));
												
				ps.executeUpdate();						
				str=br.readLine( );		
			}
			br.close();
			ps.close();
			con.close();
			
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
	}

}
