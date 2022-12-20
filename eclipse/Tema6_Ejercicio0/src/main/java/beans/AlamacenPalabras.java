package beans;

import java.util.Random;

public class AlamacenPalabras {

	private static String[] palabras = {"pajaro","anime","chancla","papaya","palabra","almhoada","maletin"};
	
	public static String getPalabra()
	{
		Random ran = new Random();
		int n = ran.nextInt(palabras.length);
		return palabras[n];
	}
}
