package servlets;

import java.io.IOException;
import java.util.ArrayList;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 * Servlet implementation class ServletComprobar
 */
@WebServlet("/ServletComprobar")
public class ServletComprobar extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public ServletComprobar() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		//response.getWriter().append("Served at: ").append(request.getContextPath());
		comprobar(request,response);
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}
	
	// devuelve la URL ("http://localhost:8080/Tema6_Ejercicio0/") hay que concatenarle el servlet 
    private static String baseUrl(HttpServletRequest req)
    {
        StringBuffer url = req.getRequestURL();
        String uri = req.getRequestURI();
        String context = req.getContextPath();
        return url.substring(0, url.length() - uri.length() + context.length()) + "/";
    }
	
	
    
    
	public void comprobar(HttpServletRequest request, HttpServletResponse response)
	{
		HttpSession session = request.getSession(true);  //retoma la sesion
		
		if(request.getParameter("btnComprobar") != null)  // comprobar respuesta
    	{
    		String res = request.getParameter("inpRes").toUpperCase();
    		if(res != null && res.trim().length()>0)  // si la respuesta no esta vacia
    		{
    			session.setAttribute("final", null);  // el juego aun no termina
    			
    			if(res.equals(session.getAttribute("palabra")))  // acierta la palabra  termina el juego
    			{
    				session.setAttribute("final", true);  //gana
    			}
    			else  //falla la palabra
    			{
    				session.setAttribute("vidas", ((int)session.getAttribute("vidas")-1) );
    				if((int)session.getAttribute("vidas") == 0)  // termina el juego
    				{
        				session.setAttribute("final", false);  //pierde
    					
    				}
    			}
    		}
    	}
		
		// revelar letra		
    	if(request.getParameter("pos") != null)
    	{
    		Integer get = Integer.parseInt(request.getParameter("pos"));
    		ArrayList<Integer> revelados = (ArrayList) session.getAttribute("revelados");
    		if(!revelados.contains(get))
    		{
				session.setAttribute("vidas", ((int)session.getAttribute("vidas")-1) );
				revelados.add(get);
				session.setAttribute("revelados", revelados);
    		}
    	}
        
    	
    	try {
			response.sendRedirect(baseUrl(request)+"ServletJuego");
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
	
	
}
