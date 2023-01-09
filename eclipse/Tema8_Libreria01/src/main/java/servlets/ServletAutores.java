package servlets;

import java.io.IOException;

import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import dao.GestorBD;

/**
 * Servlet implementation class ServletAutores
 */
@WebServlet(name = "ServletAutores", urlPatterns = {"/ServletAutores"})
public class ServletAutores extends HttpServlet {
	private static final long serialVersionUID = 1L;
	private GestorBD gestor;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public ServletAutores() {
        super();
        // TODO Auto-generated constructor stub
        gestor =  new GestorBD();
        
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		//response.getWriter().append("Served at: ").append(request.getContextPath());
		HttpSession session = request.getSession(false);
		if(session == null)  // hay que crear la sesion
		{
			session = request.getSession(true);
	        //request.getSession().setAttribute("libros", gestor.libros());
	        request.getSession().setAttribute("autoresDatos", gestor.datosAutores());
		}
		session = request.getSession(true);
        request.getRequestDispatcher("autores.jsp").forward(request, response);
		processRequest(request,response,session);
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

	
	protected void processRequest(HttpServletRequest request, HttpServletResponse response, HttpSession session)
	{
		
	}
	
}
