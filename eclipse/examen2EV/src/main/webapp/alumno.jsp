<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@ taglib prefix="fmt" uri="http://java.sun.com/jsp/jstl/fmt" %>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF8">
		<title>ALUMNO</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
	</head>
	<body>
		<div id="header">
            <h1>APLICACIÓN ACTIVIDADES</h1>
        </div>
        <div id=menu>
        	<h2>ALUMNOS</h2>
        </div>
        <div id="container">
        	
        	<!-- Introduce el contenido de la pantalla de Alumnos -->
        	<c:if test="${actividadesCursadas == null}">
				<jsp:forward page="ServletInscripcion"></jsp:forward>
			</c:if>
			<p>SOCIO: ${alumno.getNombre()} ${alumno.getApellidos()}</p>
			<hr> 
			
			<h2>Actividades Asignadas</h2>
			<table>
				<tr>
					<th>Actividad</th>
					<th>Precio</th>
					<th>Impartidor</th>
				</tr>
				<c:forEach items="${actividadesCursadas}" var="acti">
					<tr>
						<td>${acti.nombre}</td>
						<td>${acti.coste_mensual}</td>
						<td>${acti.impartidor.nombre}</td>
					</tr>
				</c:forEach>
			</table>
			
			<br>
			<hr>
			<br>
			
			<h2>Nuevas Inscripciones</h2>
			<table>
				<tr>
					<th>Actividad</th>
					<th>Impartidor</th>
					<th>Apuntarse</th>
				</tr>
				<c:forEach items="${actividadesPosibles}" var="acti">
					<tr>
						<td>${acti.nombre}</td>
						<td>${acti.impartidor.nombre}</td>
						<c:choose>
							<c:when test="${inscripciones.contains(acti.id)}">	
								<td><a href="ServletInscripcion?desapuntar=${acti.id}">ANULAR</a></td>
							</c:when>
							<c:otherwise>
								<td><a href="ServletInscripcion?apuntar=${acti.id}">APUNTARSE</a></td>
							</c:otherwise>
						</c:choose>
					</tr>
				</c:forEach>
			</table>
			<a href="ServletInscripcion?inscribir=1">GUARDAR LAS ${cambios} NUEVAS INSCRIPCIONES</a>
		</div>
	</body>
</html>