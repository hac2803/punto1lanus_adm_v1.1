<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
  private $permisos;

  public function __construct()
  {
    parent::__construct();

    if (!$this->session->userdata("login")) {
			redirect(base_url());
    }

    $this->permisos = $this->backend_lib->control();

    $this->load->model('Usuario_model');
  }
	
	public function index() {
    $params = array(
      'permisos' => $this->permisos,
      'records' => $this->Usuario_model->get()
    );   

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("administrador/usuario/list", $params);
		$this->load->view("layouts/footer");
	}

  public function add()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST"){ 
      // Validación
      $this->form_validation->set_rules('usu_username', 'Usuario', 'trim|required|min_length[3]|max_length[20]|is_unique[tm_usu_usuario.usu_username]');
      $this->form_validation->set_rules('usu_password', 'Clave', 'trim|required|min_length[3]|max_length[20]');
      $this->form_validation->set_rules('usu_password_confirmacion', 'Confirmación de Clave', 'trim|required|matches[usu_password]|min_length[3]|max_length[20]');
      $this->form_validation->set_rules('usu_nombre', 'Nombre', 'trim|required|min_length[3]|max_length[50]');
      $this->form_validation->set_rules('usu_apellido', 'Apellido', 'trim|required|min_length[3]|max_length[50]');
      $this->form_validation->set_rules('usu_email', 'Email', 'trim|valid_email|max_length[100]');
      $this->form_validation->set_rules('usu_activo', 'Activo', 'required');
      $this->form_validation->set_rules('rol_id', 'Rol', 'required');

      if ($this->form_validation->run() == FALSE) {
        
        $params = array(
          'roles' => $this->Usuario_model->getRoles()
        );     

        $this->load->view('layouts/header');
        $this->load->view("layouts/aside");
        $this->load->view('administrador/usuario/add', $params);
        $this->load->view('layouts/footer');
      }
      else
      {
        // Get current date
        $now = date('Y-m-d H:i:s');

        // Assign data into array elements
        $data = array
        (
          'usu_username' => $this->input->post('usu_username'),
          'usu_password' => md5($this->input->post('usu_password')),
          'usu_nombre' => $this->input->post('usu_nombre'),
          'usu_apellido' => $this->input->post('usu_apellido'),
          'usu_email' => $this->input->post('usu_email'),
          'usu_activo' => (int) $this->input->post('usu_activo'),
          'rol_id' => $this->input->post('rol_id'),
          'usu_usuario_creacion' => $this->session->userdata("usu_username"),
          'usu_fecha_creacion' => $now
        );

        // Insert record
        if($this->Usuario_model->insert($data)){
          redirect(base_url()."Administrador/Usuario");
        }else{
          $this->session->set_flashdata("error", "No se pudo guardar la información");
          redirect(base_url()."Administrador/Usuario/add");
        }   
      }

    }else{

      $params = array(
        'roles' => $this->Usuario_model->getRoles()
      );      

      $this->load->view('layouts/header');
      $this->load->view("layouts/aside");
      $this->load->view('administrador/usuario/add', $params);
      $this->load->view('layouts/footer');
    }
  }

	public function edit($usu_id) {

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      // Validación
      $this->form_validation->set_rules('usu_id', 'Id', 'required');
      $this->form_validation->set_rules('usu_username', 'Usuario', 'trim|required|min_length[3]|max_length[20]');
      // $this->form_validation->set_rules('usu_password', 'Clave', 'trim|required|min_length[3]|max_length[20]');
      $this->form_validation->set_rules('usu_nombre', 'Nombre', 'trim|required|min_length[3]|max_length[50]');
      $this->form_validation->set_rules('usu_apellido', 'Apellido', 'trim|required|min_length[3]|max_length[50]');
      $this->form_validation->set_rules('usu_email', 'Email', 'trim|valid_email|max_length[100]');
      $this->form_validation->set_rules('usu_activo', 'Activo', 'required');
      $this->form_validation->set_rules('rol_id', 'Rol', 'required');

      if ($this->form_validation->run() == FALSE)
      {

        $params = array(
          'roles' => $this->Usuario_model->getRoles()
        );

        $this->load->view('layouts/header');
        $this->load->view("layouts/aside");
        $this->load->view('administrador/usuario/edit', $params);
        $this->load->view('layouts/footer');        
      }
      else
      {
        // Get current date
        $now = date('Y-m-d H:i:s');

        // Assign data into array elements
        $data = array
        (
          'usu_id' => $this->input->post('usu_id'),
          'usu_username' => $this->input->post('usu_username'),
          'usu_nombre' => $this->input->post('usu_nombre'),
          'usu_apellido' => $this->input->post('usu_apellido'),
          'usu_email' => $this->input->post('usu_email'),
          'usu_activo' => (int) $this->input->post('usu_activo'),
          'rol_id' => $this->input->post('rol_id'),
          'usu_usuario_modificacion' => $this->session->userdata("usu_username"),
          'usu_fecha_modificacion' => $now
        );

        // Update record
        if($this->Usuario_model->update($data)){
          redirect(base_url()."Administrador/Usuario");
        }else{
          $this->session->set_flashdata("error", "No se pudo guardar la información");
          redirect(base_url()."Administrador/Usuario/edit");
        }
      }
    }else{

      $params = array(
        'data' => $this->Usuario_model->getId($usu_id),
        'roles' => $this->Usuario_model->getRoles()
      );

      $this->load->view('layouts/header');
      $this->load->view("layouts/aside");
      $this->load->view('administrador/usuario/edit', $params);
      $this->load->view('layouts/footer');         
    }

  }

  public function delete($usu_id){
    if(!$this->Usuario_model->delete($usu_id)){
      $this->session->set_flashdata("error", "No se pudo realizar la operación");
    }     
    // Return controller for refresh page
    echo "Administrador/Usuario";
  }  

	public function cambiar_clave() {

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      // Validación
      $this->form_validation->set_rules('usu_id', 'ID', 'trim|required');
      $this->form_validation->set_rules('usu_username', 'Usuario', 'trim|required');
      $this->form_validation->set_rules('usu_nombre', 'Nombre', 'trim|required');
      $this->form_validation->set_rules('usu_apellido', 'Apellido', 'trim|required');
      $this->form_validation->set_rules('usu_password', 'Clave Actual', 'trim|required|min_length[3]|max_length[20]');
      $this->form_validation->set_rules('usu_password_nueva', 'Nueva Clave', 'trim|required|min_length[3]|max_length[20]');
      $this->form_validation->set_rules('usu_password_confirmacion', 'Confirmación Nueva Clave', 'trim|required|matches[usu_password_nueva]|min_length[3]|max_length[20]');

      if ($this->form_validation->run() == FALSE)
      {
        $this->load->view('layouts/header');
        $this->load->view("layouts/aside");
        $this->load->view('administrador/usuario/cambiar_clave');
        $this->load->view('layouts/footer');        
      }
      else
      {
        // Get current date
        $now = date('Y-m-d H:i:s');

        // Assign data into array elements
        $data = array
        (
          'usu_id' => $this->input->post('usu_id'),
          'usu_password' => md5($this->input->post('usu_password')),
          'usu_password_nueva' => md5($this->input->post('usu_password_nueva')),
          'usu_usuario_modificacion' => $this->session->userdata("usu_username"),
          'usu_fecha_modificacion' => $now
        );

        // Update record
        if($this->Usuario_model->update_clave($data)){
          // redirect(base_url()."dashboard");
          $this->session->set_flashdata("success", "La Clave fue actualizada correctamente");
          redirect(base_url()."Administrador/Usuario/cambiar_clave");
        }else{
          $this->session->set_flashdata("error", "No se pudo guardar la información");
          redirect(base_url()."Administrador/Usuario/cambiar_clave");
        }

      }
    }else{

      // Obtiene Usuario
      $usu_id = $this->session->userdata("usu_id");

      $params = array(
        'data' => $this->Usuario_model->getId($usu_id)
      );      

      $this->load->view('layouts/header');
      $this->load->view("layouts/aside");
      $this->load->view('administrador/usuario/cambiar_clave', $params);
      $this->load->view('layouts/footer');         
    }
	}

}
