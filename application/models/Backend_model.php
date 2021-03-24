<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend_model extends CI_Model {

	public function getID($link){
		$this->db->like("men_link", $link);
		$resultado = $this->db->get("tr_men_menu");
		return $resultado->row(); 
	}

	public function getPermisos($men_id, $rol_id){
		$this->db->where("men_id", $men_id);
		$this->db->where("rol_id", $rol_id);
		$resultado = $this->db->get("ta_prm_permiso");
		return $resultado->row();
	}

}
