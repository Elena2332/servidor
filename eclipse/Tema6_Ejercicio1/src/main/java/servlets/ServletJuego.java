package servlets;

import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletContext;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import beans.AlamacenPalabras;


/**
 * Servlet implementation class ServletJuego
 */
@WebServlet(name="ServletJuego", urlPatterns = "/ServletJuego")
public class ServletJuego extends HttpServlet {
	private static final long serialVersionUID = 1L;
	private int vidas;
	private String palabra;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public ServletJuego() {
        super();
        palabra = AlamacenPalabras.getPalabra();
        vidas = Math.round(palabra.length()/2);
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
	

	
	
	// devuelve la URL ("http://localhost:8080/Tema6_Ejercicio1/") hay que concatenarle el servlet 
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
        final ServletContext context = getServletContext();  
        
        response.setContentType("text/html;charset=UTF-8");        
        try (PrintWriter out = response.getWriter())   // out permite escribir el html
        {
        	dibujar(request, response, out);  //dibujar la pantalla
        }
    }
    
    
	// crea el html de la pagina
	public void dibujar(HttpServletRequest request, HttpServletResponse response, PrintWriter out)
	{
		
		
		out.print("<!DOCTYPE html> <html> <head><title>Ahorcado xD</title></head> <body>");
		
		//formulario
		out.print("<form action='"+ baseUrl(request) + "ServletLibros' method='post'>");
		out.print("<table><tr>");
		for(int i=0; i<palabra.length() ;i++)
		{
			out.print("<td><a href='"+ baseUrl(request) + "'>Ver</a><td>");
		}
		
		out.print("</form>");
		
	}

}
