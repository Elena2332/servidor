<%@page import="beans.Actividad"%>
<%@page import="java.util.ArrayList"%>
<%@page import="beans.Impartidor"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
	pageEncoding="ISO-8859-1"%>
<%
	Impartidor impartidor = (Impartidor) session.getAttribute("impartidor");
	ArrayList <Actividad> actividadesImpartidor= (ArrayList <Actividad>) session.getAttribute("actividadesImpartidor");
%>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF8">
	<title>IMPARTIDOR</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css" />
</head>
<body>
	<div id="header">
		<h1>APLICACIÓN ACTIVIDADES</h1>
	</div>
	<div id=menu>
		<h2><%=impartidor.getApellido()%>
			<%=impartidor.getNombre()%></h2>
	</div>
	<div id="container">
		<table>
			<%
				for (Actividad a : actividadesImpartidor){
					if(request.getParameter("asistencia") != null && request.getParameter("asistencia").equals(a.getId())){
						out.println("<tr style='background-color: yellow;'>");
					}
					else{
						out.println("<tr>");
					}
					
					out.println("<td>" + a.getNombre() + "</td>");
					out.println("<td><a href='servletAvisos?asistencia="+a.getId()+"'>ASISTENCIA</a> </td></tr>");
				}
			%>
		</table>

	</div>
</body>
</html>