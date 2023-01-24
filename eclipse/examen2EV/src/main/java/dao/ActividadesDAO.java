package dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

import beans.Actividad;
import beans.Alumno;
import beans.Impartidor;
import conex.ConexPoolBD;

public class ActividadesDAO {

	
	public static ArrayList<Actividad> obtenerActividadesParticipa(String dni)
	{
		ArrayList<Actividad> actividades = new ArrayList<Actividad>();
		String sql = "SELECT * FROM actividad WHERE id in (select actividad_id from participa WHERE alumno_dni=?)";
        Connection con;
        try {
            con = ConexPoolBD.getConnection();
            PreparedStatement st = con.prepareStatement(sql);
            st.setString(1, dni);
            ResultSet rs = st.executeQuery();
            while(rs.next())
            {
            	Impartidor impartidor = ImpartidoresDAO.getImpartidor(rs.getString("impartidor_id"));
            	actividades.add(new Actividad(rs.getInt("id"),impartidor,rs.getString("nombre"),rs.getDouble("coste_mensual"),rs.getInt("capacidad")));//rs.getString("nombre"));
            }
            
            rs.close();
            st.close();
            con.close();

    		return actividades;
        } catch (SQLException ex) {
        	System.out.println("Error en obtenerActividadesParticipa()");
            System.out.println(ex.getMessage());
        }
		return actividades;
	}
	
	
	public static ArrayList<Actividad> obtenerActividadesLibresNoParticipa(String dni)
	{
		ArrayList<Actividad> actividades = new ArrayList<Actividad>();
		// actividades en las que el alumno no esta registrado y no coinciden en nombre con las que si esta
		String sql = "SELECT * FROM actividad WHERE id not in "
				+ "(select actividad_id from participa WHERE alumno_dni=? and nombre not in "
				+ "	(select nombre from actividad where alumno_dni=?))";
        Connection con;
        try {
            con = ConexPoolBD.getConnection();
            PreparedStatement st = con.prepareStatement(sql);
            st.setString(1, dni);
            st.setString(2, dni);
            ResultSet rs = st.executeQuery();
            while(rs.next())
            {
            	Impartidor impartidor = ImpartidoresDAO.getImpartidor(String.valueOf(rs.getInt("impartidor_id")));
            	actividades.add(new Actividad(rs.getInt("id"),impartidor,rs.getString("nombre"),rs.getDouble("coste_mensual"),rs.getInt("capacidad")));//rs.getString("nombre"));
            }
            
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
        	System.out.println("Error en obtenerActividadesLibresNoParticipa()");
            System.out.println(ex.getMessage());
        }
		return actividades;
	}
	
	
	
	public static Actividad getActividad(String id)
	{
		Actividad actividad = null;
		String sql = "SELECT * FROM actividad where id=? ";
        Connection con;
        try {
            con = ConexPoolBD.getConnection();
            PreparedStatement st = con.prepareStatement(sql);
            st.setString(1, id);
            ResultSet rs = st.executeQuery();
            if(rs.next())
            {
            	Impartidor impartidor = ImpartidoresDAO.getImpartidor(String.valueOf(rs.getInt("impartidor_id")));
                actividad = new Actividad(rs.getInt("id"),impartidor,rs.getString("nombre"),rs.getDouble("coste_mensual"),rs.getInt("capacidad"));
            }
            
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
        	System.out.println("Error en getActividad()");
            System.out.println(ex.getMessage());
        }
		return actividad;
	}
}
