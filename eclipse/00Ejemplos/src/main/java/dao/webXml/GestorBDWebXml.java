/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao.webXml;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.LinkedHashMap;
import java.util.logging.Level;
import java.util.logging.Logger;

import javax.naming.Context;
import javax.naming.InitialContext;
import javax.naming.NamingException;

import javax.sql.DataSource;

import beans.Item;
import beans.Puja;
import dao.manual.GestorBD;


/**
 *
 * @author Amaia
 */
public class GestorBDWebXml {

    private static DataSource dataSource;

    public GestorBDWebXml() {
    	
    	try {
    			InitialContext ctx = new InitialContext();
    			Context env = (Context) ctx.lookup("java:comp/env");
    			// nombre del recurso en el context.xml
    			dataSource = (DataSource) env.lookup("jdbc/poolSubastasDB");
    		
    	} catch (NamingException e) {
    		e.printStackTrace();
    		
    	}

    	
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
    
    public int modificarNombrePujas() {
		
		String sql = "UPDATE ITEMS SET NOMBRE = 'MANET' WHERE NOMBRE LIKE 'MONET%' ";
		
		int resultado=0;
		
		try {
			Connection con = dataSource.getConnection();
			Statement pstm = con.createStatement();
			resultado = pstm.executeUpdate(sql);
			
			pstm.close();
			con.close();
			
			
		} catch (SQLException e) {
			e.printStackTrace();
		}
		return resultado;
	}
}
