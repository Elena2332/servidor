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
		ArrayList<String> productos = productosPorCategoria(cat);
		
		//session
		HttpSession session = request.getSession(false);
		if(session == null)  // crear la sesion
			session = request.getSession(true);
		session.setAttribute("productos", productos);
		session.setAttribute("categoria", cat);
		
		// al jsp
		response.sendRedirect("compra.jsp");
	}
	
	public ArrayList<String> productosPorCategoria (String cat)
	{
		ArrayList<String> productos = new ArrayList<String>();
		String ruta = this.getServletContext().getRealPath("productos.txt");
		
		try  
		{
			BufferedReader reader = new BufferedReader(new FileReader(ruta));
			String linea = reader.readLine();
			while (linea != null)
			{
				String params[] = linea.split(";");
				if (!params[0].equals("-") && cat != null) 
				{
					if (cat.equals(params[0])) 
						productos.add(params[1]);					
				}
				else 
					productos.add(params[1]);				
			}
			return productos;
		} catch (Exception ex)
		{
            ex.printStackTrace();
            return null;
        }
	}
}
