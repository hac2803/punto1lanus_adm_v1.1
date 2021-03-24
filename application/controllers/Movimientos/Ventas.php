<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ventas extends CI_Controller
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
    $this->load->model('Ventas_model');
    $this->load->model('Cliente_model');
    $this->load->model('Tipo_Valor_model');
    $this->load->model('Valor_model');
  }

  public function add()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Get current date
      $now = date('Y-m-d H:i:s');
      $now_short = date('Y-m-d');

      $sto_codigo_barras = $this->input->post('array_sto_codigo_barras');
      $ved_precio_venta = $this->input->post('array_ved_precio_venta');
      $vec_importe = $this->input->post('vec_importe');
      $vec_id = 0;
      $tva_id = $this->input->post('array_tva_id');
      $val_importe = $this->input->post('array_val_importe');
      $vec_valor = $this->input->post('vec_valor');
      $vec_saldo = $this->input->post('vec_saldo');
      $cli_id = $this->input->post('cli_id');

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

          // Cantidad
          if ($ved_precio_venta[$i] >= 0) {
            $cantidad = 1; // Venta
            $tmo_codigo = 2; // Venta
          } else {
            $cantidad = -1; // Cambio
            $tmo_codigo = 4; // Cambio
          }

          if (isset($stock)) {
            $sto_cantidad = $stock->sto_cantidad;

            // Assign data into array elements
            $data = array(
              'sto_codigo_barras' => $sto_codigo_barras[$i],
              'art_id' => $art_id,
              'col_id' => $col_id,
              'sto_cantidad' => $sto_cantidad - $cantidad,
              'sto_usuario_modificacion' => $this->session->userdata("usu_username"),
              'sto_fecha_modificacion' => $now
            );

            // Update record
            $res = $this->Stock_model->update($data);

          } else {
            $sto_cantidad = 0;

            // Assign data into array elements
            $data = array(
              'sto_codigo_barras' => $sto_codigo_barras[$i],
              'sto_codigo' => $sto_codigo,
              'col_codigo' => $col_codigo,
              'art_id' => $art_id,
              'col_id' => $col_id,
              'sto_talle' => $sto_talle,
              'sto_cantidad' => $sto_cantidad - $cantidad,
              'sto_usuario_creacion' => $this->session->userdata("usu_username"),
              'sto_fecha_creacion' => $now
            );

            // Insert record
            $res = $this->Stock_model->insert($data);
          }

          // Agrega Movimiento de Stock
          if ($res) {
            // Assign data into array elements
            $data = array(
              'mst_fecha' => $now_short,
              'sto_codigo_barras' => $sto_codigo_barras[$i],
              'tmo_codigo' => $tmo_codigo,
              'mst_cantidad' => -1,
              'mst_stock_anterior' => $sto_cantidad,
              'mst_stock_actual' => $sto_cantidad - $cantidad,
              'mst_usuario_creacion' => $this->session->userdata("usu_username"),
              'mst_fecha_creacion' => $now
            );

            $res = $this->Stock_model->insertMovimiento($data);

            // Get ID Movimiento insertado
            $mst_id = $this->Ventas_model->lastID();
          }

          // Agrega Venta Cabecera
          if ($res && $vec_id == 0) {
            // Assign data into array elements
            $data = array(
              'vec_fecha' => $now_short,
              'cli_id' => $cli_id,
              'vec_importe' => $vec_importe,
              'vec_valor' => $vec_valor,
              'vec_saldo' => $vec_saldo,
              'vec_usuario_creacion' => $this->session->userdata("usu_username"),
              'vec_fecha_creacion' => $now
            );

            $res = $this->Ventas_model->insertCabecera($data);

            // Get ID Venta insertada
            $vec_id = $this->Ventas_model->lastID();
          }

          // Agrega Venta Detalle
          if ($res) {
            // Assign data into array elements
            $data = array(
              'vec_id' => $vec_id,
              'sto_codigo_barras' => $sto_codigo_barras[$i],
              'mst_id' => $mst_id,
              'ved_precio_venta' => $ved_precio_venta[$i],
              'ved_usuario_creacion' => $this->session->userdata("usu_username"),
              'ved_fecha_creacion' => $now
            );

            $res = $this->Ventas_model->insertDetalle($data);
          }
        }
      } // for

      // Valores
      for ($i = 0; $i < count($tva_id); $i++) {
        if ($res) {
          // Assign data into array elements
          $data = array(
            'val_fecha' => $now_short,
            'tva_id' => $tva_id[$i],
            'val_importe' => $val_importe[$i],
            'vec_id' => $vec_id,
            'val_usuario_creacion' => $this->session->userdata("usu_username"),
            'val_fecha_creacion' => $now
          );

          $res = $this->Valor_model->insert($data);
        }
      } // for

      if ($res) {
        $this->db->trans_commit();
        redirect(base_url() . "Movimientos/Ventas/add");
      } else {
        $dbError = $this->db->error();
        $error = $dbError['message'];

        $this->db->trans_rollback();
        $this->session->set_flashdata("error", "No se pudo guardar la información: " . $error);

        redirect(base_url() . "Movimientos/Ventas/add");
      }
    } else {

      $data = array(
        'clientes' => $this->Cliente_model->get(),
        'tipos_valor' => $this->Tipo_Valor_model->get()
      );

      $this->load->view("layouts/header");
      $this->load->view("layouts/aside");
      $this->load->view("movimientos/ventas/add", $data);
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

    if (count($articulo) == 1) {
      $art_nombre = $articulo->art_nombre;
    } else {
      $art_nombre = "";
    }

    if (count($color) == 1) {
      $col_nombre = $color->col_nombre;
    } else {
      $col_nombre = "";
    }

    $resultados = array(
      'sto_codigo_barras' => $sto_codigo_barras,
      'art_nombre' => Null2Empty($art_nombre),
      'col_nombre' => Null2Empty($col_nombre),
      'sto_talle' => $sto_talle
    );

    echo json_encode($resultados);
  }

  public function deudores()
  {

    $params = array(
      'permisos' => $this->permisos,
      'records' => $this->Ventas_model->getDeudores()
    );

    $this->load->view("layouts/header");
    $this->load->view("layouts/aside");
    $this->load->view("movimientos/ventas/deudores", $params);
    $this->load->view("layouts/footer");
  }


  public function edit($vec_id, $caller)
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Get current date
      $now = date('Y-m-d H:i:s');
      $now_short = date('Y-m-d');

      $tva_id = $this->input->post('array_tva_id');
      $val_importe = $this->input->post('array_val_importe');
      $val_id = $this->input->post('array_val_id');
      $vec_valor = $this->input->post('vec_valor');
      $vec_saldo = $this->input->post('vec_saldo');

      $this->db->trans_begin();
      $res = true;

      // Update Venta Cabecera
      if ($res) {
        // Assign data into array elements
        $data = array(
          'vec_id' => $vec_id,
          'vec_valor' => $vec_valor,
          'vec_saldo' => $vec_saldo,
          'vec_usuario_modificacion' => $this->session->userdata("usu_username"),
          'vec_fecha_modificacion' => $now
        );

        $res = $this->Ventas_model->updateCabecera($data);
      }

      // Valores
      if ($res) {
        for ($i = 0; $i < count($tva_id); $i++) {
          if ($val_id[$i] == 0) {
            // Assign data into array elements
            $data = array(
              'val_fecha' => $now_short,
              'tva_id' => $tva_id[$i],
              'val_importe' => $val_importe[$i],
              'vec_id' => $vec_id,
              'val_usuario_creacion' => $this->session->userdata("usu_username"),
              'val_fecha_creacion' => $now
            );

            $res = $this->Valor_model->insert($data);
          }
        } // for
      }

      if ($res) {
        $this->db->trans_commit();

        switch ($caller) {
          case 1:
            $redirect = "Consultas/Ventas";
            break;
          case 2:
            $redirect = "Movimientos/Ventas/deudores";
            break;
          case 3:
            $redirect = "Consultas/Valor";
            break;
        }
        if ($caller == 1) {
          $redirect = "Consultas/Ventas";
        }

        redirect(base_url() . $redirect);
      } else {
        $dbError = $this->db->error();
        $error = $dbError['message'];

        $this->db->trans_rollback();
        $this->session->set_flashdata("error", "No se pudo guardar la información: " . $error);

        redirect(base_url() . "Movimientos/Ventas/edit");
      }
    } else {

      $data = array(
        'venta_cabecera' => $this->Ventas_model->getVentaCabecera($vec_id),
        'articulos' => $this->Ventas_model->getVentaDetalle($vec_id),
        'valores' => $this->Valor_model->getValores($vec_id),
        'tipos_valor' => $this->Tipo_Valor_model->get(),
        'caller' => $caller
      );

      $this->load->view("layouts/header");
      $this->load->view("layouts/aside");
      $this->load->view("movimientos/ventas/edit", $data);
      $this->load->view("layouts/footer");
    }
  }
}
