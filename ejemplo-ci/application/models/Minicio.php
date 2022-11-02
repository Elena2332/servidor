<?php
/**
 * 
 */
class Minicio extends CI_Model
{
	function usuarioInsertar($data){
		$this->db->insert("usuarios",$data);
	}

	function loginUsuario($usuario){
		$data["usuario"] = $usuario;
		return $this->db->get_where("usuarios",$data);
	}

	function getAlumnos($ini, $num){
		return $this->db->get("alumnos",$num,$ini);
	}

	function getAlumnoId($id){
		$data["id"] = $id;
		return $this->db->get_where("alumnos",$data);
	}

	function alumnoInsertar($data){
		$this->db->insert("alumnos",$data);
	}

	function alumnoActualizar($data){
		$this->db->where("id",$data['id']);
		$this->db->update("alumnos",$data);
	}

	function alumnoBorrar($data){
		$this->db->where("id",$data['id']);
		$this->db->delete("alumnos");
	}

	function numAlumnos(){
		return $this->db->count_all('alumnos');
	}
}
?>