<%@page import="java.util.HashMap"%>
<%@page import="java.util.ArrayList"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Compra jsp</title>
</head>
<body>
    <%
    	ArrayList <String> productos = (ArrayList<String>) session.getAttribute("productos");
	    HashMap<String, Integer> carro = (HashMap<String, Integer>) session.getAttribute("carro");
	    if (carro == null) {
	    	carro = new HashMap();
	    }
	    if (request.getParameter("carro") != null) {
	        String producto = request.getParameter("compra");
	        if (!carro.containsKey(producto)) {
	        	carro.put(producto, 1);
	        } else {
	        	carro.put(producto, carro.get(producto)  + 1);
	        }
	    }
	    session.setAttribute("carro", carro);
	%>
	
	<table>
		<tr>
			<th>PRODUCTO</th>
			<th>PEDIR</th>
		</tr>
		<%
		String ruta =  getServletContext().getContextPath()+"/";
			for (String producto:productos)
			{
				 out.print("<tr>");
                 out.print("<td>" + producto + "</td>");
                 out.print("<td><form action='" +ruta + "compra.jsp' method='get'>");
                 out.print("<input type='submit' value='Adquirir unidad'>");
                 out.print("<input type='hidden' name='compra' value='" + producto + "'>");
                 out.print("</form></td>");
                 
                 if (carro.containsKey(producto))
                 	out.print("<td>" +carro.get(producto) + " unidades</td>");                     
                 out.print("</tr>");

			}
		%>
	</table>
	
	<jsp:include page="/carro.jsp"></jsp:include>
</body>
</html>