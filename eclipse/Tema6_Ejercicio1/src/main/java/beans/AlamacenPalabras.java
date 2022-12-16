package beans;


public class AlamacenPalabras {

	private static String[] palabras = {"pajaro","anime","chancla","papaya","palabra","almhoada","maletin"};
	
	public static String getPalabra()
	{
		int n = (int)Math.random()*palabras.length + 1;
		return palabras[n];
	}
}
