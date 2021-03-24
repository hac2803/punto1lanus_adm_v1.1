<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cliente extends CI_Controller
{
  private $permisos;

  public function __construct()
  {
    parent::__construct();

    if (!$this->session->userdata("login")) {
      redirect(base_url());
    }

    $this->permisos = $this->backend_lib->control();
    $this->load->model('Cliente_model');
  }

  public function index()
  {
    $params = array(
      'permisos' => $this->permisos,
      'records' => $this->Cliente_model->get()
    );

    $this->load->view("layouts/header");
    $this->load->view("layouts/aside");
    $this->load->view("mantenimiento/cliente/list", $params);
    $this->load->view("layouts/footer");
  }

  public function add()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Validación
      $this->form_validation->set_rules('cli_nombre', 'Nombre', 'trim|required|min_length[3]|max_length[50]');
      $this->form_validation->set_rules('cli_telefono', 'Teléfono', 'trim|required|min_length[8]|max_length[20]|callback_validate_telefono');

      if ($this->form_validation->run() == FALSE) {
        $this->load->view('layouts/header');
        $this->load->view("layouts/aside");
        $this->load->view('mantenimiento/cliente/add');
        $this->load->view('layouts/footer');
      } else {
        // Get current date
        $now = date('Y-m-d H:i:s');

        // Assign data into array elements
        $data = array(
          'cli_nombre' => strtoupper($this->input->post('cli_nombre')),
          'cli_telefono' => $this->input->post('cli_telefono'),
          'cli_usuario_creacion' => $this->session->userdata("usu_username"),
          'cli_fecha_creacion' => $now
        );

        // Insert record
        if ($this->Cliente_model->insert($data)) {
          redirect(base_url() . "Mantenimiento/Cliente");
        } else {
          $this->session->set_flashdata("error", "No se pudo guardar la información");
          redirect(base_url() . "Mantenimiento/Cliente/add");
        }
      }
    } else {
      $this->load->view('layouts/header');
      $this->load->view("layouts/aside");
      $this->load->view('mantenimiento/cliente/add');
      $this->load->view('layouts/footer');
    }
  }

  public function edit($cli_id)
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Validación
      $this->form_validation->set_rules('cli_nombre', 'Nombre', 'trim|required|min_length[3]|max_length[50]');
      $this->form_validation->set_rules('cli_telefono', 'Teléfono', 'trim|required|min_length[8]|max_length[20]|callback_validate_telefono');

      if ($this->form_validation->run() == FALSE) {
        $this->load->view('layouts/header');
        $this->load->view("layouts/aside");
        $this->load->view('mantenimiento/cliente/edit');
        $this->load->view('layouts/footer');
      } else {
        // Get current date
        $now = date('Y-m-d H:i:s');

        // Assign data into array elements
        $data = array(
          'cli_id' => $this->input->post('cli_id'),
          'cli_nombre' => strtoupper($this->input->post('cli_nombre')),
          'cli_telefono' => $this->input->post('cli_telefono'),
          'cli_usuario_modificacion' => $this->session->userdata("usu_username"),
          'cli_fecha_modificacion' => $now
        );

        // Update record
        if ($this->Cliente_model->update($data)) {
          redirect(base_url() . "Mantenimiento/Cliente");
        } else {
          $this->session->set_flashdata("error", "No se pudo guardar la información");
          redirect(base_url() . "Mantenimiento/Cliente/edit/" . $cli_id);
        }
      }
    } else {
      $params = array(
        'data' => $this->Cliente_model->getId($cli_id)
      );

      $this->load->view('layouts/header');
      $this->load->view("layouts/aside");
      $this->load->view('mantenimiento/cliente/edit', $params);
      $this->load->view('layouts/footer');
    }
  }

  public function delete($cli_id)
  {
    if (!$this->Cliente_model->delete($cli_id)) {
      $this->session->set_flashdata("error", "No se pudo realizar la operación");
    }
    // Return controller for refresh page
    echo "Mantenimiento/Cliente";
  }

  public function validate_telefono($cli_telefono)
  {
    $data = array ('cli_id' => $this->input->post('cli_id'), 'cli_telefono' => $cli_telefono);
    $this->form_validation->set_message('validate_telefono', 'El {field} ingresado ya existe');
    return $this->Cliente_model->validate_telefono($data);
  }

}
