/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package beans;

import java.sql.Date;
import java.util.Objects;

public class LibroPrestado {
    private int idPrestamo;
    private Date fecha;
    private String titulo;
    private long diasPrestado;

    public LibroPrestado(int idP, Date fecha, String tit, long dias) {
        this.idPrestamo = idP;
        this.fecha = fecha;
        this.titulo = tit;
        this.diasPrestado = dias;
    }

	public int getIdPrestamo() {
		return idPrestamo;
	}

	public void setIdPrestamo(int idPrestamo) {
		this.idPrestamo = idPrestamo;
	}

	public Date getFecha() {
		return fecha;
	}

	public void setFecha(Date fecha) {
		this.fecha = fecha;
	}

	public String getTitulo() {
		return titulo;
	}
	

	public void setTitulo(String titulo) {
		this.titulo = titulo;
	}

	public long getDiasPrestado() {
		return diasPrestado;
	}

	public void setDiasPrestado(long diasPrestado) {
		this.diasPrestado = diasPrestado;
	}

	
	
	
	@Override
	public int hashCode() {
		return Objects.hash(titulo);
	}

	@Override
	public boolean equals(Object obj) {
		if (this == obj)
			return true;
		if (obj == null)
			return false;
		if (getClass() != obj.getClass())
			return false;
		LibroPrestado other = (LibroPrestado) obj;
		return Objects.equals(titulo, other.titulo);
	}
    

	
}
