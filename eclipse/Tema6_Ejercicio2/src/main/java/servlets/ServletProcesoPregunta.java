package servlets;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import beans.Test;

/**
 * Servlet implementation class ServletProcesoPregunta
 */
public class ServletProcesoPregunta extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public ServletProcesoPregunta() {
        super();
        // TODO Auto-generated constructor stub
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
	
	
	protected void processRequest(HttpServletRequest request, HttpServletResponse response)
	{
		HttpSession session = request.getSession(false);   
		if(session == null)  // inicializar la sesion
		{
			session = request.getSession(true);
			
			Test test = new Test(0);
			boolean quierePista = true;
			
			session.setAttribute("jugador", "");
			session.setAttribute("test", test);
			session.setAttribute("quierePista", quierePista);
		}
		
		
		dibujar(request,response, session);
	}
	
	
	public void dibujar(HttpServletRequest request, HttpServletResponse response, HttpSession session)
	{
		
		
	}

}
