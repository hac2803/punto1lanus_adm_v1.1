<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permiso_model extends CI_Model {

	public function get(){
		$this->db->select('prm.*, men.men_nombre, men.men_link, rol.rol_nombre');
		$this->db->from('ta_prm_permiso as prm');
		$this->db->join('tr_rol_rol as rol', 'prm.rol_id = rol.rol_id');
    $this->db->join('tr_men_menu as men', 'prm.men_id = men.men_id');
    $this->db->order_by('men.men_nombre');
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getMenus(){
    $this->db->from("tr_men_menu");
    $this->db->order_by("men_link");
    $query = $this->db->get(); 
    return $query->result();
	}

	public function insert($data){
    return $this->db->insert("ta_prm_permiso", $data);
	}

	public function getPermiso($prm_id){
		$this->db->where("prm_id", $prm_id);
		$resultados = $this->db->get("ta_prm_permiso");
		return $resultados->row();
	}

	public function update($data){
    $prm_id = $data['prm_id'];
    $this->db->where("prm_id", $prm_id);
		return $this->db->update("ta_prm_permiso", $data);
	}

	public function delete($prm_id){
		$this->db->where("prm_id", $prm_id);
		return $this->db->delete("ta_prm_permiso");
  }
  
  public function getPermisoMenuRol($data){
    $prm_id = $data['prm_id'];
    $rol_id = $data['rol_id'];
    $men_id = $data['men_id'];

    $this->db->from('ta_prm_permiso');
    $this->db->where('rol_id =', $rol_id);
    $this->db->where('men_id =', $men_id);

    if (!is_null($prm_id)){
      $this->db->where('prm_id !=', $prm_id);
    }

    $rows = $this->db->count_all_results();

    return ($rows > 0);
  }

	public function getPermisosByMenu($men_nombre){
    $rol_id = $this->session->userdata("rol_id");

    $this->db->from("tr_men_menu as men");
    $this->db->join("ta_prm_permiso as prm", "men.men_id = prm.men_id");
		$this->db->where("men.men_nombre", $men_nombre);
    $this->db->where("prm.rol_id", $rol_id);
		$resultado = $this->db->get();
    $permisos = $resultado->row();
    
    if(is_null($permisos)){
      $array = array("prm_read" => "0", "prm_insert" => "0", "prm_update" => "0", "prm_delete" => "0");
      $permisos = (object) $array;
    }

    return $permisos;

	}

  public function unique_permiso($data) {
    $this->db->from('ta_prm_permiso');
    $this->db->where('prm_id !=', $data['prm_id']);
    $this->db->where('rol_id =', $data['rol_id']);
    $this->db->where('men_id =', $data['men_id']);
    return $this->db->count_all_results() == 0;
  }

}