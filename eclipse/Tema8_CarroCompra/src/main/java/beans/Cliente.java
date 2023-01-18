package beans;

public class Cliente {

	private int id;
	private String nombre;
	private String password;
	private String domicilio;
	private String cp;
	private String telefono;
	private String email;
	
		
	public Cliente(int id, String nombre, String password, String domicilio, String cp, String telefono, String email) {
		super();
		this.id = id;
		this.nombre = nombre;
		this.password = password;
		this.domicilio = domicilio;
		this.cp = cp;
		this.telefono = telefono;
		this.email = email;
	}

	public Cliente() {
		super();
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getNombre() {
		return nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}

	public String getDomicilio() {
		return domicilio;
	}

	public void setDomicilio(String domicilio) {
		this.domicilio = domicilio;
	}

	public String getCp() {
		return cp;
	}

	public void setCp(String cp) {
		this.cp = cp;
	}

	public String getTelefono() {
		return telefono;
	}

	public void setTelefono(String telefono) {
		this.telefono = telefono;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}
	
	
	
}
