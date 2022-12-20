package bean;

public class Imagen {

	private String ruta;
	private String nombre;
	private double tamanio;


	public Imagen(String r, String n, double t)
	{
		ruta=r;
		nombre=n;
		tamanio=t;
	}
		
	
	public String getRuta() {
		return ruta;
	}
	public void setRuta(String ruta) {
		this.ruta = ruta;
	}
	public String getNombre() {
		return nombre;
	}
	public void setNombre(String nombre) {
		this.nombre = nombre;
	}
	public double getTamanio() {
		return tamanio;
	}
	public void setTamanio(double tamanio) {
		this.tamanio = tamanio;
	}



	public String tamanioDesglosado()   // tamaño de 8499106 bytes devolvería el string 8 Mb 107 Kb 930 bytes
	{
		String str = "";
		
		double bytes = this.tamanio;
		double megabytes = bytes / (1024 * 1024);
		double kilobytes = bytes % (1024 * 1024) / 1024;
        bytes = bytes % (1024 * 1024) % 1024;

        if (megabytes > 0) {
            str = str + megabytes + "MB";
            str = str + " ";
        }
        if (kilobytes > 0) {
            str = str + kilobytes + "KB";
            str = str + " ";
        }
        if (bytes > 0) {
            str = str + bytes + "B";
        }
		return str;
	}
		
}
