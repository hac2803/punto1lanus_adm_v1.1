<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

	public function login($usu_username, $usu_password){
		$this->db->where("usu_username", $usu_username);
    $this->db->where("usu_password", md5($usu_password));
    $this->db->where("usu_activo", 1); // Activo
    $resultados = $this->db->get("tm_usu_usuario");
    
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}
		else{
			return false;
		}
  }
  
	public function getRoles(){
    $this->db->from('tr_rol_rol');
    $this->db->order_by('rol_nombre');
		$resultados = $this->db->get();
		return $resultados->result();
	}

  public function insert($data) {
    //insert data to the database
    return $this->db->insert('tm_usu_usuario', $data);
  }

  public function get(){
    $this->db->select('*');
    $this->db->from('tm_usu_usuario as usu');
    $this->db->join('tr_rol_rol as rol', 'usu.rol_id = rol.rol_id');
    $this->db->order_by('usu_nombre');
    $resultados = $this->db->get();
    return $resultados->result(); 
  }

  public function getId($usu_id) {
    $query = $this->db->get_where('tm_usu_usuario', array('usu_id' => $usu_id));
    return $query->row();
  }

  public function getUserName($usu_username) {
    $query = $this->db->get_where('tm_usu_usuario', array('usu_username' => $usu_username));
    return $query->row();
  }

  public function delete($usu_id){
    $this->db->where("usu_id", $usu_id);
    return $this->db->delete("tm_usu_usuario");
  }

  public function update($data) {
    $usu_id = $data['usu_id'];
    $this->db->where('usu_id', $usu_id);
    return $this->db->update('tm_usu_usuario', $data);
  }

  public function update_clave($data) {
    $this->db->set('usu_password', $data['usu_password_nueva']);
    $this->db->where('usu_id', $data['usu_id']);
    $this->db->where('usu_password', $data['usu_password']);
    $this->db->update('tm_usu_usuario');
    return ($this->db->affected_rows() > 0); // Si la password (anterior) es incorrecta, no se actualiza el registro
  }

  public function rowCount(){
    return $this->db->count_all_results('tm_usu_usuario');
  }

  
}
