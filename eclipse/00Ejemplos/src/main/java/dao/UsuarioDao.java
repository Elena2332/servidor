package dao;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Statement;

import beans.Usuario;
import dao.basic.PoolConexionesBasic;

public class UsuarioDao {

	public static Usuario login(String nombreUser, String password)    { 
        Usuario user=null; 
        
        try (Connection con=PoolConexionesBasic.getConnection();)       {                  		         
            
        	//Se construye la sentencia a lanzar en la BD de subastas
        	String sql = "select id, username, nombre, password, email, cadenaVerificacion,activo from usuarios where username='" + nombreUser + "'  and password='"+password+"'";
            
        	//Se lanza la creación del statement con la conexión definida en el try
        	Statement st = con.createStatement();
        	//Se obtiene el resultado de la consulta
            ResultSet rs = st.executeQuery(sql);            
            
            //Se recuperan los datos de la tabla usuarios de la consulta realizada y se añaden al bean correspondiente
            if(rs.next())
              user=new Usuario(rs.getInt("id"), rs.getString("username"), rs.getString("nombre"),rs.getString("password"),rs.getString("email"),rs.getString("cadenaVerificacion"),rs.getInt("activo"));
            
            rs.close();
            st.close();
         }
         catch (Exception e)  {
             System.err.println("Error en login: " + e);
         }
        
        //Se devuelve el usuario obtenido
        return user;      
    }

	
	
	public static Usuario loginNoExiste(String nombreUser, String password)    { 
        Usuario user=new Usuario(); 
        
        try (Connection con=PoolConexionesBasic.getConnection();)       {                  		         
            
        	//Se construye la sentencia a lanzar en la BD de subastas
        	String sql = "select id, username, nombre, password, email, cadenaVerificacion,activo from usuarios where username='" + nombreUser + "'  and password='"+password+"'";
            
        	//Se lanza la creación del statement con la conexión definida en el try
        	Statement st = con.createStatement();
        	//Se obtiene el resultado de la consulta
            ResultSet rs = st.executeQuery(sql);            
            
            //Se recuperan los datos de la tabla usuarios de la consulta realizada y se añaden al bean correspondiente
            if(rs.next()) {
              user.setId(Integer.valueOf(rs.getInt("id")));
              user.setUsername(rs.getString("username"));
              user.setNombre(rs.getString("nombre"));
              user.setPassword(rs.getString("password"));
              user.setEmail(rs.getString("email"));
              user.setCadenaVerificacion(rs.getString("cadenaVerificacion"));
              user.setActivo(rs.getInt("activo"));
            }
            rs.close();
            st.close();
         }
         catch (Exception e)  {
             System.err.println("Error en login: " + e);
         }
        
        //Se devuelve el usuario obtenido
        return user;      
    }
	
	
}
