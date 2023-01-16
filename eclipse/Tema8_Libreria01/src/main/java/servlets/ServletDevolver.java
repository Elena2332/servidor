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
import beans.LibroPrestado;
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
		ArrayList<LibroPrestado> prestamos = gestor.sacarPrestamos();   
        request.getSession().setAttribute("prestamos", prestamos);
        
        // DEVOLUCIONES
        ArrayList<String> devoluciones = new ArrayList<String>();   
        String idDev = String.valueOf(request.getParameter("devolver"));
        String idPres = String.valueOf(request.getParameter("revertir"));
        if(idDev != null)    //devolver libro
        	if(!devoluciones.contains(idDev))
        		devoluciones.add(idDev);
        else
        	if(idPres != null)    //descartar devolucion
            	devoluciones.remove(idPres);
        
        request.getSession().setAttribute("devoluciones", devoluciones);
        request.getRequestDispatcher("devoluciones.jsp").forward(request, response);
	}

}
