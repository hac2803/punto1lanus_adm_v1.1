<?php

  class Valor_model extends CI_Model {

    public function insert($data){
      return $this->db->insert("tm_val_valor", $data);
    }

    public function getValores($vec_id){
      $this->db->select('val.*, tva.tva_nombre');
      $this->db->from("tm_val_valor as val");
      $this->db->join('tr_tva_tipo_valor as tva', 'val.tva_id = tva.tva_id');
      $this->db->where("val.vec_id =", $vec_id);
      $this->db->order_by('val.val_fecha_creacion');
  
      $resultados = $this->db->get();
      return $resultados->result();  
    }

    public function getValoresPorDia($val_fecha) {
      $this->db->select('val.*, tva.tva_nombre');
      $this->db->from('tm_val_valor as val');
      $this->db->join('tr_tva_tipo_valor as tva', 'val.tva_id = tva.tva_id');
      $this->db->where("val.val_fecha", DMY2YMD($val_fecha));
      $this->db->order_by('val.val_fecha_creacion');
      $resultados = $this->db->get();
      return $resultados->result();  
    }

    public function getValoresPorAño($year){
    	$this->db->select("MONTH(val_fecha) as val_mes, SUM(val_importe) as val_importe");
    	$this->db->from("tm_val_valor");
    	$this->db->where("val_fecha >=", $year."-01-01");
    	$this->db->where("val_fecha <=", $year."-12-31");
      $this->db->group_by("val_mes");
      $this->db->order_by("val_mes");
      
    	$resultados = $this->db->get();
    	return $resultados->result();
    } 

  }
