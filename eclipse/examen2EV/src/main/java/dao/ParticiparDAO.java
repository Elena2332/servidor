package dao;

import java.sql.Connection;
import java.sql.Date;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.sql.Statement;

import beans.Actividad;
import beans.Alumno;
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

}
