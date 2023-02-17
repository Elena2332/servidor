package dao;

import java.sql.Connection;
import java.sql.Date;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import beans.Actividad;
import beans.Alumno;
import beans.Impartidor;
import conex.ConexPoolBD;

public class ParticiparDAO {

	public static boolean inscribir(Alumno alumno, Actividad actividad) 
	{
		String sql = "INSERT INTO participa(actividad_id, alumno_dni, ultima_asistencia) VALUES (?, ?, ?)";
		Date fecha = new Date(new java.util.Date().getTime());   // fecha actual
        try {
            Connection con = ConexPoolBD.getConnection();
            PreparedStatement st = con.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS);
            st.setInt(1, actividad.getId());
            st.setString(2, alumno.getDni());
            st.setDate(3, fecha);
            
            st.execute();

            st.close();
            con.close();
            return true;
        } catch (SQLException ex) {
        	System.out.println("Error en inscribir()");
            System.out.println(ex.getMessage());	        
            return false;
        }
		
	}
	
	
	public static String getUltimaAsistencia(String id, String dni)
	{
		String asistencia = null;
		String sql = "SELECT ultima_asistencia FROM participa where actividad_id=? and alumno_dni=?";
        Connection con;
        try {
            con = ConexPoolBD.getConnection();
            PreparedStatement st = con.prepareStatement(sql);
            st.setString(1, id);
            st.setString(2, dni);
            ResultSet rs = st.executeQuery();
            if(rs.next())
            {
            	Date aux = rs.getDate("ultima_asistencia");
            	asistencia = aux.toString();
            }
            
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
        	System.out.println("Error en getActividad()");
            System.out.println(ex.getMessage());
        }
		return asistencia;
	}
	

}
