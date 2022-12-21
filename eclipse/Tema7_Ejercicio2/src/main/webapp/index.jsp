<%@page import="java.util.Set"%>
<%@page import="java.util.HashMap"%>
<%@page import="java.io.FileReader"%>
<%@page import="java.io.BufferedReader"%>
<%@page import="java.util.ArrayList" %>

<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1" %>    
    
<%!
	public ArrayList<String> obtenerContenido(String fich)
	{
		ArrayList<String>categorias = new ArrayList<String>();	
		try 
		{	
			BufferedReader bf = new BufferedReader(new FileReader(fich));
			String linea = bf.readLine();
	        while(linea != null)
	        {
	            String[] lin = linea.split(";");
	            if(!categorias.contains(lin[0]))  // categoria nueva
	            	categorias.add(lin[0]);
	        	linea = bf.readLine();
	        } 
	        bf.close();
	        return categorias;
		}
		catch(Exception e)
		{
			System.out.print(e.getMessage());
			categorias = null;
			return categorias;
		}
	}

%>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Ejercicio2</title>
</head>
<body>
	<label>Selecciona categoria: </label>
	<%
		String fich = request.getServletContext().getRealPath("productos.txt");	
		ArrayList<String> categorias = obtenerContenido(fich);
		for(String cat : categorias)
			out.print("<a style='margin:10px' href='ServletPrepararProductos?cate="+cat+"'>"+cat+"</a>");
		out.print("<a style='margin:15px' href='ServletPrepararProductos'></a>");
	%>
</body>
</html>