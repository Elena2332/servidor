package beans;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;

public class Test {

    private int nPreguntas;
    private ArrayList<Pregunta> preguntas;
	private final static Pregunta[] PREGUNTAS_PREPARADAS;    
    static {
    	PREGUNTAS_PREPARADAS = new Pregunta[]{
            new Pregunta("Capital de España", "No es Barcelona", new String[]{"Madrid", "Barcelona", "Zaragoza"}, 0),
            new Pregunta("Cual el nombre del tungsteno?", "Suena quimico", new String[]{"Dinomer", "Wolframio", "Tugstanomato"}, 1),
            new Pregunta("En un test que se debe responder", "La respuesta es a", new String[]{"todo", "lo justo", "la a"}, 2),
            new Pregunta("A donde se fue el de la silla?", "Ni idea", new String[]{"a Sevilla", "al baño", "que silla?"}, 0),
            new Pregunta("Cómo se llama el segundo apostol", "Empieza por J", new String[]{"Jacobo", "Javier", "Juan"}, 2),
            new Pregunta("Cómo ma llamo", "-.-", new String[]{"Elena", "Patricia", "Chej"}, 0),
            new Pregunta("Que numero de ejercicio es este?","jaja XD",new String[]{"Ejercicio 2","Ejercicio 3","Ejercicio 0"},0)
    	};
    }
    private final int MAX_PREGUNTAS = PREGUNTAS_PREPARADAS.length;
    
    public Test(int cant)
    {
    	if(cant < MAX_PREGUNTAS)
    		nPreguntas = cant;
    	else
    		nPreguntas = MAX_PREGUNTAS;
    	
    	ArrayList<Pregunta> aux = new ArrayList<Pregunta>(Arrays.asList(PREGUNTAS_PREPARADAS));
    	Collections.shuffle(aux);
    	preguntas = new ArrayList<Pregunta>();
    	for(int i=0; i<nPreguntas ;i++)
    		preguntas.add(aux.get(i));
    }
    
    
    public int comprobar(ArrayList<Integer> respuestas)
    {
    	int aciertos = 0;
		for(int i=0; i<preguntas.size(); i++) 
		{
			if (respuestas.get(i) == preguntas.get(i).getCorrecta()) 
				aciertos++;			
		}		
		return aciertos;
    }
    
}
