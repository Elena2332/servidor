package beans;

import java.util.Objects;

public class LineaPedido {

	private int id;
	private int cantidad;
	private Item item;
	private Pedido pedido;
	
	
	public LineaPedido() {
		super();
	}


	public int getId() {
		return id;
	}


	public void setId(int id) {
		this.id = id;
	}


	public int getCantidad() {
		return cantidad;
	}


	public void setCantidad(int cantidad) {
		this.cantidad = cantidad;
	}


	public Item getItem() {
		return item;
	}


	public void setItem(Item item) {
		this.item = item;
	}


	public Pedido getPedido() {
		return pedido;
	}


	public void setPedido(Pedido pedido) {
		this.pedido = pedido;
	}


	@Override
	public int hashCode() {
		return Objects.hash(item);
	}


	@Override
	public boolean equals(Object obj) {
		if (this == obj)
			return true;
		if (obj == null)
			return false;
		if (getClass() != obj.getClass())
			return false;
		LineaPedido other = (LineaPedido) obj;
		return Objects.equals(item, other.item);
	}
	
		
}
