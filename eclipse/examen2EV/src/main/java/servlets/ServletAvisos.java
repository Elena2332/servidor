package servlets;

import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import beans.Actividad;
import beans.Alumno;
import beans.Impartidor;
import dao.ActividadesDAO;
import dao.AlumnosDAO;
import dao.ImpartidoresDAO;
import dao.ParticiparDAO;

/**
 * Servlet implementation class ServletAvisos
 */
public class ServletAvisos extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public ServletAvisos() {
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
		//SESSION
		HttpSession session = request.getSession(true);
		Impartidor impartidor = (Impartidor) request.getAttribute("impartidor");
		
		if(impartidor != null)
		{
			session.setAttribute("impartidor", impartidor);
			ArrayList<Actividad> actividades = ActividadesDAO.getActividadesImpartidor(impartidor.getId());
			session.setAttribute("actividadesImpartidor", actividades);
		}
		else
			impartidor = (Impartidor) session.getAttribute("impartidor");
		
		
		//ASISTENCIA
		if(request.getParameter("asistencia") != null)
		{
			String idActividad = request.getParameter("asistencia");
			HashMap<Alumno,String> alumnos = ActividadesDAO.mapaAsistenciaActividad(idActividad);
			session.setAttribute("alumnosActividad", alumnos);
		}
		else
			session.setAttribute("alumnosActividad", new HashMap<Alumno,String>());
		

		
		//AVISO
		if(request.getParameter("tipo") != null  && request.getParameter("btnAvisar") != null)
		{
			String dni = request.getParameter("btnAvisar");
			String tipo = request.getParameter("tipo");
			
			
		}
		
		
		
		request.getRequestDispatcher("impartidor.jsp").forward(request, response);    // va a impartidor.jsp
	}
		
}
