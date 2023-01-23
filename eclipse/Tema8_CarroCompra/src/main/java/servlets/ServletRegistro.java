package servlets;

import java.io.IOException;

import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import beans.Cliente;
import dao.ClienteDAO;
import dao.KeysDAO;
import dao.PedidoDAO;

/**
 * Servlet implementation class ServletRegistro
 */
@WebServlet(name = "ServletRegistro", urlPatterns = {"/ServletRegistro"})
public class ServletRegistro extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
	 @Override
	    public void init(ServletConfig config) throws ServletException {
	        super.init(config);
	    }	
	

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		//response.getWriter().append("Served at: ").append(request.getContextPath());
		processRequest(request, response);
	}


	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}
	
	
	
	protected void processRequest(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException
	{

		// validar usuario
		boolean res = false;
		String usuario = request.getParameter("inpUser");
		String pass = request.getParameter("inpPass");
		String domicilio = request.getParameter("inpDomi");
		String cp = request.getParameter("inpCP");
		String telf = request.getParameter("inpTelf");
		String email = request.getParameter("inpEmail");
		if(!usuario.equals("") && !pass.equals("") && !domicilio.equals("") && !cp.equals("") && !telf.equals("") && !email.equals(""))  
		{
			if(!ClienteDAO.buscaCliente(usuario))     // usuario no exise,  insertar
			{
				Cliente cliente = new Cliente(KeysDAO.siguienteId("clientes"),usuario,pass,domicilio,cp,telf,email);
				res = ClienteDAO.guardarCliente(cliente);
			}
			else
				request.getSession().setAttribute("mensaje", "usuario ya existente");    // usuario existente
		}
		else
			request.getSession().setAttribute("mensaje", "rellena todos los campos");    // campos vacios
		
		if(res)  // usuario correcto
		{
			request.getSession().setAttribute("mensaje", "usuario creado correctamente");
	        request.getRequestDispatcher("login.jsp").forward(request, response);   // va a login.jsp
		}
		else  
			request.getRequestDispatcher("registro.jsp").forward(request, response);    // vuelve a registro.jsp
	}

}
