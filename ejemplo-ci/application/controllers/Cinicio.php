<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cinicio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
	}

	public function index($error="")
	{
		$this->load->view("encabezado",array("titulo"=>"Login", "error"=>$error));
		$this->load->view("login");
		$this->load->view("piepagina");
	}

	public function registro()
	{
		$this->load->view("encabezado",array("titulo"=>"Registro"));
		$this->load->view("registro");
		$this->load->view("piepagina");
	}

	public function alumnos($pag=0)
	{
		$this->load->model("Minicio");
		//Se configura la paginación
		$num = 5;
		$tot = $this->Minicio->numAlumnos();
		
		//Se leen los datos de la bbdd
		$alumnos = $this->Minicio->getAlumnos($pag,$num);
		//Se carga la libreria de paginación y se crean las etiquetas de la paginación
		$this->load->library('pagination');
		//
		$config['base_url'] = site_url('cinicio/alumnos');
		$config['total_rows'] = $tot;
		$config['per_page'] = $num;

		//
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['attributes'] = ['class' => 'page-link'];

		$config['first_link'] = false;
		$config['last_link'] = false;

		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		//Se crea la paginación
		$this->pagination->initialize($config);
		//
		$data["alumnos"] = $alumnos;
		//
		$this->load->view("encabezado",array("titulo"=>"Alumnos"));
		$this->load->view("alumnos", $data);
		$this->load->view("piepagina");
	}

	public function verificarRegistro()
	{
		//Se establecen las reglas de validación del formulario
		$this->form_validation->set_rules('usuario', 'Usuario', 'required|valid_email');
		$this->form_validation->set_rules('clave', 'Clave de acceso', 'required|matches[clave2]');
		$this->form_validation->set_rules('clave2', 'Clave de acceso', 'required');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		//Se establecen los mensajes que se mostrará si no se cumplen ciertas reglas y el formato en el que se van a mostrar
		$this->form_validation->set_message("required","Este campo es obligatorio");
		$this->form_validation->set_message("matches","Las claves de acceso no coinciden");
		$this->form_validation->set_error_delimiters("<span class='rojo'>","</span>");
		//Se valida el formulario
		if ($this->form_validation->run()) {
			//Se guardan los datos en el array data y se encripta el password
			$data['usuario'] = $this->input->post("usuario");
			$data['clave'] = password_hash($this->input->post("clave"),1);
			$data['nombre'] = $this->input->post("nombre");
			//Se guardan los datos en la base de datos
			$this->load->model("Minicio");
			$this->Minicio->usuarioInsertar($data);
			//Se redirecciona al login
			redirect("cinicio/index");
		} else {
			//Si nose vuelve a mostrar el formulario
			$this->registro();
		}
	}

	public function validaUsuario($value='')
	{
		//Se establecen las reglas de validación del formulario
		$this->form_validation->set_rules('usuario', 'Usuario', 'required');
		$this->form_validation->set_rules('clave', 'Clave de acceso', 'required');
		$this->form_validation->set_message("required","* Este campo es obligatorio");
		//Se valida el formulario
		if ($this->form_validation->run()) {
			$this->load->model("Minicio");
			$usuario = $this->input->post("usuario");
			$clave = $this->input->post("clave");
			//No mandamos la clave, ya que está se almacena encriptada en la base de datos. Se comprueba más adelante.
			$data = $this->Minicio->loginUsuario($usuario);
			$usuario = $data->result();
			//Se comprueba las claves de acceso
			if (count($usuario)==0) {
				$this->index("Usuario o clave de acceso erróneos");
			} else {
				if (password_verify($clave,$usuario[0]->clave)) {
					//Crea la variable de sesión para el usuario ($_SESSION["usuario"]) y entra a alumnos
					$this->session->usuario = $usuario[0]->nombre;
					$this->alumnos();
				} else {
					$this->index("Usuario o clave de acceso erróneos");
				}
			}
		} else {
			$this->index("Todos los datos son requeridos");
		}
	}

	public function alumnoDetalle($id)
	{
		//Se carga el modelo
		$this->load->model("Minicio");
		//Se obtienen los datos del alumno
		$alumno = $this->Minicio->getAlumnoId($id);
		//Y los guardamos para pasarlo como parametro
		$data["alumno"] = $alumno->result();
		//Se lanza la vista
		$this->load->view("encabezado",array("titulo"=>"Detalle alumno"));
		$this->load->view("alumnoDetalle", $data);
		$this->load->view("piepagina");
	}

	public function alumnoBorrar($id)
	{
		//Se carga el modelo
		$this->load->model("Minicio");
		//Se obtienen los datos del alumno
		$alumno = $this->Minicio->getAlumnoId($id);
		//Y los guardamos para pasarlo como parametro
		$data["alumno"] = $alumno->result();
		//Se lanza la vista
		$this->load->view("encabezado",array("titulo"=>"Borrar alumno"));
		$this->load->view("alumnoBorrar",$data);
		$this->load->view("piepagina");
	}

	public function alumnoModificar($id)
	{
		//Se carga el modelo
		$this->load->model("Minicio");
		//Se obtienen los datos del alumno
		$alumno = $this->Minicio->getAlumnoId($id);
		//Y los guardamos para pasarlo como parametro
		$data["alumno"] = $alumno->result();
		//Se lanza la vista
		$this->load->view("encabezado",array("titulo"=>"Modificar alumno"));
		$this->load->view("alumnoModificar",$data);
		$this->load->view("piepagina");
	}

	public function alumnoAlta()
	{
		//Se lanza la vista
		$this->load->view("encabezado",array("titulo"=>"Alta alumno"));
		$this->load->view("alumnoAlta");
		$this->load->view("piepagina");
	}

	public function alumnoAltaVerificar()
	{
		//Se establecen las reglas de validación del formulario
		$config = array(
			array(
			"field" => "nombre",
			"label" => "Nombre",
			"rules" => "required"
			),
			array(
			"field" => "apellidos",
			"label" => "Apellidos",
			"rules" => "required"
			),
			array(
			"field" => "nacimiento",
			"label" => "Fecha de nacimiento",
			"rules" => "required"
			),
			array(
			"field" => "sexo",
			"label" => "Género",
			"rules" => "required"
			),
			array(
			"field" => "promedio",
			"label" => "Promedio",
			"rules" => "required"
			)
		);
		//Se establecen los mensajes que se mostrará si no se cumplen ciertas reglas y el formato en el que se van a mostrar
		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters("<span class='rojo'>","</span>");
		$this->form_validation->set_message("required","Este campo es obligatorio");
		//Se valida el formulario
		if ($this->form_validation->run()) {
			//Se recogen los datos del formulario
			$data['nombre'] = $this->input->post("nombre");
			$data['apellidos'] = $this->input->post("apellidos");
			$data['nacimiento'] = $this->input->post("nacimiento");
			$data['sexo'] = $this->input->post("sexo");
			$data['promedio'] = $this->input->post("promedio");
			//
			$this->load->model("Minicio");
			$this->Minicio->alumnoInsertar($data);
			redirect("cinicio/alumnos");
		} else {
			//
			//Datos incorrectos o incompletos
			//
			$this->load->view("encabezado",array("titulo"=>"Alta alumno"));
			 $this->load->view("alumnoAlta");
			$this->load->view("piepagina");
		}
	}

	public function alumnoActualizar()
	{
		//
		//Recibir los datos del formulario
		//
		$data['id'] = $this->input->post('id');
		$data['nombre'] = $this->input->post("nombre");
		$data['apellidos'] = $this->input->post("apellidos");
		$data['nacimiento'] = $this->input->post("nacimiento");
		$data['sexo'] = $this->input->post("sexo");
		$data['promedio'] = $this->input->post("promedio");
		//
		$this->load->model("Minicio");
		$this->Minicio->alumnoActualizar($data);
		redirect("cinicio/alumnos");
	}

	public function alumnoBorrarRegistro()
	{
		$data['id'] = $this->input->post('id');
		//
		$this->load->model("Minicio");
		$this->Minicio->alumnoBorrar($data);
		redirect("cinicio/alumnos");
	}
}
