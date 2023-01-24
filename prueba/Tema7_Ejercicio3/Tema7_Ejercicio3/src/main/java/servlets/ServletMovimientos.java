package servlets;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import beans.Cuenta;

/**
 * Servlet implementation class ServletMovimientos
 */
@WebServlet("/ServletMovimientos")
public class ServletMovimientos extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public ServletMovimientos() {
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
		
		HttpSession session = request.getSession(true);
		
		if (request.getParameter("procesar") != null) {
			
			String titular = (String) session.getAttribute("titular");
			int saldo = Integer.parseInt((String) session.getAttribute("saldo"));
			String cantidad = request.getParameter("cantidad");
			Cuenta cuenta = new Cuenta(titular, saldo);
			
			if (isNumeric(cantidad) == true) {
				if (request.getParameter("procesar").equals("ingresar")) {
					cuenta.ingresar(Integer.parseInt(cantidad));
					int saldoActual = cuenta.getSaldo();
					session.setAttribute("saldo", saldoActual+"");
					response.sendRedirect("movimientos.jsp");
				}
				
				if (request.getParameter("procesar").equals("gastar")) {
					boolean gastado = cuenta.gastar(Integer.parseInt(cantidad));
					
					if (gastado) {
						int saldoActual = cuenta.getSaldo();
						session.setAttribute("saldo", saldoActual+"");
						response.sendRedirect("movimientos.jsp");
					} else {
						String mensajeError = "La cuenta sólo dispone de " + cuenta.getSaldo() + "€";
						request.setAttribute("mensajeError", mensajeError);
						request.getRequestDispatcher("movimientos.jsp").forward(request, response);
					}
				}		
			} else {
				String mensajeError = "La cantidad que se ha introducido no es válida";
				request.setAttribute("mensajeError", mensajeError);
				request.getRequestDispatcher("movimientos.jsp").forward(request, response);
			}	
		}
		
	}
	
	public static boolean isNumeric(String cadena) {

        boolean resultado;

        try {
            Integer.parseInt(cadena);
            resultado = true;
        } catch (NumberFormatException excepcion) {
            resultado = false;
        }

        return resultado;
    }

}
