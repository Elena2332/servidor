package beans;

public class Alumno {

	private String dni;
	private String apellidos;
	private String nombre;
	private String telefono;
	private String email;

	/**
	 * Constructor Datos Vacio
	 */
	public Alumno() {

		dni = new String();
		apellidos = new String();
		nombre = new String();
		telefono = new String();
		email = new String();

	}

	/**
	 * @param dni
	 * @param apellidos
	 * @param nombre
	 * @param telefono
	 * @param email
	 */
	public Alumno(String dni, String apellidos, String nombre, String telefono, String email) {
		super();
		this.dni = dni;
		this.apellidos = apellidos;
		this.nombre = nombre;
		this.telefono = telefono;
		this.email = email;
	}

	/**
	 * @return
	 */
	public String getDni() {
		return dni;
	}

	/**
	 * @param dni
	 */
	public void setDni(String dni) {
		this.dni = dni;
	}

	/**
	 * @return
	 */
	public String getApellidos() {
		return apellidos;
	}

	/**
	 * @param apellidos
	 */
	public void setApellidos(String apellidos) {
		this.apellidos = apellidos;
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
	public String getTelefono() {
		return telefono;
	}

	/**
	 * @param telefono
	 */
	public void setTelefono(String telefono) {
		this.telefono = telefono;
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
	 *
	 */
	@Override
	public String toString() {
		return "Alumno [dni=" + dni + ", apellidos=" + apellidos + ", nombre=" + nombre + ", telefono=" + telefono
				+ ", email=" + email + "]";
	}

}
