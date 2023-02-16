package dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

import beans.Actividad;
import beans.Impartidor;
import conex.ConexPoolBD;

public class ImpartidoresDAO {

	
	public static Impartidor getImpartidor(String id)
	{
		Impartidor impartidor = null;
		String sql = "SELECT * FROM impartidor where id=? ";
        Connection con;
        try {
            con = ConexPoolBD.getConnection();
            PreparedStatement st = con.prepareStatement(sql);
            st.setString(1, id);
            ResultSet rs = st.executeQuery();
            while(rs.next())
                impartidor = new Impartidor(rs.getInt("id"),rs.getString("apellido"),rs.getString("nombre"));
            
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
        	System.out.println("Error en getImpartidor()");
            System.out.println(ex.getMessage());
        }
		return impartidor;
	}
	
	
	public static ArrayList<Actividad> getActividades(int id)   // devuelve todas las actividades del impartidor
	{
		ArrayList<Actividad> actividades = new ArrayList<Actividad>();
		String sql = "SELECT * FROM actividad where impartidor_id in ( select id from impartidor where id = ?) ";  
        Connection con;
        try {
            con = ConexPoolBD.getConnection();
            PreparedStatement st = con.prepareStatement(sql);
            st.setInt(1, id);
            ResultSet rs = st.executeQuery();
            while(rs.next())
            	actividades.add(new Actividad());
            
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
        	System.out.println("Error en getActividades()");
            System.out.println(ex.getMessage());
        }
		return actividades;
	}
	
}
