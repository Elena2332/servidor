package beans;

import java.util.Date;

/**
 * @author Amaia
 *
 */
public class Usuario {
	
	
    private int id;
    private String username;
    private String nombre;
    private String password;
    private String email;
    private String cadenaVerificacion;
    private int activo;
    
    
    
    
	public Usuario() {
		super();
		// TODO Auto-generated constructor stub
	}

	/**
	 * @param id
	 * @param username
	 * @param nombre
	 * @param password
	 * @param email
	 * @param cadenaVerificacion
	 * @param activo
	 */
	public Usuario(int id, String username, String nombre, String password, String email, String cadenaVerificacion,
			int activo) {
		super();
		this.id = id;
		this.username = username;
		this.nombre = nombre;
		this.password = password;
		this.email = email;
		this.cadenaVerificacion = cadenaVerificacion;
		this.activo = activo;
	}


	/**
	 * @return
	 */
	public int getId() {
		return id;
	}

	/**
	 * @param id
	 */
	public void setId(int id) {
		this.id = id;
	}

	/**
	 * @return
	 */
	public String getUsername() {
		return username;
	}

	/**
	 * @param username
	 */
	public void setUsername(String username) {
		this.username = username;
	}

	/**
	 * @return
	 */
	public String getNombre() {
		return nombre;
	}

	/**
	 * @param nombre
	 */
	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	/**
	 * @return
	 */
	public String getPassword() {
		return password;
	}

	/**
	 * @param password
	 */
	public void setPassword(String password) {
		this.password = password;
	}

	/**
	 * @return
	 */
	public String getEmail() {
		return email;
	}

	/**
	 * @param email
	 */
	public void setEmail(String email) {
		this.email = email;
	}

	/**
	 * @return
	 */
	public String getCadenaVerificacion() {
		return cadenaVerificacion;
	}

	/**
	 * @param cadenaVerificacion
	 */
	public void setCadenaVerificacion(String cadenaVerificacion) {
		this.cadenaVerificacion = cadenaVerificacion;
	}

	/**
	 * @return
	 */
	public int getActivo() {
		return activo;
	}

	/**
	 * @param activo
	 */
	public void setActivo(int activo) {
		this.activo = activo;
	}

	/**
	 *
	 */
	@Override
	public String toString() {
		return "Usuario [id=" + id + ", username=" + username + ", nombre=" + nombre + ", password=" + password
				+ ", email=" + email + ", cadenaVerificacion=" + cadenaVerificacion + ", activo=" + activo + "]";
	}
	  

}
