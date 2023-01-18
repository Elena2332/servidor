package beans;

public class Pedido {

	private int id;
	private double importeTotal;
	private String fecha;
	private Cliente cliente;
	
	
	public Pedido() {
		super();
	}


	public int getId() {
		return id;
	}


	public void setId(int id) {
		this.id = id;
	}


	public double getImporteTotal() {
		return importeTotal;
	}


	public void setImporteTotal(double importeTotal) {
		this.importeTotal = importeTotal;
	}


	public String getFecha() {
		return fecha;
	}


	public void setFecha(String fecha) {
		this.fecha = fecha;
	}


	public Cliente getCliente() {
		return cliente;
	}


	public void setCliente(Cliente cliente) {
		this.cliente = cliente;
	}
	
	
	
}
