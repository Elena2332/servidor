package dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import conex.PoolConexiones;

public class KeysDAO {

	public static int siguienteId(String tabla)
	{
		int id = 0;
		String sql = "SELECT max(id) FROM ?";
        try {
            Connection con =  PoolConexiones.getConnection();
            PreparedStatement st = con.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS);
            st.setString(1, tabla);
            st.executeUpdate();
            
            ResultSet rs = st.getGeneratedKeys();
            if(rs.next())
                id = rs.getInt(1);
            
            id++;
            rs.close();
            st.close();
            con.close();
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
        }
        
        return id;
	}
	
}
