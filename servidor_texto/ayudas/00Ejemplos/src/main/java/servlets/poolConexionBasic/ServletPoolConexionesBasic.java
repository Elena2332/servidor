package servlets.poolConexionBasic;

import java.io.IOException;
import java.sql.Connection;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import beans.Usuario;
import dao.UsuarioDao;


/**
 * @author Amaia
 * Servlet implementation class Index
 */
public class ServletPoolConexionesBasic extends HttpServlet {
	private static final long serialVersionUID = 1L;
	private Connection con;


	/**
	 * @see HttpServlet#HttpServlet()
	 */
	public ServletPoolConexionesBasic() {

	}

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
			
			String nombreUsuario= "admin";
			String password="admin";
			
			Usuario user= UsuarioDao.login(nombreUsuario, password);
			
			System.out.println("El usuario logueado es valido. Los datos de logueo son:");
			System.out.println(user.toString());
			
			String nombreUsuarioNoExiste= "admin2";
			String passwordNoExiste="admin";
			
			Usuario userNoExiste= UsuarioDao.login(nombreUsuarioNoExiste, passwordNoExiste);
			
			System.out.println("El usuario logueado NO es valido.");
			System.out.println(userNoExiste.toString());
			
			
			
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

}