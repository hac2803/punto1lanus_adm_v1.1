<?php

  class Tipo_Valor_model extends CI_Model {

    public function get(){
      $this->db->from('tr_tva_tipo_valor');
      $this->db->order_by("tva_nombre");
      $resultados = $this->db->get();
      return $resultados->result();
    }

  }
?>
