/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package beans;

import java.util.Objects;

/**
 *
 * @author Akaitz
 */
public class Libro {
    private int idLibro;
    private String titulo;
    private int paginas;
    private String genero;
    private int idAutor;

    public Libro(int idLibro, String titulo, int paginas, String genero, int idAutor) {
        this.idLibro = idLibro;
        this.titulo = titulo;
        this.paginas = paginas;
        this.genero = genero;
        this.idAutor = idAutor;
    }

    public Libro(String titulo, int paginas, String genero, int idAutor) {
        this.titulo = titulo;
        this.paginas = paginas;
        this.genero = genero;
        this.idAutor = idAutor;
    }

    public Libro() {
    }

    public int getIdLibro() {
        return idLibro;
    }

    public String getTitulo() {
        return titulo;
    }

    public int getPaginas() {
        return paginas;
    }

    public String getGenero() {
        return genero;
    }

    public int getIdAutor() {
        return idAutor;
    }

    public void setIdLibro(int idLibro) {
        this.idLibro = idLibro;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }

    public void setPaginas(int paginas) {
        this.paginas = paginas;
    }

    public void setGenero(String genero) {
        this.genero = genero;
    }

    public void setIdAutor(int idAutor) {
        this.idAutor = idAutor;
    }

	@Override
	public int hashCode() {
		return Objects.hash(idAutor, idLibro, titulo);
	}

	@Override
	public boolean equals(Object obj) {
		if (this == obj)
			return true;
		if (obj == null)
			return false;
		if (getClass() != obj.getClass())
			return false;
		Libro other = (Libro) obj;
		return idAutor == other.idAutor && idLibro == other.idLibro && Objects.equals(titulo, other.titulo);
	}
    
    
    
    
}
