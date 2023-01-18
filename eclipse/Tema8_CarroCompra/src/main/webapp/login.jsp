<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Login</title>
</head>
<body>
	<h1>LOGIN</h1>
	<form action="ServletLogin" method="post">
	<table>
		<tr>
			<td><label>Usuario:</label></td>
			<td><input name="inpUsuario" type="text"></td>
		</tr>
		<tr>
			<td><label>Contraseña:</label></td>
			<td><input name="inpPass" type="password"></td>
		</tr>
	</table>
	<div>
		<input name="btnLogin" type="submit">
		<input name="btnReset" type="reset">
		<a href="registro.jsp">REGISTRARSE</a>
	</div>		
	</form>
</body>
</html>