<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@ taglib prefix="fmt" uri="http://java.sun.com/jsp/jstl/fmt" %>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>tienda</title>
</head>
<body>
	<h1>LAMINAS</h1>
	<c:if test="${productos == null}">
		<jsp:forward page="ServletAgregarLineaPedido"></jsp:forward>
	</c:if>
	<form action="ServletAgregarLineaPedido" method="post">
		<table>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Añadir</th>
			</tr>
			<c:forEach items="${productos}" var="item">
				<tr>
					<td>${item.key}</td>
					<td>${item.value.nombre}</td>
					<td>${item.value.precio}</td>
					<td><input type="number" name="inpCantidad" value="0"></td>
					<td><button type="submit" value="Añadir al carro" name="btnAniadir"></button></td>
				</tr>
			</c:forEach>
		</table>
	</form>

	<form action="listar_cesta.jsp">
		<button type="submit" name="btnVerCesta">Ver cesta</button>
	</form>
	<form action="pedir.jsp">
		<button type="submit" name="btnHacerPedido">Hacer pedido</button>
	</form>
	<form action="ServletListarPedidos">
		<button type="submit" name="btnPedidos">Mis pedidos</button>
	</form>
</body>
</html>