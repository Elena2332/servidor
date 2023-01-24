<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF8">
		<title>LOGIN</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
	</head>
	<body>
		<div id="header">
            <h1>APLICACIÓN ACTIVIDADES</h1>
        </div>
        <div id=menu>
        	<h2>LOGIN</h2>
        </div>
        <div id="container">
        	
			<form action="ServletLogin" method="post" >
				<table>
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
		</div>
	</body>
</html>