<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
	    
		parent::__construct();
		$this->load->model("Usuario_model");
		
	}
	public function index(){
	    
		if ($this->session->userdata("login")) {
			redirect(base_url()."dashboard");
		}
		else{
			$this->load->view("login");
		}
		
	}

  public function login(){
		// Validación
		$this->form_validation->set_rules('usu_username', 'Usuario', 'trim|required|min_length[3]|max_length[20]');
		$this->form_validation->set_rules('usu_password', 'Clave', 'trim|required|min_length[3]|max_length[20]');		

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('ingreso');
		}
		else
		{

			$usu_username = $this->input->post("usu_username");
			$usu_password = $this->input->post("usu_password");
			$res = $this->Usuario_model->login($usu_username, $usu_password);

			if (!$res) {
				$this->session->set_flashdata("error","Usuario y/o Clave incorrectos");
				redirect(base_url(), 'refresh');
			}
			else{
				$data  = array(
					'usu_id' => $res->usu_id, 
					'usu_username' => $res->usu_username,
					'usu_nombre' => $res->usu_nombre,
					'rol_id' => $res->rol_id,
					'login' => TRUE
				);
				$this->session->set_userdata($data);
				redirect(base_url().'dashboard');
			}
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
