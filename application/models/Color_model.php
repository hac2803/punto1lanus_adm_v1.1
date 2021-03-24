<?php

  class Color_model extends CI_Model {

    public function get(){
      $this->db->select('col.*');
      $this->db->from('tr_col_color as col');
      $this->db->order_by('col.col_codigo');
      $resultados = $this->db->get();
      return $resultados->result();
    }

    public function insert($data){
      return $this->db->insert("tr_col_color", $data);
    }    

    public function getId($col_id){
      $query = $this->db->get_where('tr_col_color', array('col_id' => $col_id));
      return $query->row();
    }

    public function update($data){
      $col_id = $data['col_id'];
      $this->db->where('col_id', $col_id);
      return $this->db->update('tr_col_color', $data);
    }

    public function delete($col_id){
      $this->db->where("col_id", $col_id);
      return $this->db->delete("tr_col_color");
    }

    public function validate_codigo($data){
      $this->db->from('tr_col_color');
      $this->db->where('col_id !=', $data['col_id']);
      $this->db->where('col_codigo =', $data['col_codigo']);
      return $this->db->count_all_results() == 0;
    }

    public function getPorCodigo($col_codigo){
      $query = $this->db->get_where('tr_col_color', array('col_codigo' => $col_codigo));
      return $query->row();
    }
    
  }
?>
