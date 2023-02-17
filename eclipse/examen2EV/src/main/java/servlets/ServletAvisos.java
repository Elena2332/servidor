package servlets;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileOutputStream;
import java.io.FileWriter;
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
			String[] arr = request.getParameter("btnAvisar").split("-_-");
			String dni = arr[0];
			String tipo = request.getParameter("tipo");
			String fecha = arr[1];
			apuntarAviso(dni,fecha,tipo);   // escribe en el fichero
			
		}
		
		
		
		request.getRequestDispatcher("impartidor.jsp").forward(request, response);    // va a impartidor.jsp
	}
		
	public void apuntarAviso(String dni,String fecha, String tipo)
	{
		// Escribir en el fichero
		String txt = dni+"-"+fecha+"-"+tipo;
		String ruta = "avisos.txt";
		try {
			File file = new File(ruta);
	        if (!file.exists())    // Si el archivo no existe se crea
	            file.createNewFile();
	        
	        // escribir sin borrar
	        FileWriter fw = new FileWriter(file, true);
	        BufferedWriter bw = new BufferedWriter(fw);
	        bw.write(txt);

            bw.close();
	 	}
		 catch (Exception e) 
        {
	 		System.out.println("Error en apuntarAviso()");
	 		e.printStackTrace();
        }
		
		
	}
}
