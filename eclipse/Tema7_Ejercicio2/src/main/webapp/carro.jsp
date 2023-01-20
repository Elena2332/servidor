<%@page import="java.util.HashMap"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Carro jsp</title>
</head>
<body>
 		<br>
        <h1>TU CARRO: </h1>
        <br>
        <ul>
        <%
            HashMap<String,Integer> compra = (HashMap<String,Integer>)session.getAttribute("carro");
            for (String producto : compra.keySet()) 
            {                
                out.print("<li><strong>" + producto + "</strong>:");
                out.print(compra.get(producto) + " unidades </li>");
            }
        %>
        </ul>
</body>
</html>