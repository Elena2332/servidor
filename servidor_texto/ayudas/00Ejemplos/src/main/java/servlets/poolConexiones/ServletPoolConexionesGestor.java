package servlets.poolConexiones;

import java.io.IOException;
import java.sql.Connection;
import java.util.ArrayList;

import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import beans.Item;
import beans.Puja;
import dao.webXml.GestorBDWebXml;

/**
 * @author Amaia
 * Servlet implementation class Index
 */
public class ServletPoolConexionesGestor extends HttpServlet {
	private static final long serialVersionUID = 1L;
	private Connection con;
	private GestorBDWebXml gestorBDXml;

	/**
	 * @see HttpServlet#HttpServlet()
	 */
	public ServletPoolConexionesGestor() {

	}

	@Override
	public void init(ServletConfig config) throws ServletException {
		super.init(config);
		gestorBDXml= new GestorBDWebXml();
	}

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
			
			// Obtener listado de Items
			obtenerListadoItems();
			
			// Obtener listado de Pujas
			obtenerListadoPujas();
			
			// Modificar nombre de pujas
			System.out.println(" Ha sido modificado el nombre de Monet por Manet, el numero de registros modificados es de :"+gestorBDXml.modificarNombrePujas());;
			
			
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}
	
	private void obtenerListadoItems() {
	
		ArrayList<Item> items=gestorBDXml.items();
		System.out.println("ID | ID_CAT | ID_USER  | NOMBRE | PRECIOPARTIDA | DESCRIPCION  | FECHAFIN  ");
		for(Item item: items) { 			
			System.out.println(item.getId()+" | "+item.getId_cat()+" | "+item.getId_user()+" | "+item.getNombre()+" | "+item.getPreciopartida()+" | "+item.getDescripcion()+" | "+item.getFechafin());
		}


	}
	
	private void obtenerListadoPujas() {
		
			ArrayList<Puja> pujas=gestorBDXml.pujas();

			System.out.println("ID | ID_ITEM | ID_USER  | CANTIDAD |  FECHAFIN  ");
			
			for(Puja puja: pujas) { 			
				System.out.println(puja.getId()+" | "+puja.getId_item()+" | "+puja.getId_user()+" | "+puja.getCantidad()+" | "+puja.getFecha());
			}

	}
	

}