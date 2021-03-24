<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Valor extends CI_Controller {
  private $permisos;

  public function __construct()
  {
    parent::__construct();

    if (!$this->session->userdata("login")) {
			redirect(base_url());
    }

    $this->permisos = $this->backend_lib->control();
    $this->load->model('Valor_model');
  }

  public function index(){
    $fecha_proceso = date('d/m/Y');

    // Set Fecha
    if ($this->input->get('val_fecha') !== null){ // Si esta función es llamada desde el formulario (method get)
      $val_fecha = $this->input->get('val_fecha');
    }else{
      $val_fecha = $fecha_proceso;
    }

    $params = array(
      'permisos' => $this->permisos,
      'records' => $this->Valor_model->getValoresPorDia($val_fecha),
      'val_fecha' => $val_fecha
      );  
  
      $this->load->view("layouts/header");
      $this->load->view("layouts/aside");
      $this->load->view("consultas/valor/list", $params);
      $this->load->view("layouts/footer");
  }
}