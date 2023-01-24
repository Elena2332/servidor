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
 * Servlet implementation class ServletNuevaCuenta
 */
@WebServlet("/ServletNuevaCuenta")
public class ServletNuevaCuenta extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public ServletNuevaCuenta() {
        super();
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		response.sendRedirect("nuevacuenta.jsp");
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		//doGet(request, response);
		String titular = request.getParameter("titular");
		String saldo = request.getParameter("saldo");
		ArrayList<String> listaProhibidos = new ArrayList<String>();
		listaProhibidos.add("Diego");
		listaProhibidos.add("Sara");
		listaProhibidos.add("Carla");
		listaProhibidos.add("Elena");
		listaProhibidos.add("Jose");
		String mensajeError = "";
		HttpSession session;
		
		if (titular.equals("")) {
			mensajeError = "Campo del titular vacío!";
			request.setAttribute("mensajeError", mensajeError);
			request.getRequestDispatcher("nuevacuenta.jsp").forward(request, response);
		} else {
			if (listaProhibidos.contains(titular)) {
				mensajeError = titular + " no puede crear cuentas!";
				request.setAttribute("mensajeError", mensajeError);
				request.getRequestDispatcher("nuevacuenta.jsp").forward(request, response);
			} else {
				if (saldo.equals("")) {
					mensajeError = "Campo del saldo vacío!";
					request.setAttribute("mensajeError", mensajeError);
					request.getRequestDispatcher("nuevacuenta.jsp").forward(request, response);
				} else {
					if (Integer.parseInt(saldo) < 0) {
						mensajeError = "Saldo inferior a 0!";
						request.setAttribute("mensajeError", mensajeError);
						request.getRequestDispatcher("nuevacuenta.jsp").forward(request, response);
					} else {
						session = request.getSession(true);
						session.setAttribute("titular", titular);
						session.setAttribute("saldo", saldo);
						response.sendRedirect("movimientos.jsp");
					}
				}
			}
		}
	}

}