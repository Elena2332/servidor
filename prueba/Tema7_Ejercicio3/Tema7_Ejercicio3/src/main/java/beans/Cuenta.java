package beans;

public class Cuenta {

	private String titular;
	private int saldo;
	
	public Cuenta(String titular, int saldo) {
		this.titular = titular;
		this.saldo = saldo;
	}

	public String getTitular() {
		return titular;
	}

	public int getSaldo() {
		return saldo;
	}
	
	public void ingresar(int cantidad) {
		saldo += cantidad;
	}
	
	public boolean gastar(int cantidad) {
		if (cantidad > saldo) {
			return false;
		} else {
			saldo -= cantidad;
			return true;
		}
	}
	
}
