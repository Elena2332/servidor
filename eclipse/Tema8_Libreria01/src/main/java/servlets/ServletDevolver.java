package servlets;

import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;

import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import beans.Libro;
import beans.Prestamo;
import dao.GestorBD;

/**
 * Servlet implementation class ServletDevolver
 */
@WebServlet(name = "ServletDevolver", urlPatterns = {"/ServletDevolver"})
public class ServletDevolver extends HttpServlet {
	private static final long serialVersionUID = 1L;
	private GestorBD gestor;

	 @Override
	    public void init(ServletConfig config) throws ServletException {
	        super.init(config);
	        gestor =  new GestorBD();
	    }	

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		//response.getWriter().append("Served at: ").append(request.getContextPath());
		processRequest(request,response);

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
		// SESION
		HttpSession session = request.getSession(true);
		HashMap<Libro,Integer[]> prestamos = gestor.filtrarPrestamos(gestor.sacarPrestamos());   // prestamos sin libros repetidos
        request.getSession().setAttribute("prestamos", prestamos);
        request.getRequestDispatcher("devoluciones.jsp").forward(request, response);
        
        //almacenar todos los prestamos
        //request.getSession().setAttribute("prestamos", gestor.prestamos());
	}

}
