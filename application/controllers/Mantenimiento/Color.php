<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Color extends CI_Controller {
  private $permisos;

  public function __construct()
  {
    parent::__construct();

    if (!$this->session->userdata("login")) {
			redirect(base_url());
    }

    $this->permisos = $this->backend_lib->control();
    $this->load->model('Color_model');
  }
	
  public function index()
  {
    $params = array(
    'permisos' => $this->permisos,
    'records' => $this->Color_model->get()
    );  

    $this->load->view("layouts/header");
    $this->load->view("layouts/aside");
    $this->load->view("mantenimiento/color/list", $params);
    $this->load->view("layouts/footer");
	}

  public function add() {
    if ($_SERVER["REQUEST_METHOD"] == "POST"){ 
      // Validación
      $this->form_validation->set_rules('col_codigo', 'Código', 'trim|required|min_length[3]|max_length[3]|callback_validate_codigo');
      $this->form_validation->set_rules('col_nombre', 'Nombre', 'trim|required|max_length[30]');

      if ($this->form_validation->run() == FALSE) {
        $this->load->view('layouts/header');
        $this->load->view("layouts/aside");        
        $this->load->view('mantenimiento/color/add');
        $this->load->view('layouts/footer');
      }else{
        // Get current date
        $now = date('Y-m-d H:i:s');

        // Assign data into array elements
        $data = array
        (
          'col_codigo' => $this->input->post('col_codigo'),
          'col_nombre' => $this->input->post('col_nombre'),
          'col_usuario_creacion' => $this->session->userdata("usu_username"),
          'col_fecha_creacion' => $now
        );

        // Insert record
        if($this->Color_model->insert($data)){
          redirect(base_url()."Mantenimiento/Color");
        }else{
          $this->session->set_flashdata("error", "No se pudo guardar la información");
          redirect(base_url()."Mantenimiento/Color/add");
        }        
      }
    }else{
      $this->load->view('layouts/header');
      $this->load->view("layouts/aside");      
      $this->load->view('mantenimiento/color/add');
      $this->load->view('layouts/footer');
    }
  }

  public function edit($col_id) {
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      // Validación
      $this->form_validation->set_rules('col_codigo', 'Código', 'trim|required|min_length[3]|max_length[3]|callback_validate_codigo');
      $this->form_validation->set_rules('col_nombre', 'Nombre', 'trim|required|max_length[30]');

      if ($this->form_validation->run() == FALSE){
        $this->load->view('layouts/header');
        $this->load->view("layouts/aside");
        $this->load->view('mantenimiento/color/edit');
        $this->load->view('layouts/footer');
      }else{
        // Get current date
        $now = date('Y-m-d H:i:s');

        // Assign data into array elements
        $data = array
        (
          'col_id' => $this->input->post('col_id'),
          'col_codigo' => $this->input->post('col_codigo'),
          'col_nombre' => $this->input->post('col_nombre'),
          'col_usuario_modificacion' => $this->session->userdata("usu_username"),
          'col_fecha_modificacion' => $now
        );

        // Update record
        if($this->Color_model->update($data)){
          redirect(base_url()."Mantenimiento/Color");
        }else{
          $this->session->set_flashdata("error", "No se pudo guardar la información");
          redirect(base_url()."Mantenimiento/Color/edit/".$col_id);
        }              
      }
    }else{
      $params = array(
        'data' => $this->Color_model->getId($col_id)
      );

      $this->load->view('layouts/header');
      $this->load->view("layouts/aside");
      $this->load->view('mantenimiento/color/edit', $params);
      $this->load->view('layouts/footer');         
    }
	}

  public function delete($col_id){
    if(!$this->Color_model->delete($col_id)){
      $this->session->set_flashdata("error", "No se pudo realizar la operación");
    }     
    // Return controller for refresh page
    echo "Mantenimiento/Color";
  }

  public function validate_codigo($col_codigo){
    $data = array ('col_id' => $this->input->post('col_id'), 'col_codigo' => $col_codigo);
    $this->form_validation->set_message('validate_codigo', 'El {field} ingresado ya existe');
    return $this->Color_model->validate_codigo($data);
  }
}
