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
		<h2>Lista Autores</h2>	
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
		
		<h2>Añadir Autor</h2>
		<form action="ServletAutores" method="post">
		<table>
			<tr>
				<td>Nombre:</td>
				<td><input type="text" name="inpNom"></td>
			</tr>
			<tr>
				<td>Fecha nacimiento:</td>
				<td><input type="text" name="inpFechaNac" ></td>
			</tr>
			<tr>
				<td>Nacionalidad:</td>
				<td><input type="text" name="inpNaci" ></td>
			</tr>
			<tr>
				<td colspan=2><input type="submit" name="insertarAutor" value="Anadir"></td>
			</tr>
		</table>
            
        </form>
	</body>
</html>