<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{
  private $permisos;

  public function __construct()
  {
    parent::__construct();

    if (!$this->session->userdata("login")) {
      redirect(base_url());
    }

    $this->permisos = $this->backend_lib->control();
    $this->load->model('Stock_model');
    $this->load->model('Articulo_model');
    $this->load->model('Color_model');
  }

  public function ingreso()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Get current date
      $now = date('Y-m-d H:i:s');
      $now_short = date('Y-m-d');

      $sto_codigo_barras = $this->input->post('array_sto_codigo_barras');

      $this->db->trans_begin();
      $res = true;

      for ($i = 0; $i < count($sto_codigo_barras); $i++) {

        if ($res) {
          $sto_codigo = substr($sto_codigo_barras[$i], 0, 6);
          $col_codigo = substr($sto_codigo_barras[$i], 6, 3);
          $sto_talle = substr($sto_codigo_barras[$i], 9, 3);

          $stock = $this->Stock_model->getPorCodigoBarras($sto_codigo_barras[$i]);

          // Busca Artículo
          $result = $this->Articulo_model->getPorCodigoStock($sto_codigo);
          if (isset($result)) {
            $art_id = $result->art_id;
          } else {
            $art_id = 0;
          }

          // Busca Color
          $result = $this->Color_model->getPorCodigo($col_codigo);
          if (isset($result)) {
            $col_id = $result->col_id;
          } else {
            $col_id = 0;
          }

          if (isset($stock)) {
            $cantidad_anterior = $stock->sto_cantidad;

            // Assign data into array elements
            $data = array(
              'sto_codigo_barras' => $sto_codigo_barras[$i],
              'art_id' => $art_id,
              'col_id' => $col_id,
              'sto_cantidad' => $stock->sto_cantidad + 1,
              'sto_usuario_modificacion' => $this->session->userdata("usu_username"),
              'sto_fecha_modificacion' => $now
            );

            // Update record
            $res = $this->Stock_model->update($data);
          } else {
            $cantidad_anterior = 0;

            // Assign data into array elements
            $data = array(
              'sto_codigo_barras' => $sto_codigo_barras[$i],
              'sto_codigo' => $sto_codigo,
              'art_id' => $art_id,
              'col_id' => $col_id,
              'col_codigo' => $col_codigo,
              'sto_talle' => $sto_talle,
              'sto_cantidad' => 1,
              'sto_usuario_creacion' => $this->session->userdata("usu_username"),
              'sto_fecha_creacion' => $now
            );

            // Insert record
            $res = $this->Stock_model->insert($data);
          }

          if ($res) {
            // Assign data into array elements
            $data = array(
              'mst_fecha' => $now_short,
              'sto_codigo_barras' => $sto_codigo_barras[$i],
              'tmo_codigo' => 1, // Ingreso de Stock
              'mst_cantidad' => 1,
              'mst_stock_anterior' => $cantidad_anterior,
              'mst_stock_actual' => $cantidad_anterior + 1,
              'mst_usuario_creacion' => $this->session->userdata("usu_username"),
              'mst_fecha_creacion' => $now
            );

            // Agrega Movimiento de Stock
            $res = $this->Stock_model->insertMovimiento($data);
          }
        }
      } // for

      if ($res) {
        $this->db->trans_commit();
        redirect(base_url() . "Movimientos/Stock/ingreso");
      } else {
        $dbError = $this->db->error();
        $error = $dbError['message'];

        $this->db->trans_rollback();
        $this->session->set_flashdata("error", "No se pudo guardar la información: " . $error);

        redirect(base_url() . "Movimientos/Stock/ingreso");
      }
    } else {

      $this->load->view("layouts/header");
      $this->load->view("layouts/aside");
      $this->load->view("movimientos/stock/ingreso");
      $this->load->view("layouts/footer");
    }
  }

  public function ajuste()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Get current date
      $now = date('Y-m-d H:i:s');
      $now_short = date('Y-m-d');

      $sto_codigo_barras = $this->input->post('array_sto_codigo_barras');
      $sto_cantidad = $this->input->post('array_sto_cantidad');

      $this->db->trans_begin();
      $res = true;

      for ($i = 0; $i < count($sto_codigo_barras); $i++) {
        if ($res) {
          $sto_codigo = substr($sto_codigo_barras[$i], 0, 6);
          $col_codigo = substr($sto_codigo_barras[$i], 6, 3);
          $sto_talle = substr($sto_codigo_barras[$i], 9, 3);

          $stock = $this->Stock_model->getPorCodigoBarras($sto_codigo_barras[$i]);

          // Busca Artículo
          $result = $this->Articulo_model->getPorCodigoStock($sto_codigo);
          if (isset($result)) {
            $art_id = $result->art_id;
          } else {
            $art_id = 0;
          }

          // Busca Color
          $result = $this->Color_model->getPorCodigo($col_codigo);
          if (isset($result)) {
            $col_id = $result->col_id;
          } else {
            $col_id = 0;
          }

          if (isset($stock)) {
            $cantidad_anterior = $stock->sto_cantidad;

            // Assign data into array elements
            $data = array(
              'sto_codigo_barras' => $sto_codigo_barras[$i],
              'art_id' => $art_id,
              'col_id' => $col_id,
              'sto_cantidad' => $sto_cantidad[$i],
              'sto_usuario_modificacion' => $this->session->userdata("usu_username"),
              'sto_fecha_modificacion' => $now
            );

            // Update record
            $res = $this->Stock_model->update($data);
          } else {

            $cantidad_anterior = 0;

            // Assign data into array elements
            $data = array(
              'sto_codigo_barras' => $sto_codigo_barras[$i],
              'sto_codigo' => $sto_codigo,
              'art_id' => $art_id,
              'col_id' => $col_id,
              'col_codigo' => $col_codigo,
              'sto_talle' => $sto_talle,
              'sto_cantidad' => $sto_cantidad[$i],
              'sto_usuario_creacion' => $this->session->userdata("usu_username"),
              'sto_fecha_creacion' => $now
            );

            // Insert record
            $res = $this->Stock_model->insert($data);
          }

          if ($res) {
            // Assign data into array elements
            $data = array(
              'mst_fecha' => $now_short,
              'sto_codigo_barras' => $sto_codigo_barras[$i],
              'tmo_codigo' => 3, // Ajuste de Stock
              'mst_cantidad' => $sto_cantidad[$i] - $cantidad_anterior,
              'mst_stock_anterior' => $cantidad_anterior,
              'mst_stock_actual' => $sto_cantidad[$i],
              'mst_usuario_creacion' => $this->session->userdata("usu_username"),
              'mst_fecha_creacion' => $now
            );

            // Agrega Movimiento de Stock
            $res = $this->Stock_model->insertMovimiento($data);
          }
        }
      } // for

      if ($res) {
        $this->db->trans_commit();
        redirect(base_url() . "Movimientos/Stock/ajuste");
      } else {
        $dbError = $this->db->error();
        $error = $dbError['message'];

        $this->db->trans_rollback();
        $this->session->set_flashdata("error", "No se pudo guardar la información: " . $error);

        redirect(base_url() . "Movimientos/Stock/ajuste");
      }
    } else {

      $this->load->view("layouts/header");
      $this->load->view("layouts/aside");
      $this->load->view("movimientos/stock/ajuste");
      $this->load->view("layouts/footer");
    }
  }

  public function getPorCodigoBarrasAjax()
  {
    // Called from AJAX
    $json_data = json_decode(file_get_contents('php://input'), true);
    $sto_codigo_barras = $json_data['codigo_barras'];

    $sto_codigo = substr($sto_codigo_barras, 0, 6);
    $col_codigo = substr($sto_codigo_barras, 6, 3);
    $sto_talle = substr($sto_codigo_barras, 9, 3);

    $articulo = $this->Articulo_model->getPorCodigoStock($sto_codigo);
    $color = $this->Color_model->getPorCodigo($col_codigo);
    $stock = $this->Stock_model->getPorCodigoBarras($sto_codigo_barras);

    // if (count((array) $articulo) == 1) {
    if (isset($articulo)) {
      $art_nombre = $articulo->art_nombre;
      $art_precio_venta = $articulo->art_precio_venta;
    } else {
      $art_nombre = "";
      $art_precio_venta = 0.00;
    }

    // if (count((array) $color) == 1) {
    if (isset($color)) {
      $col_nombre = $color->col_nombre;
    } else {
      $col_nombre = "";
    }

    // if (count((array) $stock) == 1) {
    if (isset($stock)) {
      $sto_cantidad = $stock->sto_cantidad;
    } else {
      $sto_cantidad = 0;
    }

    $resultados = array(
      'sto_codigo_barras' => $sto_codigo_barras,
      'art_nombre' => Null2Empty($art_nombre),
      'col_nombre' => Null2Empty($col_nombre),
      'sto_talle' => $sto_talle,
      'art_precio_venta' => $art_precio_venta,
      'sto_cantidad' => $sto_cantidad
    );

    echo json_encode($resultados);
  }

  public function add()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Validación
      $this->form_validation->set_rules('col_codigo', 'Código', 'trim|required|min_length[3]|max_length[3]|callback_validate_codigo');
      $this->form_validation->set_rules('col_nombre', 'Nombre', 'trim|required|max_length[30]');

      if ($this->form_validation->run() == FALSE) {
        $this->load->view('layouts/header');
        $this->load->view("layouts/aside");
        $this->load->view('mantenimiento/color/add');
        $this->load->view('layouts/footer');
      } else {
        // Get current date
        $now = date('Y-m-d H:i:s');

        // Assign data into array elements
        $data = array(
          'col_codigo' => $this->input->post('col_codigo'),
          'col_nombre' => $this->input->post('col_nombre'),
          'col_usuario_creacion' => $this->session->userdata("usu_username"),
          'col_fecha_creacion' => $now
        );

        // Insert record
        if ($this->Color_model->insert($data)) {
          redirect(base_url() . "Mantenimiento/Color");
        } else {
          $this->session->set_flashdata("error", "No se pudo guardar la información");
          redirect(base_url() . "Mantenimiento/Color/add");
        }
      }
    } else {
      $this->load->view('layouts/header');
      $this->load->view("layouts/aside");
      $this->load->view('mantenimiento/color/add');
      $this->load->view('layouts/footer');
    }
  }

  public function edit($col_id)
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Validación
      $this->form_validation->set_rules('col_codigo', 'Código', 'trim|required|min_length[3]|max_length[3]|callback_validate_codigo');
      $this->form_validation->set_rules('col_nombre', 'Nombre', 'trim|required|max_length[30]');

      if ($this->form_validation->run() == FALSE) {
        $this->load->view('layouts/header');
        $this->load->view("layouts/aside");
        $this->load->view('mantenimiento/color/edit');
        $this->load->view('layouts/footer');
      } else {
        // Get current date
        $now = date('Y-m-d H:i:s');

        // Assign data into array elements
        $data = array(
          'col_id' => $this->input->post('col_id'),
          'col_codigo' => $this->input->post('col_codigo'),
          'col_nombre' => $this->input->post('col_nombre'),
          'col_usuario_modificacion' => $this->session->userdata("usu_username"),
          'col_fecha_modificacion' => $now
        );

        // Update record
        if ($this->Color_model->update($data)) {
          redirect(base_url() . "Mantenimiento/Color");
        } else {
          $this->session->set_flashdata("error", "No se pudo guardar la información");
          redirect(base_url() . "Mantenimiento/Color/edit/" . $col_id);
        }
      }
    } else {
      $params = array(
        'data' => $this->Color_model->getId($col_id)
      );

      $this->load->view('layouts/header');
      $this->load->view("layouts/aside");
      $this->load->view('mantenimiento/color/edit', $params);
      $this->load->view('layouts/footer');
    }
  }

  public function delete($col_id)
  {
    if (!$this->Color_model->delete($col_id)) {
      $this->session->set_flashdata("error", "No se pudo realizar la operación");
    }
    // Return controller for refresh page
    echo "Mantenimiento/Color";
  }

  public function validate_codigo($col_codigo)
  {
    $data = array('col_id' => $this->input->post('col_id'), 'col_codigo' => $col_codigo);
    $this->form_validation->set_message('validate_codigo', 'El {field} ingresado ya existe');
    return $this->Color_model->validate_codigo($data);
  }
}
