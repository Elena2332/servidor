<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%@taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
    
<%
	session = request.getSession(false);
	
	if (session == null) {
		response.sendRedirect("nuevacuenta.jsp");
	}

	String titular = (String) session.getAttribute("titular");
	String saldo = (String) session.getAttribute("saldo");
%>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Movimientos</title>
</head>
<body>
	<form action="ServletMovimientos" method="post">
		<table>
			<tr><td colspan="2" style="background: lightgray; font-weight: bold; padding: 10px; text-align: center">MOVIMIENTOS</td></tr>
			<tr>
				<td style="background: lightgray; padding: 5px;"><label>Titular</label></td>
				<td style="background: lightgray; padding: 5px;"><label><c:out value="${titular}" /></label></td>
			</tr>
			<tr>
				<td style="background: lightgray; padding: 5px;"><label>Saldo actual</label></td>
				<td style="background: lightgray; padding: 5px;"><label><c:out value="${saldo}" /></label></td>
			</tr>
			<tr>
				<td style="background: lightgray; padding: 5px;"><label>CANTIDAD</label></td>
				<td style="background: lightgray; padding: 5px;"><input type="text" name="cantidad"></td>
			</tr>
			<tr>
				<td colspan="2" style="background: black; padding: 10px; text-align: center;">
					<button type="submit" name="procesar" value="ingresar">INGRESAR</button>
					<button type="submit" name="procesar" value="gastar">GASTAR</button>
				</td>
			</tr>
		</table>
	</form>
	
	<% String mensajeError = (String) request.getAttribute("mensajeError"); %>
	<c:set var="mensaje" value="mensajeError" />
	<c:if test="${mensajeError != null}">
		<p><c:out value="${mensajeError}" /></p>
	</c:if>
	
</body>
</html>