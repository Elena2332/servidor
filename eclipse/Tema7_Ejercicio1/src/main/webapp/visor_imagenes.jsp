<%@page import="bean.Imagen"%>
<%@page import="java.io.File"%>
<%@page import="java.util.ArrayList"%>

<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>    
    
<%!
	final String CARPETA_IMG = "img";	
	private ArrayList<Imagen> sacarImagenes(String carpeta)
	{
		ArrayList<Imagen> imagenes = new ArrayList<Imagen>();		
		File dir = new File(getServletContext().getRealPath(carpeta));   //carpeta img
        if(dir.isDirectory()) 
        {
            File[] contenido = dir.listFiles();    //imagenes de img
            for(File img : contenido) 
            	imagenes.add(new Imagen(carpeta +"/"+ img.getName(), img.getName(), img.length()));
        } 
        else 
        	dir.mkdirs();
        
		return imagenes;
	}

%>

<%
	final ArrayList<Imagen> IMAGENES = sacarImagenes(CARPETA_IMG);
	final String RUTA_JSP = getServletConfig().getServletContext().getContextPath();
%>

    
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Ejercicio 1</title>
</head>
<body>
	<form action="http://localhost:8080<%= RUTA_JSP %>" method="get">
	    <div style="border: 2px solid black; width:fit-content;">
	        <label>Imagen:</label>
	        <select name="selImg">
		        <%
		        	for(int i=0; i<IMAGENES.size(); i++)  // escribir los options		
						out.print("<option value='"+ i +"'>"+ IMAGENES.get(i).getNombre() +"</option>");
		        %>			
	        </select>
	        
	        <label>Tamaño:</label>
	        <input type="radio" name="radTam" value="300" checked><label>300px</label>
	        <input type="radio" name="radTam" value="400"><label>400px</label>
	        <input type="radio" name="radTam" value="500"><label>500px</label>
	
	        <input type="submit" name="btnVerImg" value="Ver imagen"> <br>
        </div>
        
        <%			
			if(request.getParameter("btnVerImg") != null)   // mostrar la imagen
			{
				Imagen img = IMAGENES.get(Integer.parseInt(request.getParameter("selImg")));
				String imgSeleccionada = img.getRuta();
				out.print("<p>TAMAÑO: " + img.tamanioDesglosado() + "</p>");  // tamanio MB KB bytes				
				out.print("<img src='" + imgSeleccionada +"' width='"+ request.getParameter("radTam") +"'>");
			}
		%>
	   
    </form>
</body>
</html>