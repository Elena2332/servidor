<%@ page language="java" content="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF8">
		<title>LOGIN</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
	</head>
	<body>
		<body>
		<div id="header">
            <h1>APLICACIÓN ACTIVIDADES</h1>
        </div>
        <div id=menu>
        	<h2>EJEMPLOS TABLAS</h2>
        </div>
        <div id="container">
        	<form action="ServletLogin" method="post" >
				<table>
					<tr>
						<th colspan=3>LOGIN</th>
					</tr>
					<tr>
						<td class="lineaCabecera">Usuario</td>
						<td class="lineaCabecera">Password</td>
						<td class="lineaCabecera">Acciones</td>
					</tr>
					<tr>
						<td> <input type="text" name="usuario" value=""></td>
						<td> <input type="password" name="password"></td>
						<td>
							<input type="submit" name="btnLoginAlumno" value="Alumno">
							<input type="submit" name="btnLoginImpartidor" value="Impartidor">
						</td>
					</tr>
				</table>
			</form>
			
			<br>
			<br>
			
			<table>
				<tr>
					<th colspan=3>ACTIVIDADES ASIGNADAS</th>
				</tr>
				<tr>
					<td class="lineaCabecera">ACTIVIDAD</td>
					<td class="lineaCabecera">PRECIO</td>
					<td class="lineaCabecera">IMPARTIDOR</td>
				</tr>
				<tr>
					<td> Punto de Cruz</td>
					<td> 25€</td>
					<td>Claudio Varani Lusar</td>
				</tr>
				<tr>
					<td> Punto de Cruz</td>
					<td> 25€</td>
					<td>Claudio Varani Lusar</td>
				</tr>
				<tr>
					<td> Punto de Cruz</td>
					<td> 25€</td>
					<td>Claudio Varani Lusar</td>
				</tr>
			</table>
        </div>
	</body>
</html>