<%@page import="beans.LibroPrestado"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
        
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Prestamos-devoluciones</title>
</head>
<body>
	<a href="index.jsp"> &#60;-- Volver </a>  
    <hr>
        
    <h2>Libros sin devolver</h2>
    <c:if test="${prestamos == null}  ">
        	<jsp:forward page="ServletDevolver"/>
     </c:if>
     <c:if test="${devoluciones == null}">
        	<jsp:forward page="ServletDevolver"/>
     </c:if>
     
    <table style="border: 2px solid grey; padding: 7px;">
		<c:forEach items="${prestamos}" var="pres">
			<tr style="margin: 7px">
				<td> <c:out value="${pres.titulo}"/>, <c:out value="${pres.diasPrestado}"/> dias prestados</td>   
				<c:choose>
					<c:when test="${devoluciones.contains(pres.idPrestamo)}">	
						<td><a href="ServletDevolver?revertir=${pres.idPrestamo}">REVERTIR DEVOLUCION</a></td>
					</c:when>
					<c:otherwise>
						<td><a href="ServletDevolver?devolver=${pres.idPrestamo}">MARCAR DEVOLUCION</a></td>
					</c:otherwise>
				</c:choose>
			</tr>
		</c:forEach>
   	</table>
</body>
</html>