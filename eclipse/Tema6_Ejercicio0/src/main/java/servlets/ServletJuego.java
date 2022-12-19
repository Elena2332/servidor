package servlets;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import beans.AlamacenPalabras;


/**
 * Servlet implementation class ServletJuego
 */
@WebServlet(name="ServletJuego", urlPatterns = "/ServletJuego")
public class ServletJuego extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public ServletJuego() {
        super();
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		processRequest(request,response);
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
    

	//se ejecuta al entrar en la pagina (lo que deberian hacer doGet y doPost)
	protected void processRequest(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException 
	{        
        response.setContentType("text/html;charset=UTF-8");        
        try (PrintWriter out = response.getWriter())   // out permite escribir el html
        {
            HttpSession session = request.getSession(false);  // false: si no esta creada la crea y devuelve null
            if(session == null) //no habia session creada 
            {
            	session = request.getSession(true);  // crea la sesion si no esta creada
                String palabra = AlamacenPalabras.getPalabra().toUpperCase();
                int vidas = Math.round(palabra.length()/2);
            	ArrayList<Integer> revelados = new ArrayList<Integer>();
            	session.setAttribute("palabra", palabra);
            	session.setAttribute("vidas", vidas);
            	session.setAttribute("revelados", revelados);            	
            }
            
            
            dibujar(request, response, out, session);  //dibujar la pantalla
        }
        catch (Exception e) {
			// TODO: handle exception
        	System.out.println(e.toString());
		}
    }
    
    
	// crea el html de la pagina
	public void dibujar(HttpServletRequest request, HttpServletResponse response, PrintWriter out, HttpSession session)
	{	
		String palabra = (String) session.getAttribute("palabra");
		int vidas = (Integer) session.getAttribute("vidas");
		ArrayList<Integer> revelados = (ArrayList) session.getAttribute("revelados");
		
		out.print("<!DOCTYPE html> <html> <head><title>Ahorcado xD</title></head> <body>");
		
		//formulario
		String url = baseUrl(request);
		out.print("<form action='"+ url + "ServletComprobar' method='post'>");
		out.print("<table><tr>");
		for(int i=0; i<palabra.length() ;i++)
		{
        	if(revelados.contains(i))
        		out.print("<td>"+palabra.charAt(i)+"<td>");
        	else
        		out.print("<td><a href='"+ url + "ServletComprobar?pos="+i+"'>Ver</a><td>");
		}
		out.print("</tr></table>");
		out.print("<p>- "+vidas+" vidas restantes</p>");
		out.print("<p>- Tu respuesta <input type='text' name='inpRes'/><button type='submit' name='btnComprobar'>Comprobar</button></p>");
		out.print("</form>");
		
	}

}
