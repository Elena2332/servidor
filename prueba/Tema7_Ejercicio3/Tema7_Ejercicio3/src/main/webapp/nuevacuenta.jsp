<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%@taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Nueva cuenta</title>
</head>
<body>

	<% String mensajeError = (String) request.getAttribute("mensajeError"); %>
	<c:set var="mensaje" value="mensajeError" />
	<c:if test="${mensajeError != null}">
		<p><c:out value="${mensajeError}" /></p>
	</c:if>

	<form action="ServletNuevaCuenta" method="post">
		<table>
			<tr><td colspan="2" style="background: lightgray; font-weight: bold; padding: 10px; text-align: center">NUEVA CUENTA</td></tr>
			<tr>
				<td style="background: lightgray; padding: 5px;"><label>Titular</label></td>
				<td style="background: lightgray; padding: 5px;"><input type="text" name="titular"></td>
			</tr>
			<tr>
				<td style="background: lightgray; padding: 5px;"><label>Saldo inicial</label></td>
				<td style="background: lightgray; padding: 5px;"><input type="text" name="saldo"></td>
			</tr>
			<tr><td colspan="2" style="background: black; padding: 10px; text-align: center;"><button type="submit" name="crear">Crear Cuenta Corriente</button></td></tr>
		</table>
	</form>
</body>
</html>