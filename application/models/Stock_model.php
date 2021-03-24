<?php

  class Stock_model extends CI_Model {

    public function get(){
      $this->db->select('sto.*, art.art_nombre, col.col_nombre');
      $this->db->from('tm_sto_stock as sto');
      $this->db->join("tm_art_articulo as art", "sto.art_id = art.art_id");
      $this->db->join("tr_col_color as col", "sto.col_id = col.col_id");
      $this->db->order_by('sto.sto_codigo_barras');
      $resultados = $this->db->get();
      return $resultados->result();
    }

    public function getPorCodigoBarras($sto_codigo_barras){
      $query = $this->db->get_where('tm_sto_stock', array('sto_codigo_barras' => $sto_codigo_barras));
      return $query->row();
    }

    public function insert($data){
      return $this->db->insert("tm_sto_stock", $data);
    }    

    public function update($data) {
      $sto_codigo_barras = $data['sto_codigo_barras'];
      $this->db->where('sto_codigo_barras', $sto_codigo_barras);
      return $this->db->update('tm_sto_stock', $data);
    }

    public function insertMovimiento($data) {
      return $this->db->insert("tm_mst_movimiento_stock", $data);
    }

    public function getMovimientos($fecha_movimiento) {
      $this->db->select('mst.*, art.art_nombre, col.col_nombre, tmo.tmo_nombre, sto.sto_talle');
      $this->db->from('tm_mst_movimiento_stock as mst');
      $this->db->join('tm_sto_stock as sto', 'mst.sto_codigo_barras = sto.sto_codigo_barras');
      $this->db->join('tr_tmo_tipo_movimiento as tmo', 'mst.tmo_codigo = tmo.tmo_codigo');
      $this->db->join("tm_art_articulo as art", "sto.art_id = art.art_id");
      $this->db->join("tr_col_color as col", "sto.col_id = col.col_id");
      $this->db->where("mst.mst_fecha", DMY2YMD($fecha_movimiento));
      $this->db->order_by('mst.mst_fecha_creacion');
      $resultados = $this->db->get();
      return $resultados->result();  
    } 

    public function getCantidadStock() {
      $this->db->select('sum(sto.sto_cantidad) as cantidadStock');
      $this->db->from('tm_sto_stock as sto');
      $query = $this->db->get();
      return $query->row()->cantidadStock;
    }

    public function getCostoStock() {
      $this->db->select('sum(sto.sto_cantidad * art.art_precio_compra) as costoStock');
      $this->db->from('tm_sto_stock as sto');
      $this->db->join("tm_art_articulo as art", "sto.art_id = art.art_id");
      $query = $this->db->get();
      return $query->row()->costoStock;
    }

  }
?>
