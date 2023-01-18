/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
package servlets.consultasBD;

import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;

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
public class ServletSelects extends HttpServlet {
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
	   	procesarConsultaBD(request,response);
	   	
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
	   procesarConsultaBD(request,response);
	   
   }
   
   
   
	/**
	 * Metodo que procesa el servlet recibiendo una petición de tipo GET o de tipo POST de la misma forma
	 * @param request
	 * @param response
	 * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
	 */
	private static void procesarConsultaBD(HttpServletRequest request, HttpServletResponse response)  throws ServletException, IOException {
		try {
				// Se registra el Driver de MySQL
	            DriverManager.registerDriver(new com.mysql.cj.jdbc.Driver());
	            
	            // Se obtiene una conexión con la base de datos. Hay que
	            // cambiar el usuario "root" y la clave "la_clave" por las
	            // adecuadas a la base de datos que estemos usando.
	            Connection con = DriverManager.getConnection (
	                "jdbc:mysql://localhost/subastas","root", "");
				
				String sql="select id, id_item,id_user,cantidad,fecha from pujas";
				Statement st = con.createStatement();
				ResultSet rs = st.executeQuery(sql);
						
				while(rs.next()){
					System.out.println("id:"+ rs.getString(1));
					System.out.println(",id_item: "+ rs.getInt("id_item"));
					System.out.println(",id_user: "+ rs.getInt("id_user"));
					System.out.println(",cantidad: "+ rs.getInt("cantidad"));
					System.out.println(",fecha: "+ rs.getDate("fecha"));
				}
				rs.close();
				
				st.close();
				con.close();

			}catch (SQLException e) {
				System.out.println(e.getMessage());
			}

	}

}
