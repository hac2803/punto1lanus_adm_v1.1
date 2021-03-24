<?php

  class Ventas_model extends CI_Model {

    public function insertCabecera($data){
      return $this->db->insert("tm_vec_venta_cabecera", $data);
    }    

    public function insertDetalle($data){
      return $this->db->insert("ta_ved_venta_detalle", $data);
    }    

    public function lastID(){
    	return $this->db->insert_id();
    }

    public function getVentasPorDia($vec_fecha) {
      $this->db->select('vec.*, cli.cli_nombre');
      $this->db->from('tm_vec_venta_cabecera as vec');
      $this->db->join('tm_cli_cliente as cli', 'vec.cli_id = cli.cli_id');
      $this->db->where("vec.vec_fecha", DMY2YMD($vec_fecha));
      $this->db->order_by('vec.vec_fecha_creacion');
      $resultados = $this->db->get();
      return $resultados->result();  
    }

    public function getDeudores() {
      $this->db->select('vec.*, cli.*');
      $this->db->from('tm_vec_venta_cabecera as vec');
      $this->db->join('tm_cli_cliente as cli', 'vec.cli_id = cli.cli_id');
      $this->db->where("vec.vec_saldo > 0");
      $this->db->order_by('vec.vec_fecha');
      $resultados = $this->db->get();
      return $resultados->result();  
    }

    public function getVentaDetalle($vec_id) {
      $this->db->select('ved.*, art.art_nombre, col.col_nombre, sto.sto_talle');
      $this->db->from('ta_ved_venta_detalle as ved');
      $this->db->join('tm_sto_stock sto', 'ved.sto_codigo_barras = sto.sto_codigo_barras');
      $this->db->join("tm_art_articulo as art", "sto.sto_codigo = art.sto_codigo");
      $this->db->join("tr_col_color as col", "sto.col_codigo = col.col_codigo");
      $this->db->where("ved.vec_id", $vec_id);
      $this->db->order_by('ved.ved_fecha_creacion');
      $resultados = $this->db->get();
      return $resultados->result();  
    }

    public function getVentaCabecera($vec_id){
      $this->db->select('vec.*, cli.cli_nombre');
      $this->db->from("tm_vec_venta_cabecera as vec");
      $this->db->join('tm_cli_cliente as cli', 'vec.cli_id = cli.cli_id');
      $this->db->where("vec.vec_id =", $vec_id);
  
      $resultado = $this->db->get();
      return $resultado->row();
    }

    public function updateCabecera($data){
      $vec_id = $data['vec_id'];
      $this->db->where('vec_id', $vec_id);
      return $this->db->update('tm_vec_venta_cabecera', $data);
    }

    public function getSaldoVentas() {
      $this->db->select('sum(vec.vec_saldo) as saldo');
      $this->db->from('tm_vec_venta_cabecera as vec');
      $this->db->where("vec.vec_saldo != 0");
      $query = $this->db->get();
      return $query->row()->saldo;
    }

    public function years(){
      // Se toma vec_fecha_creacion (en vez de vec_fecha)
      // para ignorar carga inicial de la cuenta corriente
      // hecha con fecha del año anterior al año de implementación
    	$this->db->select("YEAR(vec_fecha_creacion) as year");
      $this->db->from("tm_vec_venta_cabecera");
    	$this->db->group_by("year");
      $this->db->order_by("year", "desc");
      
    	$resultados = $this->db->get();
    	return $resultados->result();
    }

    public function getVentasPorAño($year){
    	$this->db->select("MONTH(vec_fecha) as vec_mes, SUM(vec_importe) as vec_importe");
    	$this->db->from("tm_vec_venta_cabecera");
    	$this->db->where("vec_fecha >=", $year."-01-01");
    	$this->db->where("vec_fecha <=", $year."-12-31");
      $this->db->group_by("vec_mes");
      $this->db->order_by("vec_mes");
      
    	$resultados = $this->db->get();
    	return $resultados->result();
    }  
    
  }
?>
