<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@ taglib prefix="fmt" uri="http://java.sun.com/jsp/jstl/fmt" %>
<%@page import="beans.Autor"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>

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
			
			<c:if test="${autoresDatos == null}">
            	<jsp:forward page="ServletAutores"/>
	        </c:if>
	       
	        <c:forEach items="${autoresDatos}" var="autor">
	            <tr>
					<td>${autor.getNombre()}</td>
					<td><fmt:formatDate value="${autor.fechanac}" pattern="yyyy/MM/dd"/></td>
					<td>${autor.getNacionalidad()}</td>
				 	<td><a href='ServletAutores?idAutor=${autor.idAutor}'>Ver Libros</a></td>
				</tr>
        	</c:forEach>
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
					<td><input type="text" name="inpFechaNac"></td>
				</tr>
				<tr>
					<td>Nacionalidad:</td>
					<td><input type="text" name="inpNaci" ></td>
				</tr>
				<tr>
					<td colspan=2><input type="submit" name="insertarAutor" value="Anadir"></td>
				</tr>
			</table>  
			<c:if test="${autoresDatos == null}">
            	<p>${mensaje}</p>
	        </c:if>    			
        </form>
        
         <c:forEach items="${autoresDatos}" var="autor">
	         <c:if test="${autor.idAutor == param.idAutor}">         
	        	<h2>Libros de ${autor.nombre}</h2>
		            <ul>
		            	<c:forEach items="${librosAutor}" var="libro">
		            		<li><a href="">${libro.titulo}</a></li>
	            		</c:forEach>
		            </ul>
             </c:if>
       	 </c:forEach>
	</body>
</html>