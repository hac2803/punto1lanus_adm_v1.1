<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
    	}
    
		$this->load->model("Cliente_model");
		$this->load->model("Articulo_model");
		$this->load->model("Stock_model");
		$this->load->model("Ventas_model");
		$this->load->model("Valor_model");
		$this->load->model("Parametro_model");
	}

	public function index(){
		// Fecha Proceso
		// $fecha_proceso = $this->Parametro_model->getParametro('F_PROCESO');

		// Rol
		// $rol_id = $this->session->userdata("rol_id");

		$params = array();

    $params = array(
      // "cantidadClientes" => $this->Cliente_model->getCantidadClientes(),
			"cantidadArticulos" => $this->Articulo_model->getCantidadArticulos(),
			"cantidadStock" => $this->Stock_model->getCantidadStock(),
			"costoStock" => $this->Stock_model->getCostoStock(),
			"saldoVentas" => $this->Ventas_model->getSaldoVentas(),
			"years" => $this->Ventas_model->years(),
	// 		"rol_id" => $rol_id
    );

    $this->load->view("layouts/header");
		$this->load->view("layouts/aside");
    $this->load->view("dashboard", $params);
		$this->load->view("layouts/footer");
		
	}

	public function getDataVentas(){ // JSON
		$year = $this->input->post("year");
		$resultados = $this->Ventas_model->getVentasPorAño($year);
		echo json_encode($resultados);
	}
	
	public function getDataValores(){ // JSON
		$year = $this->input->post("year");
		$resultados = $this->Valor_model->getValoresPorAño($year);
		echo json_encode($resultados);
	}
}
