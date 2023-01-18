package beans;

import java.util.Date;

/**
 * @author Amaia
 *
 */
public class Puja {
	
    private int id;
    private int id_item;
    private int id_user;
    private int cantidad;
    private Date fecha;
    
    
    
	public Puja() {
		super();
		// TODO Auto-generated constructor stub
	}

	public Puja(int id, int id_item, int id_user, int cantidad, Date fecha) {
		super();
		this.id = id;
		this.id_item = id_item;
		this.id_user = id_user;
		this.cantidad = cantidad;
		this.fecha = fecha;
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
	public int getId_item() {
		return id_item;
	}

	/**
	 * @param id_item
	 */
	public void setId_item(int id_item) {
		this.id_item = id_item;
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
	public int getCantidad() {
		return cantidad;
	}

	/**
	 * @param cantidad
	 */
	public void setCantidad(int cantidad) {
		this.cantidad = cantidad;
	}

	/**
	 * @return
	 */
	public Date getFecha() {
		return fecha;
	}

	/**
	 * @param fecha
	 */
	public void setFecha(Date fecha) {
		this.fecha = fecha;
	}

	@Override
	public String toString() {
		return "Puja [id=" + id + ", id_item=" + id_item + ", id_user=" + id_user + ", cantidad=" + cantidad
				+ ", fecha=" + fecha + "]";
	}
    
    

}
