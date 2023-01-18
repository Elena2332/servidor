/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
package servlets.fechas;

import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import beans.Item;
import beans.Puja;
import dao.manual.GestorBD;

/**
 * @author Amaia
 *
 */
public class ServletFechas extends HttpServlet {
   /**
	 * 
	 */
	private static final long serialVersionUID = 1317182168389845269L;

   /**
    * Handles the HTTP <code>GET</code> method.
    *
    * @param request servlet request
    * @param response servlet response
    * @throws ServletException if a servlet-specific error occurs
    * @throws IOException if an I/O error occurs
    */
   @Override
   protected void doGet(HttpServletRequest request, HttpServletResponse response)
           throws ServletException, IOException {
	   		
	   		procesarFechasParaConsultaBD(request,response);
	   	
   }

   /**
    * Handles the HTTP <code>POST</code> method.
    *
    * @param request servlet request
    * @param response servlet response
    * @throws ServletException if a servlet-specific error occurs
    * @throws IOException if an I/O error occurs
    */
   @Override
   protected void doPost(HttpServletRequest request, HttpServletResponse response)
           throws ServletException, IOException {
	   		
	   		procesarFechasParaConsultaBD(request,response);
	   
   }
   
   
   
	/**
	 * Metodo que procesa el servlet recibiendo una petición de tipo GET o de tipo POST de la misma forma
	 * @param request
	 * @param response
	 * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
	 */
	private static void procesarFechasParaConsultaBD(HttpServletRequest request, HttpServletResponse response)  throws ServletException, IOException {
		try {
				// Se registra el Driver de MySQL
	            DriverManager.registerDriver(new com.mysql.cj.jdbc.Driver());
	            
	            // Se obtiene una conexión con la base de datos. Hay que
	            // cambiar el usuario "root" y la clave "la_clave" por las
	            // adecuadas a la base de datos que estemos usando.
	            Connection con = DriverManager.getConnection (
	                "jdbc:mysql://localhost/subastas","root", "");
	            
	            //Creación de objetos Date java.sql.Date y java.util.Date vacios
	            java.sql.Date fechaSqlNew= new java.sql.Date(new java.util.Date().getTime());
	            java.util.Date fechaUtilNew= new java.util.Date();
	            System.out.println("nuevo objeto fechaSqlNew java.sql.Date : "+fechaSqlNew);
	            System.out.println("nuevo objeto fechaUtilNew java.util.Date : "+fechaUtilNew);
	            
	            System.out.println("Conversiones de UTIL A SQL y viceversa");
	            //Conversion de java.util.Date a java.sql.Date mediante creación de objeto
	            java.sql.Date fechaSql= new java.sql.Date(fechaUtilNew.getTime());
	            System.out.println("objeto fechaSql java.sql.Date : "+fechaSql);
	            
	            //Conversion de java.sql.Date a java.util.Date mediante creación de objeto
	            java.util.Date fechaUtil= new java.util.Date(fechaSqlNew.getTime());
	            System.out.println("objeto  fechaUtil java.sql.Date : "+fechaUtil);
	            
	        	// El metodo de creación de una fecha especifica new Date("2023/01/01") está obselto y es preferible no utilizarlo.
	            //En su lugar deberiamos usar el objeto SimpleDateFormat y utiliza el metodo parse

	            //Creación de objetos SimpleDateFormat con distintos formatos paara la creación y formateo de fechas java.util.Date
	            SimpleDateFormat formatoGuion = new SimpleDateFormat("yyyy-MM-dd");
	            SimpleDateFormat formatoContrabarra = new SimpleDateFormat("yyyy/MM/dd");
	            
	            try {
	            	//Metodo parse con el formato yyyy-MM-dd pasando el string obtenido del toString de un java.util.Date
		            System.out.println("nuevo objeto java.util.Date-> metodo parse con formato yyyy-MM-dd obtenido del toString de un java.util.Date: "+formatoGuion.parse(fechaUtilNew.toString()));
	            }catch(Exception ex) {
	            	System.out.println(ex.getMessage());
	            }
	            
	            try {
	            	//Metodo parse con el formato yyyy/MM/dd pasando el string creado para tal uso con ese mismo formato
	            	System.out.println("nuevo objeto java.util.Date -> metodo parse yyyy/MM/dd de String mismo formato: "+formatoContrabarra.parse("2023/01/01"));
	            	//Metodo parse con el formato yyyy-MM-dd pasando el string creado para tal uso con ese el formato yyyy/MM/dd formato
	            	System.out.println("nuevo objeto java.util.Date -> metodo parse yyyy/MM/dd de String mismo formato: "+ formatoGuion.parse("2023/01/01"));
	            	
	            }catch(Exception ex) {
	            	System.out.println(ex.getMessage());	
	            }
	            
	            try {
	            	System.out.println("nuevo objeto java.util.Date-> metodo parse con formato yyyy-MM-dd de String mismo formato: "+formatoGuion.parse("2023-01-01"));
	            	System.out.println("Formateo del nuevo objeto devuelto por parse con formato yyyy-MM-dd a formato yyyy/MM/dd: "+formatoContrabarra.format(formatoGuion.parse("2023-01-01")));
	            	System.out.println("nuevo objeto java.util.Date-> metodo parse con formato yyyy-MM-dd de String distinto formato: "+formatoGuion.parse("2023/01/01"));
	            }catch(Exception ex) {
	            	System.out.println(ex.getMessage());	
	            }
	            
	            //Formateo de objetos creados java.util.Date y java.sql.Date
	            try {
	            	System.out.println("Formateo con objeto SimpleDateFormat ");
	            	System.out.println("objeto fechaUtilNew formateo directo Formato yyyy-MM-dd : "+formatoGuion.format(fechaUtilNew));
	            	System.out.println("objeto fechaSqlNew formateo directo Formato yyyy-MM-dd: "+formatoGuion.format(fechaSqlNew));
	            	System.out.println("objeto fechaUtilNew formateo directo Formato yyyy/MM/dd: "+formatoContrabarra.format(fechaUtilNew));
	            	System.out.println("objeto fechaSqlNew formateo directo yyyy/MM/dd: "+formatoContrabarra.format(fechaSqlNew));
	            }catch(Exception ex) {
	            	System.out.println(ex.getMessage());	
	            }

	            try {
	            	// Creación de objeto util.Date mediante la clase SimpleDateFormat con el metodo PARSE y distintos elementos
	            	System.out.println("objeto parseado a objeto date desde String creado manualmente con formaton yyyy/MM/dd "+formatoGuion.parse("2023/01/01"));
	            	System.out.println("objeto parseado a objeto date desde String creado manualmente con formaton yyyy-MM-dd "+formatoGuion.parse("2023-01-01"));
	            	System.out.println("objeto parseado a objeto date desde el toString de objeto java.util.Date: "+formatoGuion.parse(fechaUtil.toString()));
	            	System.out.println("objeto parseado a objeto date desde el toString de objeto java.sql.Date: "+formatoGuion.parse(fechaSqlNew.toString()));
	            
	            	System.out.println("objeto parseado a objeto date desde String creado manualmente con formaton yyyy/MM/dd "+formatoContrabarra.parse("2023/01/01"));
	            	System.out.println("objeto parseado a objeto date desde String creado manualmente con formaton yyyy-MM-dd "+formatoContrabarra.parse("2023-01-01"));
	            	System.out.println("objeto parseado a objeto date desde el toString de objeto java.util.Date: "+formatoContrabarra.parse(fechaUtil.toString()));
	            	System.out.println("objeto parseado a objeto date desde el toString de objeto java.sql.Date: "+formatoContrabarra.parse(fechaSqlNew.toString()));
	            
	            
	            }catch(Exception ex) {
	            	System.out.println(ex.getMessage());	
	            }
	            
				// Procesar Fecha de java.sql.Date desde Resulset
				String sql="select id, id_item,id_user,cantidad,fecha from pujas where id=6";
				Statement st = con.createStatement();
				ResultSet rs = st.executeQuery(sql);
				
				Puja puja= new Puja();
				
				while(rs.next()){
					
					puja= new Puja();
					puja.setId_user(rs.getInt("id_user"));
					puja.setId(rs.getInt("id"));
					puja.setId_item(rs.getInt("id_item"));
					puja.setCantidad(rs.getInt("cantidad"));
					puja.setFecha(rs.getDate("fecha"));

					System.out.println(formatoGuion.parse(rs.getDate("fecha").toString()));
					System.out.println(formatoGuion.format(rs.getDate("fecha")));
					System.out.println("rs.getDate(Fecha): "+rs.getDate("fecha"));
					System.out.println("puja.getFecha() : "+puja.getFecha());
				}
				
				System.out.println("objeto puja Fecha : "+puja.toString());
				
				//Procesar Fecha de java.util.Date a java.sql.Date con una insert
				try {
					String sqlInsert="INSERT INTO PUJAS (id_item, id_user,cantidad,fecha) VALUES (2, 20, 1000, '2023-01-01')";
					st = con.createStatement();
					System.out.println("SQL sqlInsert VALUES (2, 20, 1000, '2023-01-01')" + sqlInsert);
					st.executeUpdate(sqlInsert);
					
				}catch (SQLException e) {
					System.out.println(e.getMessage());
				}
				
				try {
					String sqlInsert4="INSERT INTO PUJAS (id_item, id_user,cantidad,fecha) VALUES (2, 20, 1000, '01/01/2023')";
					st = con.createStatement();
					System.out.println("SQL sqlInsert4 VALUES (2, 20, 1000, '01/01/2023')" + sqlInsert4);
					st.executeUpdate(sqlInsert4);
					
				}catch (SQLException e) {
					System.out.println(e.getMessage());
				}
				
				try {
					String sqlInsert2="INSERT INTO PUJAS (id_item, id_user,cantidad,fecha) VALUES ( "+puja.getId_item()+","+puja.getId_user()+","+puja.getCantidad()+", "+formatoGuion.format(puja.getFecha())+")";
					st = con.createStatement();
					System.out.println("SQL sqlInsert2 VALUES ( \"+puja.getId_item()+\",\"+puja.getId_user()+\",\"+puja.getCantidad()+\", \"+formatoGuion.format(puja.getFecha())" + sqlInsert2);

					st.executeUpdate(sqlInsert2);
				}catch (SQLException e) {
					System.out.println(e.getMessage());
				}
				
				try {
					String sqlInsert5="INSERT INTO PUJAS (id_item, id_user,cantidad,fecha) VALUES ( "+puja.getId_item()+","+puja.getId_user()+","+puja.getCantidad()+", "+formatoGuion.parse(puja.getFecha().toString())+")";
					st = con.createStatement();
					System.out.println("SQL sqlInsert5 VALUES ( \"+puja.getId_item()+\",\"+puja.getId_user()+\",\"+puja.getCantidad()+\", \"+formatoGuion.parse(puja.getFecha().toString())" + sqlInsert5);
					st.executeUpdate(sqlInsert5);
					
				}catch (SQLException e) {
					System.out.println(e.getMessage());
				}
				
				try {
					String sqlInsert6="INSERT INTO PUJAS (id_item, id_user,cantidad,fecha) VALUES ( "+puja.getId_item()+","+puja.getId_user()+","+puja.getCantidad()+", "+puja.getFecha()+")";
					st = con.createStatement();
					System.out.println("SQL sqlInsert6 VALUES ( \"+puja.getId_item()+\",\"+puja.getId_user()+\",\"+puja.getCantidad()+\", \"+puja.getFecha()+"+ sqlInsert6);

					st.executeUpdate(sqlInsert6);
					
				}catch (SQLException e) {
					System.out.println(e.getMessage());
				}
				
				try {
					String sqlInsert3="INSERT INTO PUJAS (id_item, id_user,cantidad,fecha) VALUES ( "+puja.getId_item()+","+puja.getId_user()+","+puja.getCantidad()+", "+new java.sql.Date(puja.getFecha().getTime())+")";
					st = con.createStatement();
					st.executeUpdate(sqlInsert3);
					
					System.out.println("SQL sqlInsert3 VALUES ( \"+puja.getId_item()+\",\"+puja.getId_user()+\",\"+puja.getCantidad()+new java.sql.Date(puja.getFecha().getTime())+"+ sqlInsert3);

				}catch (SQLException e) {
					System.out.println(e.getMessage());
				}
				
				rs.close();
				st.close();
				con.close();

			}catch (SQLException | ParseException e) {
				System.out.println(e.getMessage());
			}

	}

}
