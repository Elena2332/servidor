package servlets.poolConexiones;

import java.io.IOException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import javax.naming.Context;
import javax.naming.InitialContext;
import javax.naming.NamingException;
import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.sql.DataSource;

/**
 * @author Amaia Servlet implementation class Index
 */
public class ServletPoolConexiones extends HttpServlet {
	private static final long serialVersionUID = 1L;
	private Connection con;
	private DataSource ds;

	/**
	 * @see HttpServlet#HttpServlet()
	 */
	public ServletPoolConexiones() {

	}

	@Override
	public void init(ServletConfig config) throws ServletException {
		super.init(config);
		try {
			InitialContext ctx = new InitialContext();
			Context env = (Context) ctx.lookup("java:comp/env");
			// nombre del recurso en el context.xml
			ds = (DataSource) env.lookup("jdbc/poolSubastasDB");
		} catch (NamingException e) {
			e.printStackTrace();
		}
	}

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {

		// Obtener listado de Items
		obtenerListadoItems();

		// Obtener listado de Pujas
		obtenerListadoPujas();

		// Modificar nombre de pujas
		modificarNombrePujas();

	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

	private void obtenerListadoItems() {
		String sql = "SELECT * FROM ITEMS";
		try {
			con = ds.getConnection();
			PreparedStatement pstm = con.prepareStatement(sql);
			ResultSet rset = pstm.executeQuery();
			System.out.println("ID | ID_CAT | ID_USER  | NOMBRE | PRECIOPARTIDA | DESCRIPCION  | FECHAFIN  ");
			while (rset.next()) {
				System.out.println(
						rset.getInt(1) + " | " + rset.getInt(2) + " | " + rset.getInt(3) + " | " + rset.getString(4)
								+ " | " + rset.getString(5) + " | " + rset.getString(6) + " | " + rset.getDate(7));
			}

			con.close();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}

	private void obtenerListadoPujas() {

		String sql = "SELECT * FROM PUJAS";
		try {
			con = ds.getConnection();
			PreparedStatement pstm = con.prepareStatement(sql);
			ResultSet rset = pstm.executeQuery();
			System.out.println("ID | ID_ITEM | ID_USER  | CANTIDAD |  FECHAFIN  ");
			while (rset.next()) {
				System.out.println(rset.getInt(1) + " | " + rset.getInt(2) + " | " + rset.getInt(3) + " | "
						+ rset.getString(4) + " | " + rset.getDate(5));
			}

			con.close();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}

	private void modificarNombrePujas() {
			
			String sql = "UPDATE ITEMS SET NOMBRE = 'MANET' WHERE NOMBRE LIKE 'MONET%' ";
			try {
				con = ds.getConnection();
				int resultado=0;

					Statement pstm = con.createStatement();
					resultado = pstm.executeUpdate(sql);
					
					pstm.close();
					con.close();
					
			
				System.out.println(" Ha sido modificado el nombre de Monet por Manet, el numero de registros modificados es de :"+resultado);
				
				con.close();
			} catch (SQLException e) {
				e.printStackTrace();
			}

	}

}