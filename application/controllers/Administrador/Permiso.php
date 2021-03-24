<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permiso extends CI_Controller {
  private $permisos;

	public function __construct(){
    parent::__construct();
    
    if (!$this->session->userdata("login")) {
			redirect(base_url());
    }

		$this->permisos = $this->backend_lib->control();
		$this->load->model("Permiso_model");
		$this->load->model("Usuario_model");
	}

	public function index(){
    $params = array(
      'records' => $this->Permiso_model->get()
    );   

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("administrador/permiso/list", $params);
		$this->load->view("layouts/footer");
	}

	public function add(){

    if ($_SERVER["REQUEST_METHOD"] == "POST"){ 
      // Validación
      $this->form_validation->set_rules('rol_id', 'Rol', 'trim|required');
      $this->form_validation->set_rules('men_id', 'Menú', 'trim|required|callback_unique_permiso');
      $this->form_validation->set_rules('prm_read', 'Leer', 'trim');
      $this->form_validation->set_rules('prm_insert', 'Crear', 'trim');
      $this->form_validation->set_rules('prm_update', 'Modificar', 'trim');
      $this->form_validation->set_rules('prm_delete', 'Borrar', 'trim');

      if ($this->form_validation->run() == FALSE) {

        $params = array(
          'roles' => $this->Usuario_model->getRoles(),
          'menus' => $this->Permiso_model->getMenus()
        );

        $this->load->view('layouts/header');
        $this->load->view("layouts/aside");        
        $this->load->view('administrador/permiso/add', $params);
        $this->load->view('layouts/footer');
      }
      else
      {

        // Assign data into array elements
        $data = array
        (
          'men_id' => $this->input->post("men_id"),
          'rol_id' => $this->input->post("rol_id"),
          'prm_read' => (int) $this->input->post("prm_read"),
          'prm_insert' => (int) $this->input->post("prm_insert"),
          'prm_update' => (int) $this->input->post("prm_update"),
          'prm_delete' => (int) $this->input->post("prm_delete")
        );

        // Insert record
        if($this->Permiso_model->insert($data)){
          redirect(base_url()."Administrador/Permiso");
        }else{
          $this->session->set_flashdata("error", "No se pudo guardar la información");
          redirect(base_url()."Administrador/Permiso/add");
        }
      }
    }else{
      $params = array(
        'roles' => $this->Usuario_model->getRoles(),
        'menus' => $this->Permiso_model->getMenus()
      );

      $this->load->view('layouts/header');
      $this->load->view("layouts/aside");        
      $this->load->view('administrador/permiso/add', $params);
      $this->load->view('layouts/footer');
    }
  }


	public function edit($prm_id) {

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      // Validación
      $this->form_validation->set_rules('rol_id', 'Rol', 'trim|required');
      $this->form_validation->set_rules('men_id', 'Menú', 'trim|required|callback_unique_permiso');
      $this->form_validation->set_rules('prm_read', 'Leer', 'trim');
      $this->form_validation->set_rules('prm_insert', 'Crear', 'trim');
      $this->form_validation->set_rules('prm_update', 'Modificar', 'trim');
      $this->form_validation->set_rules('prm_delete', 'Borrar', 'trim');

      if ($this->form_validation->run() == FALSE)
      {
        $params = array(
          'roles' => $this->Usuario_model->getRoles(),
          'menus' => $this->Permiso_model->getMenus()
        );

        $this->load->view('layouts/header');
        $this->load->view("layouts/aside");        
        $this->load->view('administrador/permiso/edit', $params);
        $this->load->view('layouts/footer');
      }
      else
      {

        $data = array
        (
          'prm_id' => $this->input->post("prm_id"),
          'men_id' => $this->input->post("men_id"),
          'rol_id' => $this->input->post("rol_id"),
          'prm_read' => (int) $this->input->post("prm_read"),
          'prm_insert' => (int) $this->input->post("prm_insert"),
          'prm_update' => (int) $this->input->post("prm_update"),
          'prm_delete' => (int) $this->input->post("prm_delete")
        );        
        
        // Update record
        if($this->Permiso_model->update($data)){
          redirect(base_url()."Administrador/Permiso");
        }else{
          $this->session->set_flashdata("error", "No se pudo guardar la información");
          redirect(base_url()."Administrador/Permiso/edit");
        }
      }
    }else{

      $params = array(
        'data' => $this->Permiso_model->getPermiso($prm_id),
        'roles' => $this->Usuario_model->getRoles(),
        'menus' => $this->Permiso_model->getMenus()
      );

      $this->load->view('layouts/header');
      $this->load->view("layouts/aside");        
      $this->load->view('administrador/permiso/edit', $params);
      $this->load->view('layouts/footer');
    }
	}

  public function delete($prm_id){
    if(!$this->Permiso_model->delete($prm_id)){
      $this->session->set_flashdata("error", "No se pudo realizar la operación");
    }     
    // Return controller for refresh page
    echo "Administrador/Permiso";
  }

  public function unique_permiso()
  {
    $data = array ('prm_id' => $this->input->post('prm_id'), 'rol_id' => $this->input->post('rol_id'), 'men_id' => $this->input->post('men_id'));
    $this->form_validation->set_message('unique_permiso', 'Ya existe el Permiso ingresado');
    return $this->Permiso_model->unique_permiso($data);
  }


}