/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package beans;

import java.sql.Date;

public class Prestamo {
    private int idPrestamo;
    private Date fecha;
    private Libro libro;

    public Prestamo(int idLibro, Date titulo, Libro lib) {
        this.idPrestamo = idLibro;
        this.fecha = titulo;
        this.libro = lib;
    }
    

    public Prestamo() { }

    
    public int getIdPrestamo() {
        return idPrestamo;
    }

    public Date getFecha() {
        return fecha;
    }

    public Libro getLibro() {
        return libro;
    }

	public void setIdPrestamo(int idPrestamo) {
		this.idPrestamo = idPrestamo;
	}

	public void setFecha(Date fecha) {
		this.fecha = fecha;
	}

	public void setLibro(Libro libro) {
		this.libro = libro;
	}

	

}
