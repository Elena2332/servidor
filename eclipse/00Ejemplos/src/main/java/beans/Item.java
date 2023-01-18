package beans;

import java.util.Date;

/**
 * @author Amaia
 *
 */
public class Item {
	
    private int id;
    private int id_cat;
    private int id_user;
    private String nombre;
    private String descripcion;
    private int preciopartida;
    private Date fechafin; 
    
	public Item() {
		super();
		// TODO Auto-generated constructor stub
	}

	public Item(int id, int id_cat, int id_user, String nombre, int preciopartida, String descripcion, Date fechafin) {
		super();
		this.id = id;
		this.id_cat = id_cat;
		this.id_user = id_user;
		this.nombre = nombre;
		this.descripcion = descripcion;
		this.preciopartida = preciopartida;
		this.fechafin = fechafin;
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
	public int getId_cat() {
		return id_cat;
	}
	/**
	 * @param id_cat
	 */
	public void setId_cat(int id_cat) {
		this.id_cat = id_cat;
	}
	/**
	 * @return
	 */
	public int getId_user() {
		return id_user;
	}
	/**
	 * @param id_user
	 */
	public void setId_user(int id_user) {
		this.id_user = id_user;
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
	public String getDescripcion() {
		return descripcion;
	}
	/**
	 * @param descripcion
	 */
	public void setDescripcion(String descripcion) {
		this.descripcion = descripcion;
	}
	/**
	 * @return
	 */
	public int getPreciopartida() {
		return preciopartida;
	}
	/**
	 * @param preciopartida
	 */
	public void setPreciopartida(int preciopartida) {
		this.preciopartida = preciopartida;
	}
	/**
	 * @return
	 */
	public Date getFechafin() {
		return fechafin;
	}
	/**
	 * @param fechafin
	 */
	public void setFechafin(Date fechafin) {
		this.fechafin = fechafin;
	}

	@Override
	public String toString() {
		return "Item [id=" + id + ", id_cat=" + id_cat + ", id_user=" + id_user + ", nombre=" + nombre
				+ ", descripcion=" + descripcion + ", preciopartida=" + preciopartida + ", fechafin=" + fechafin + "]";
	}

	
}
