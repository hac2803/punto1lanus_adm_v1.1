<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {
  private $permisos;

  public function __construct()
  {
    parent::__construct();

    if (!$this->session->userdata("login")) {
			redirect(base_url());
    }

    $this->permisos = $this->backend_lib->control();
    $this->load->model('Stock_model');
  }
  
  public function index()
  {
    $params = array(
    'permisos' => $this->permisos,
    'records' => $this->Stock_model->get()
    );  

    $this->load->view("layouts/header");
    $this->load->view("layouts/aside");
    $this->load->view("consultas/stock/list", $params);
    $this->load->view("layouts/footer");
  }

  public function movimientos()
  {
    $fecha_proceso = date('d/m/Y');

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $fecha_movimiento = $this->input->post("mst_fecha");
    }else{
      $fecha_movimiento = $fecha_proceso;
    }

    $params = array(
    'permisos' => $this->permisos,
    'records' => $this->Stock_model->getMovimientos($fecha_movimiento),
    'fecha_movimiento' => $fecha_movimiento
    );  

    $this->load->view("layouts/header");
    $this->load->view("layouts/aside");
    $this->load->view("consultas/stock/movimientos", $params);
    $this->load->view("layouts/footer");
  }
}