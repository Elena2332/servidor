<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@ taglib prefix="fmt" uri="http://java.sun.com/jsp/jstl/fmt" %>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Registro</title>
</head>
<body>
	<form action="ServletRegistro" method="post">
	<table>
		<tr>
			<td><label>Usuario:</label></td>
			<td><input name="inpUser" type="text"></td>
		</tr>
		<tr>
			<td><label>Contraseña:</label></td>
			<td><input name="inpPass" type="password"></td>
		</tr>
		<tr>
			<td><label>Domicilio:</label></td>
			<td><input name="inpDomi" type="text"></td>
		</tr>
		<tr>
			<td><label>CP:</label></td>
			<td><input name="inpCP" type="number"></td>
		</tr>
		<tr>
			<td><label>Telefono:</label></td>
			<td><input name="inpTelf" type="text"></td>
		</tr>
		<tr>
			<td><label>Email:</label></td>
			<td><input name="inpEmail" type="email"></td>
		</tr>
	</table>
	<c:if test="${mensaje != null}">
		<p style="color:red;">${mensaje}</p>
	</c:if>
	<div>
		<input name="btnRegistrar" type="submit" value="Registrarse">
		<input name="btnReset" type="reset" value="Reset">
	</div>		
	</form>
</body>
</html>