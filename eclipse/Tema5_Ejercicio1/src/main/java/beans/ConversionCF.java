package beans;


public class ConversionCF {

	private char tipo;
	private double valor;
	
	
	public ConversionCF(char tipo, double valor) 
	{
		this.tipo = tipo;
		this.valor = valor;
	}

	
	public char getTipo() {
		return tipo;
	}
	public void setTipo(char tipo) {
		this.tipo = tipo;
	}

	public double getValor() {
		return valor;
	}
	public void setValor(double valor) {
		this.valor = valor;
	}
	
	
	
}
