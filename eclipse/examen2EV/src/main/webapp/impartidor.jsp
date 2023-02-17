<%@page import="java.util.HashMap"%>
<%@page import="dao.ParticiparDAO"%>
<%@page import="beans.Alumno"%>
<%@page import="beans.Actividad"%>
<%@page import="java.util.ArrayList"%>
<%@page import="beans.Impartidor"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
	pageEncoding="ISO-8859-1"%>
	
<%
	Impartidor impartidor = (Impartidor) session.getAttribute("impartidor");
	ArrayList <Actividad> actividades= (ArrayList <Actividad>) session.getAttribute("actividadesImpartidor");
	HashMap <Alumno,String> alumnos = (HashMap <Alumno,String>) session.getAttribute("alumnosActividad");
%>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF8">
	<link rel="stylesheet" type="text/css" href="css/estilos.css" />
	<title>IMPARTIDOR</title>
</head>
<body>
	<div id="header">
		<h1>APLICACIÓN ACTIVIDADES</h1>
	</div>
	<div id=menu>
		<h2>IMAPRTIDOR</h2>
	</div>
	<div id="container">
		<p><%=impartidor.getApellido()%>  <%=impartidor.getNombre()%></p>
		<hr>
		<table>
			<%
				for (Actividad acti : actividades)
				{
					if(request.getParameter("asistencia") != null && request.getParameter("asistencia").equals(acti.getId()))
						out.println("<tr style='background-color: grey;'>");					
					else
						out.println("<tr>");
					
					out.println("<td>" + acti.getNombre() + "</td>");
					out.println("<td><a href='ServletAvisos?asistencia="+acti.getId()+"'>ASISTENCIA</a> </td></tr>");
				}
			%>
		</table>

		<form action="ServletAvisos">
		<%		
			if(alumnos.size() > 0)
			{
				out.println("<table>");
				out.println("<tr><th>Nombre</th><th>Ultima asistencia</th><th>Tipo de aviso</th><th></th></tr>");
				for(Alumno al : alumnos.keySet())
				{
					String[] arr = {al.getDni(),alumnos.get(al)};
					out.println("<tr>");
						out.println("<td>"+al.getNombre()+" "+al.getApellidos()+"</td>");
						out.println("<td>"+alumnos.get(al)+"</td>");
						out.println("<td> <input type='radio' value='email' name='tipo' checked>Email   <input type='radio' value='telf' name='tipo'>Telefono</td>");
						out.println("<td> <button type='submit' value='"+al.getDni()+"' name='btnAvisar'>Avisar</button> </td>");
					out.println("</tr>");
				}
				out.println("</table>");
			}
		%>
		</form>
	</div>
</body>
</html>