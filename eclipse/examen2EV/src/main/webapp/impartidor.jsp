<%@page import="dao.ImpartidoresDAO"%>
<%@page import="beans.Actividad"%>
<%@page import="java.util.ArrayList"%>
<%@page import="beans.Impartidor"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
    
<%!
	
%>
    
    
<%
	Impartidor impartidor = (Impartidor) session.getAttribute("impartidor");
	ArrayList<Actividad> actividades = ImpartidoresDAO.getActividades(impartidor.getId());

%>
    
    
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF8">
		<title>Imaprtidor</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
	</head>
	<body>
		<div id="header">
            <h1>APLICACIÓN ACTIVIDADES</h1>
        </div>
        <div id=menu>
        	<h2>IMPARTIDORES</h2>
        </div>
        <div id="container">
        	
			<!-- Introduce el contenido de la pantalla de Impartidores -->
			<p>SOCIO: <%= impartidor.getNombre() %> <%= impartidor.getApellido() %></p>
			<hr> 			
			<table>
				<%
					for (Actividad acti : actividades)
					{
						 out.print("<tr>");
		                 out.print("<td>" + acti.getNombre() + "</td>");
		                 out.print("<td><a href='imartidor.jsp?actividad="+acti.getId()+"'>ASISTENCIA</a>");                  
		                 out.print("</tr>");	
					}
				%>
			</table>
		</div>
	</body>
</html>