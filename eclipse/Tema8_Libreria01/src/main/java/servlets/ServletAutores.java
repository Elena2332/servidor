package servlets;

import java.io.IOException;
import java.util.Date;

import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import beans.Autor;
import dao.GestorBD;

/**
 * Servlet implementation class ServletAutores
 */
@WebServlet(name = "ServletAutores", urlPatterns = {"/ServletAutores"})
public class ServletAutores extends HttpServlet {
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
        request.getSession().setAttribute("autoresDatos", gestor.datosAutores());
        request.getRequestDispatcher("autores.jsp").forward(request, response);
        
        //listar libros
        String id = request.getParameter("idAutor");
        if(id != null)
            request.getSession().setAttribute("librosAutor", gestor.librosAutor(id));        	
        
        //insertar autores
    	String mensaje = "";
        if(request.getParameter("insertarAutor") == null)
        {
        	//comprobaciones
        	if(!request.getParameter("inpNom").equals("") || !request.getParameter("inpFechaNac").equals("") || !request.getParameter("inpNaci").equals(""))
        	{
        		String nombre = request.getParameter("inpNom");
        		Date fecha = new Date(request.getParameter("inpFechaNac"));
        		String nacionalidad = request.getParameter("inpNaci");
        		Autor autorNuevo = new Autor(nombre,fecha,nacionalidad);
    			if(fecha.compareTo(new Date())<0)   //  fecha menor a la actual
    			{
    				int idNuevo = gestor.insertarAutor(autorNuevo);
    				if(idNuevo > 0)   //insertado sin problemas
    					mensaje = nombre+" añadido correctamente";
    				else
    				{
    					if(idNuevo == 0)   // autor ya existe
    						mensaje = "El autor "+nombre+" ya existe";
    					else
    						mensaje = "error al insertar en la base de datos";
    				}
    			}
    			else
    				mensaje = "formato de la fecha incorrecto";     			
        	}
        	else
        		mensaje = "Rellene todos los campos";
        }
        request.getSession().setAttribute("mensaje", mensaje);
	}
	
}
