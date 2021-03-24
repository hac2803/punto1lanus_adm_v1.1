<?php

class Articulo_model extends CI_Model
{

  public function get()
  {
    $this->db->select('art.*');
    $this->db->from('tm_art_articulo as art');
    $this->db->order_by('art.art_codigo');
    $resultados = $this->db->get();
    return $resultados->result();
  }

  public function insert($data)
  {
    return $this->db->insert("tm_art_articulo", $data);
  }

  public function getId($art_id)
  {
    $query = $this->db->get_where('tm_art_articulo', array('art_id' => $art_id));
    return $query->row();
  }

  public function update($data)
  {
    $art_id = $data['art_id'];
    $this->db->where('art_id', $art_id);
    return $this->db->update('tm_art_articulo', $data);
  }

  public function delete($art_id)
  {
    $this->db->where("art_id", $art_id);
    return $this->db->delete("tm_art_articulo");
  }

  public function validate_codigo($data)
  {
    $this->db->from('tm_art_articulo');
    $this->db->where('art_id !=', $data['art_id']);
    $this->db->where('art_codigo =', $data['art_codigo']);
    return $this->db->count_all_results() == 0;
  }

  public function validate_codigo_stock($data)
  {
    $this->db->from('tm_art_articulo');
    $this->db->where('art_id !=', $data['art_id']);
    $this->db->where('sto_codigo =', $data['sto_codigo']);
    return $this->db->count_all_results() == 0;
  }

  public function getPorCodigoStock($sto_codigo)
  {
    $query = $this->db->get_where('tm_art_articulo', array('sto_codigo' => $sto_codigo));
    return $query->row();
  }

  public function getCantidadArticulos()
  {
    $this->db->select('count(distinct art_id) as cantidad');
    $this->db->from('tm_art_articulo as art');
    $this->db->join('tm_sto_stock as sto', 'art.art_id = sto.art_id');
    $this->db->where('sto.sto_cantidad != 0'); // Artículos con stock
    // $query = $this->db->get();
    // return $query->row()->cantidad;
    return $this->db->count_all_results();
  }

  public function getPorCodigo($art_codigo)
  {
    $query = $this->db->get_where('tm_art_articulo', array('art_codigo' => $art_codigo));
    return $query->row();
  }

}
