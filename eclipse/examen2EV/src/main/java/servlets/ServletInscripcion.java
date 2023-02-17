package servlets;

import java.io.IOException;
import java.util.ArrayList;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import beans.Actividad;
import beans.Alumno;
import dao.ActividadesDAO;
import dao.ParticiparDAO;

/**
 * Servlet implementation class ServletInscripcion
 */
public class ServletInscripcion extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public ServletInscripcion() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		//response.getWriter().append("Served at: ").append(request.getContextPath());
		processRequest(request, response);

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
		HttpSession session = gestionarSession(request);
		ArrayList<Integer> inscripciones = (ArrayList<Integer>) session.getAttribute("inscripciones");
		Alumno alumno = (Alumno) session.getAttribute("alumno");

		
		// APUNTAR actividades
		if(request.getParameter("apuntar") != null)
		{
			Integer actividad = Integer.parseInt(request.getParameter("apuntar"));			
			inscripciones.add(actividad);
			session.setAttribute("inscripciones", inscripciones);		
			session.setAttribute("cambios", inscripciones.size());
			//System.out.println(inscripciones.size());
		}
		
		//DESAPUNTAR actividades
		if(request.getParameter("quitar") != null)
		{
			Integer actividad = Integer.parseInt(request.getParameter("quitar"));
			inscripciones.remove(actividad);
			session.setAttribute("inscripciones", inscripciones);
			session.setAttribute("cambios", inscripciones.size());
			//System.out.println(inscripciones.size());
		}
		
		
		// INSCRIPCIONES
		if(request.getParameter("inscribir") != null  &&  inscripciones.size()>0)
		{
			for(Integer id : inscripciones)
			{
				Actividad actividad = ActividadesDAO.getActividad(String.valueOf(id));
				ParticiparDAO.inscribir(alumno, actividad);
			}
		}
		
		gestionarSession(request);    // actualizar atributos de la sesion
		request.getRequestDispatcher("alumno.jsp").forward(request, response);    // va a alumno.jsp

	}
	
	
	private HttpSession gestionarSession(HttpServletRequest request)
	{
		HttpSession session = request.getSession(true);
		Alumno alumno = (Alumno) request.getAttribute("alumno");
		if(alumno != null)
			session.setAttribute("alumno", alumno);
		else
			alumno = (Alumno) session.getAttribute("alumno");
		
		session.setAttribute("actividadesCursadas", ActividadesDAO.obtenerActividadesParticipa(alumno.getDni()));
		session.setAttribute("actividadesPosibles", ActividadesDAO.obtenerActividadesLibresNoParticipa(alumno.getDni()));
		
		if(session.getAttribute("inscripciones") == null)
			session.setAttribute("inscripciones", new ArrayList<Integer>());    // id de las actividades que se va a apuntar
		ArrayList<Integer> inscripciones = (ArrayList<Integer>) session.getAttribute("inscripciones");
		session.setAttribute("cambios", inscripciones.size());
		return session;
	}
	
}
