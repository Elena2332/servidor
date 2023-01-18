package dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import beans.Cliente;
import conex.PoolConexiones;

public class ClienteDAO {

	
	public static Cliente buscaCliente(String nom, String pass)
	{
		Cliente cliente = null;
        String sql = "SELECT * FROM clientes where nombre=? and password=?";
        Connection con;
        try {
            con = PoolConexiones.getConnection();
            PreparedStatement st = con.prepareStatement(sql);
            st.setString(1, nom);
            st.setString(2, pass);
            ResultSet rs = st.executeQuery();
            if(rs.next()){     
                cliente = new Cliente(rs.getInt("id"),rs.getString("nombre"),rs.getString("password"),rs.getString("domicilio"),rs.getString("codigopostal"),rs.getString("telefono"),rs.getString("email"));
            }
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
        	System.out.println("Error en buscaClienteDAO(nom,pass)");
            System.out.println(ex.getMessage());
        }
	        
		return cliente;
	}
	
	
	public static boolean buscaCliente(String nom)
	{
        String sql = "SELECT * FROM clientes where nombre=?";
        Connection con;
        try {
            con = PoolConexiones.getConnection();
            PreparedStatement st = con.prepareStatement(sql);
            st.setString(1, nom);
            ResultSet rs = st.executeQuery();
            if(rs.next()){     
                return true;
            }
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
        	System.out.println("Error en buscaClienteDAO(nom)");
            System.out.println(ex.getMessage());
        }
	        
		return false;
	}
	
	
	public static boolean guardarCliente(Cliente cliente)
	{
		return true;
	}
	
	public static boolean actualizarCliente(Cliente cliente)
	{
		return true;
	}
	
}
