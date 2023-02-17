package conex;

import java.sql.Connection;
import java.sql.SQLException;

import javax.naming.Context;
import javax.naming.InitialContext;
import javax.naming.NamingException;
import javax.sql.DataSource;

//import org.apache.tomcat.dbcp.dbcp2.BasicDataSource;

public final class ConexPoolBD {    
    private static  DataSource dataSource;
    
    /*
    static {  
        dataSource.setDriverClassName("com.mysql.cj.jdbc.Driver");                       
        dataSource.setUrl("jdbc:mysql://localhost/bdactividad");
        dataSource.setUsername("root");
        dataSource.setPassword("");
        
        //dataSource.setMaxTotal(12); 
        //dataSource.setMaxOpenPreparedStatements(80);  
    }*/

    public static Connection getConnection() throws SQLException {

    	try {
			InitialContext ctx = new InitialContext();
			Context env = (Context) ctx.lookup("java:comp/env");
			// nombre del recurso en el context.xml
			dataSource = (DataSource) env.lookup("jdbc/poolExamenDB");
    		
    	} catch (NamingException e) {
    		e.printStackTrace();
    		
    	}
    	//System.out.println(dataSource);
    	
        return dataSource.getConnection();         
    }    
}
