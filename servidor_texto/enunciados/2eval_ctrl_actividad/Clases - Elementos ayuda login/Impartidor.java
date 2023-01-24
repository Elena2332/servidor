package beans;

public class Impartidor {

	private Integer id;
	private String apellido;
	private String nombre;

	/**
	 * Constructor Datos Vacio
	 */
	public Impartidor() {
		id = 0;
		apellido = new String();
		nombre = new String();
	}

	/**
	 * @param id
	 * @param apellido
	 * @param nombre
	 */
	public Impartidor(Integer id, String apellido, String nombre) {
		super();
		this.id = id;
		this.apellido = apellido;
		this.nombre = nombre;
	}

	/**
	 * @return
	 */
	public Integer getId() {
		return id;
	}

	/**
	 * @param id
	 */
	public void setId(Integer id) {
		this.id = id;
	}

	/**
	 * @return
	 */
	public String getApellido() {
		return apellido;
	}

	/**
	 * @param apellido
	 */
	public void setApellido(String apellido) {
		this.apellido = apellido;
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
	 *
	 */
	@Override
	public String toString() {
		return "Impartidor [id=" + id + ", apellido=" + apellido + ", nombre=" + nombre + "]";
	}

}
