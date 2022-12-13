package servlets;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;

import javax.servlet.ServletContext;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import beans.Catalogo;

/**
 * Servlet implementation class servletLibros
 */
@WebServlet(name="ServletLibros", urlPatterns = "/ServletLibros")
public class ServletLibros extends HttpServlet {
	private static final long serialVersionUID = 1L;
	private ArrayList<String> seleccionados;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public ServletLibros() {
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

	
	
	//se ejecuta al entrar en la pagina (lo que deberian hacer doGet y doPost)
	protected void processRequest(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException 
	{        
        final ServletContext context = getServletContext();  
          

        response.setContentType("text/html;charset=UTF-8");        
        try (PrintWriter out = response.getWriter())   // out permite escribir el html
        {
        	String titulo = "No se han elegido libros";
        	String error = "";

        	
            HttpSession session = request.getSession(false);  // false: si no esta creasa la crea y devuelve null
        	
        	if(request.getParameter("btnCerrar") != null)
        	{
        		request.getSession().invalidate();
        		session = null;
        		//session = request.getSession(true);  // crea la sesion         		
        	}
        
            if(session == null) //no habia session creada 
            {
            	session = request.getSession(true);  // crea la sesion si no esta creada
            	seleccionados = new ArrayList<String>();
            	session.setAttribute("seleccionados", seleccionados);
            }
            else  //retoma la sesion
            {
            	
            	String libro = request.getParameter("selLibros"); 
            	ArrayList<String> listaSeleccionados = (ArrayList<String>) session.getAttribute("seleccionados");
            	if(!listaSeleccionados.contains(libro) && request.getParameter("btnAgregar") != null)  //aniadir libro
            	{
            		listaSeleccionados.add(libro);
            	}
            	else // error libro existente
            	{
            		error = "Ya has elegido "+libro;
            	}
                titulo = "TU ELECCION:";
            }
                        
        	dibujar(request, response,session, out, titulo, error);  //dibujar la pantalla
        }
    }
	
	
	// devuelve la URL ("http://localhost:8080/Tema6_Ejercicio0/") hay que concatenarle el servlet 
    private static String baseUrl(HttpServletRequest req)
    {
        StringBuffer url = req.getRequestURL();
        String uri = req.getRequestURI();
        String context = req.getContextPath();
        return url.substring(0, url.length() - uri.length() + context.length()) + "/";
    }
    
    
    
	// crea el html de la pagina
	public void dibujar(HttpServletRequest request, HttpServletResponse response, HttpSession session, PrintWriter out, String h1, String error)
	{
		//Catalogo catalogo = new Catalogo();
		String[] titulos = Catalogo.getTitulos();
		
		out.print("<!DOCTYPE html> <html> <head></head> <body>");
		
		//formulario
		out.print("<form action='"+ baseUrl(request) + "ServletLibros' method='post'>");
		out.print("<select name='selLibros'>");
		for(String tit:titulos)  //llenar select de libros
		{
			if(tit.equals(request.getParameter("selLibros")))
				out.print("<option value='"+tit+"' selected>"+tit+"</option>");
			else
				out.print("<option value='"+tit+"'>"+tit+"</option>");
		}
		out.print("</select>");
		out.print("<button name='btnAgregar'>AGREGAR</button>");
		out.print("<button name='btnCerrar'>Cerrar Sesion</button>");
		out.print("</form>");
		
		//error
		if(error.length()>0)
			out.print("<p style='color:red'>"+error+"</p>");
		
		//listado
		out.print("<h1>"+h1+"</h1>");
		out.print("<ul>");

		seleccionados = (ArrayList<String>) session.getAttribute("seleccionados");
		
		for(String libro : seleccionados)
			out.print("<li>"+libro+"</li>");
		out.print("</ul>");
	}
}
