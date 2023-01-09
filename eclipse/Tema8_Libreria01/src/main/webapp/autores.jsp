<%@page import="beans.Autor"%>
<%@page import="java.util.Set"%>
<%@page import="java.util.HashMap"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
    
<%!

%>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>autores</title>
	</head>
	<body>
		<h1>Lista Autores</h1>	
		<table>
			<tr>
				<th>Nombre</th>
				<th>Fecha Nacimiento</th>
				<th>Nacionalidad</th>
				<th>Ver Libros</th>
			</tr>
			<%
				String txtHtml = "";
				HashMap<Integer, Autor> autores = (HashMap<Integer, Autor>) session.getAttribute("autoresDatos");
				System.out.println(autores);
				Set<Integer> keys = autores.keySet();
				for(int id : keys)
				{
					txtHtml += "<tr>";
					Autor autor = autores.get(id);
					txtHtml += "<td>"+autor.getNombre()+"</td>";
					txtHtml += "<td>"+autor.getFechanac()+"</td>";
					txtHtml += "<td>"+autor.getNacionalidad()+"</td>";
					txtHtml += "<td><a href='ServletAutor?idAutor="+id+"'>Ver Libros</a></td>";
					txtHtml += "</tr>";
				}
			%>
			<%= txtHtml %>
		</table>
	</body>
</html>