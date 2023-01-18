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
*
* @author Amaia
*/
public class ServletConsultaBD extends HttpServlet {
   /**
	 * 
	 */
	private static final long serialVersionUID = 1317182168389845269L;

	private GestorBD bd;
   
   @Override
   public void init(ServletConfig config) throws ServletException {
       super.init(config);
       bd = new GestorBD();
   }
   
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
	   	
	   	ArrayList<Item> arrayItems=bd.items();
	   	for(Item item: arrayItems){
	   		System.out.println(item.toString());
	   	}
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
	   
		ArrayList<Puja> arrayPujas=bd.pujas();
	   	for(Puja puja: arrayPujas){
	   		System.out.println(puja.toString());
	   	}
   }

}
