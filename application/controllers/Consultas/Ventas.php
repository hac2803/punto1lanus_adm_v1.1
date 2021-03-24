<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {
  private $permisos;

  public function __construct()
  {
    parent::__construct();

    if (!$this->session->userdata("login")) {
			redirect(base_url());
    }

    $this->permisos = $this->backend_lib->control();
    $this->load->model('Ventas_model');
  }

  // public function index()
  // {
  //   $fecha_proceso = date('d/m/Y');

  //   if ($_SERVER["REQUEST_METHOD"] == "POST"){
  //     $vec_fecha = $this->input->post("vec_fecha");
  //   }else{
  //     $vec_fecha = $fecha_proceso;
  //   }

  //   $params = array(
  //   'permisos' => $this->permisos,
  //   'records' => $this->Ventas_model->getVentasPorDia($vec_fecha),
  //   'vec_fecha' => $vec_fecha
  //   );  

  //   $this->load->view("layouts/header");
  //   $this->load->view("layouts/aside");
  //   $this->load->view("consultas/ventas/list", $params);
  //   $this->load->view("layouts/footer");
  // }


  public function index(){
    $fecha_proceso = date('d/m/Y');

    // Set Fecha
    if ($this->input->get('vec_fecha') !== null){ // Si esta función es llamada desde el formulario (method get)
      $vec_fecha = $this->input->get('vec_fecha');
    }else{
      $vec_fecha = $fecha_proceso;
    }

    $params = array(
      'permisos' => $this->permisos,
      'records' => $this->Ventas_model->getVentasPorDia($vec_fecha),
      'vec_fecha' => $vec_fecha
      );  
  
      $this->load->view("layouts/header");
      $this->load->view("layouts/aside");
      $this->load->view("consultas/ventas/list", $params);
      $this->load->view("layouts/footer");
  }

}