package dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

import beans.Alumno;
import conex.ConexPoolBD;

public class AlumnosDAO {

	
	public static Alumno getAlumno(String dni)
	{
		Alumno alumno = null;
		String sql = "SELECT * FROM alumno where dni=? ";
        Connection con;
        try {
            con = ConexPoolBD.getConnection();
            PreparedStatement st = con.prepareStatement(sql);
            st.setString(1, dni);
            ResultSet rs = st.executeQuery();
            if(rs.next())
                alumno = new Alumno(rs.getString("dni"),rs.getString("apellidos"),rs.getString("nombre"),rs.getString("telefono"),rs.getString("email"));
            
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
        	System.out.println("Error en getAlumno()");
            System.out.println(ex.getMessage());
        }
		return alumno;
	}
	
	
	public static ArrayList<Alumno> getAlumnosActividad(String id)
	{
		ArrayList<Alumno> alumnos = new ArrayList<Alumno>();
		String sql = "SELECT * FROM alumno where dni in (select alumno_dni from participa where actividad_id = ?) ";
        Connection con;
        try {
            con = ConexPoolBD.getConnection();
            PreparedStatement st = con.prepareStatement(sql);
            st.setString(1, id);
            ResultSet rs = st.executeQuery();
            if(rs.next())
                alumnos.add(new Alumno(rs.getString("dni"),rs.getString("apellidos"),rs.getString("nombre"),rs.getString("telefono"),rs.getString("email")));
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
        	System.out.println("Error en getAlumno()");
            System.out.println(ex.getMessage());
        }
		return alumnos;
	}
	
	
}
