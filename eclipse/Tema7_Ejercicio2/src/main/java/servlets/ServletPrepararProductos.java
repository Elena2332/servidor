package servlets;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 * Servlet implementation class ServletPrepararProductos
 */
@WebServlet("/ServletPrepararProductos")
public class ServletPrepararProductos extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public ServletPrepararProductos() {
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
	
	

	
	protected void processRequest(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException 
	{  
		// categorias
		String cat = request.getParameter("cate");
		HashMap<String,ArrayList<String>>productos = obtenerContenido(request,cat);	
		
		//session
		HttpSession session = request.getSession(false);
		if(session == null)  // crear la sesion
			session = request.getSession(true);
		session.setAttribute("productos", productos);
		
		// al jsp
		response.sendRedirect("compra.jsp");
	}
	
	private HashMap<String,ArrayList<String>> obtenerContenido(HttpServletRequest request, String cate)
	{
		try 
		{	
			HashMap<String,ArrayList<String>>categorias = new HashMap<String,ArrayList<String>>();	
			String fich = request.getServletContext().getRealPath("productos.txt");	
			BufferedReader bf = new BufferedReader(new FileReader(fich));
			String linea = bf.readLine();
	        while(linea != null)
	        {
	            String[] lin = linea.split(";");
	            if(cate == null)   // todas las categorias
	            {
	            	ArrayList<String> valor = categorias.get(lin[0]);
		            if(valor == null)  // categoria nueva
		            {
		            	valor = new ArrayList<String>();
		            	valor.add(lin[1]);
		            	categorias.put(lin[0], valor);
		            }
		            else   // aniadir el valor a la categoria
		            {
		            	valor.add(lin[1]);
		            	categorias.put(lin[0], valor);
		            }
	            }
	            else  // una categoria en concreto
	            {
	            	if(cate.equals(lin[0]))   // aniadir al array
	            	{
	            		
	            	}
	            }
	            
	        	linea = bf.readLine();
	        } 	        
	        bf.close();
	        return categorias;
		}
		catch(Exception e)
		{
			System.out.print(e.getMessage());
			return null;
		}
	}
}
