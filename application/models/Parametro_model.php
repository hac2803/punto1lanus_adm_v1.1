<?php

  class Parametro_model extends CI_Model {

    public function get(){
      $this->db->from('tx_par_parametro');
      $this->db->order_by("par_clave");
      $resultados = $this->db->get();
      return $resultados->result();
    }

    public function insert($data){
      return $this->db->insert("tx_par_parametro", $data);
    }    

    public function getParametro($par_clave) {
      $query = $this->db->get_where('tx_par_parametro', array('par_clave' => $par_clave));
      $row = $query->row();
      return $row->par_valor;
    }

    public function getTasasIVA(){
      $this->db->from('tx_tiv_tasa_iva');
      $this->db->order_by("tiv_tasa_iva");
      $resultados = $this->db->get();
      return $resultados->result();
    }
    
    // public function update($data) {
    //   $par_id = $data['par_id'];
    //   $this->db->where('par_id', $par_id);
    //   return $this->db->update('tx_par_parametro', $data);
    // }

    // public function delete($par_id){
    //   $this->db->where("par_id", $par_id);
    //   return $this->db->delete("tx_par_parametro");
    // }

    public function update($data){
      $par_clave = $data['par_clave'];

      $this->db->where('par_clave', $par_clave);

      return $this->db->update('tx_par_parametro', $data);
    }

    public function getTiposDocumento(){
      $this->db->from('tx_tid_tipo_documento');
      $this->db->order_by("tid_nombre");
      $resultados = $this->db->get();
      return $resultados->result();
    }

    public function getMarcasTarjeta(){
      $this->db->from('tx_mta_marca_tarjeta');
      $this->db->order_by("mta_nombre");
      $resultados = $this->db->get();
      return $resultados->result();
    }    

  }
?>
