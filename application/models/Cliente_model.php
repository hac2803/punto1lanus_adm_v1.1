<?php

  class Cliente_model extends CI_Model {

    public function get(){
      $this->db->select('cli.*');
      $this->db->from('tm_cli_cliente as cli');
      $this->db->where('cli_id !=', 1); // Cliente Genérico
      $this->db->order_by('cli.cli_nombre');
      $resultados = $this->db->get();
      return $resultados->result();
    }

    public function insert($data){
      return $this->db->insert("tm_cli_cliente", $data);
    }    

    public function getId($cli_id){
      $query = $this->db->get_where('tm_cli_cliente', array('cli_id' => $cli_id));
      return $query->row();
    }

    public function update($data){
      $cli_id = $data['cli_id'];
      $this->db->where('cli_id', $cli_id);
      return $this->db->update('tm_cli_cliente', $data);
    }

    public function delete($cli_id){
      $this->db->where("cli_id", $cli_id);
      return $this->db->delete("tm_cli_cliente");
    }

    public function validate_telefono($data) {
      $this->db->from('tm_cli_cliente');
      $this->db->where('cli_id !=', $data['cli_id']);
      $this->db->where('cli_telefono =', $data['cli_telefono']);
      return $this->db->count_all_results() == 0;
    }

    public function getCantidadClientes() {
      $this->db->select('count(cli_id) as cantidad');
      $this->db->from('tm_cli_cliente as cli');
      $this->db->where('cli_id !=', 1); // Cliente Genérico
      $query = $this->db->get();
      return $query->row()->cantidad;
    }

  }
