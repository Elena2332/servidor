package beans;

public class Pregunta {

	private String enunciado;
    private String pista;
    private String[] respuestas;
    private int correcta;

    public Pregunta(final String enunciado, final String pista, final String[] respuestas, final int correcta) {
        this.enunciado = enunciado;
        this.pista = pista;
        this.respuestas = respuestas;
        this.correcta = correcta;
    }

	public String getEnunciado() {
		return enunciado;
	}

	public void setEnunciado(String enunciado) {
		this.enunciado = enunciado;
	}

	public String getPista() {
		return pista;
	}

	public void setPista(String pista) {
		this.pista = pista;
	}

	public String[] getRespuestas() {
		return respuestas;
	}

	public void setRespuestas(String[] respuestas) {
		this.respuestas = respuestas;
	}

	public int getCorrecta() {
		return correcta;
	}

	public void setCorrecta(int correcta) {
		this.correcta = correcta;
	}
	
	
}
