<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Articulo extends CI_Controller
{
	private $permisos;

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}

		$this->permisos = $this->backend_lib->control();
		$this->load->model('Articulo_model');
		$this->load->model('Parametro_model');
		// $this->load->library('excel');
		$this->load->helper('download');
	}

	public function index()
	{

		$params = array(
			'permisos' => $this->permisos,
			'records' => $this->Articulo_model->get()
		);

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("mantenimiento/articulo/list", $params);
		$this->load->view("layouts/footer");
	}

	public function add()
	{
		// Coeficiente para calcular Precio de Venta
		$coeficiente = $this->Parametro_model->getParametro('COEFICIENTE');

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Validación
			$this->form_validation->set_rules('art_codigo', 'Código', 'trim|required|min_length[7]|max_length[7]|callback_validate_codigo');
			$this->form_validation->set_rules('art_nombre', 'Nombre', 'trim|required|max_length[50]');
			$this->form_validation->set_rules('art_precio_compra', 'Precio Compra', 'trim|required|greater_than[0]');
			$this->form_validation->set_rules('art_precio_venta', 'Precio Venta', 'trim|required|greater_than[0]|callback_validate_precio_venta');
			if (!empty($this->input->post('sto_codigo'))) {
				$this->form_validation->set_rules('sto_codigo', 'Código Stock', 'trim|required|min_length[6]|max_length[6]|callback_validate_codigo_stock');
			}

			if ($this->form_validation->run() == FALSE) {

				$params = array(
					'coeficiente' => $coeficiente
				);

				$this->load->view('layouts/header');
				$this->load->view("layouts/aside");
				$this->load->view('mantenimiento/articulo/add', $params);
				$this->load->view('layouts/footer');
			} else {
				// Get current date
				$now = date('Y-m-d H:i:s');

				// Assign data into array elements
				$data = array(
					'art_codigo' => $this->input->post('art_codigo'),
					'art_nombre' => $this->input->post('art_nombre'),
					'art_precio_compra' => $this->input->post('art_precio_compra'),
					'art_precio_venta' => $this->input->post('art_precio_venta'),
					'sto_codigo' => Empty2Null($this->input->post('sto_codigo')),
					'art_usuario_creacion' => $this->session->userdata("usu_username"),
					'art_fecha_creacion' => $now
				);

				// Insert record
				if ($this->Articulo_model->insert($data)) {
					redirect(base_url() . "Mantenimiento/Articulo");
				} else {
					$this->session->set_flashdata("error", "No se pudo guardar la información");
					redirect(base_url() . "Mantenimiento/Articulo/add");
				}
			}
		} else {

			$params = array(
				'coeficiente' => $coeficiente
			);

			$this->load->view('layouts/header');
			$this->load->view("layouts/aside");
			$this->load->view('mantenimiento/articulo/add', $params);
			$this->load->view('layouts/footer');
		}
	}

	public function edit($art_id)
	{
		// Coeficiente para calcular Precio de Venta
		$coeficiente = $this->Parametro_model->getParametro('COEFICIENTE');

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Validación
			$this->form_validation->set_rules('art_id', 'Id', 'required');
			$this->form_validation->set_rules('art_codigo', 'Código', 'trim|required|min_length[7]|max_length[7]|callback_validate_codigo');
			$this->form_validation->set_rules('art_nombre', 'Nombre', 'trim|required|max_length[50]');
			$this->form_validation->set_rules('art_precio_compra', 'Precio Compra', 'trim|required|greater_than[0]');
			$this->form_validation->set_rules('art_precio_venta', 'Precio Venta', 'trim|required|greater_than[0]|callback_validate_precio_venta');
			if (!empty($this->input->post('sto_codigo'))) {
				$this->form_validation->set_rules('sto_codigo', 'Código Stock', 'trim|required|min_length[6]|max_length[6]|callback_validate_codigo_stock');
			}

			if ($this->form_validation->run() == FALSE) {

				$params = array(
					'coeficiente' => $coeficiente
				);

				$this->load->view('layouts/header');
				$this->load->view("layouts/aside");
				$this->load->view('mantenimiento/articulo/edit', $params);
				$this->load->view('layouts/footer');
			} else {
				// Get current date
				$now = date('Y-m-d H:i:s');

				// Assign data into array elements
				$data = array(
					'art_id' => $this->input->post('art_id'),
					'art_codigo' => $this->input->post('art_codigo'),
					'art_nombre' => $this->input->post('art_nombre'),
					'art_precio_compra' => $this->input->post('art_precio_compra'),
					'art_precio_venta' => $this->input->post('art_precio_venta'),
					'sto_codigo' => Empty2Null($this->input->post('sto_codigo')),
					'art_usuario_modificacion' => $this->session->userdata("usu_username"),
					'art_fecha_modificacion' => $now
				);

				// Update record
				if ($this->Articulo_model->update($data)) {
					redirect(base_url() . "Mantenimiento/Articulo");
				} else {
					$this->session->set_flashdata("error", "No se pudo guardar la información");
					redirect(base_url() . "Mantenimiento/Articulo/edit/" . $art_id);
				}
			}
		} else {

			$params = array(
				'data' => $this->Articulo_model->getId($art_id),
				'art_id' => $art_id,
				'coeficiente' => $coeficiente
			);

			$this->load->view('layouts/header');
			$this->load->view("layouts/aside");
			$this->load->view('mantenimiento/articulo/edit', $params);
			$this->load->view('layouts/footer');
		}
	}

	public function delete($art_id)
	{
		if (!$this->Articulo_model->delete($art_id)) {
			$this->session->set_flashdata("error", "No se pudo realizar la operación");
		};

		// Return controller for refresh page
		echo "Mantenimiento/Articulo";
	}

	public function validate_codigo($art_codigo)
	{
		$data = array('art_id' => $this->input->post('art_id'), 'art_codigo' => $art_codigo);
		$this->form_validation->set_message('validate_codigo', 'El {field} ingresado ya existe');
		return $this->Articulo_model->validate_codigo($data);
	}

	public function validate_precio_venta($art_precio_venta)
	{
		$art_precio_compra = $this->input->post('art_precio_compra');
		$this->form_validation->set_message('validate_precio_venta', 'El Precio Venta no puede ser menor al {field}');
		return ($art_precio_compra < $art_precio_venta);
	}

	public function validate_codigo_stock($sto_codigo)
	{
		$data = array('art_id' => $this->input->post('art_id'), 'sto_codigo' => $sto_codigo);
		$this->form_validation->set_message('validate_codigo_stock', 'El {field} ingresado ya existe');
		return $this->Articulo_model->validate_codigo_stock($data);
	}

	function update_masivo()
	{
		$this->load->view('layouts/header');
		$this->load->view("layouts/aside");
		$this->load->view('mantenimiento/articulo/update_masivo');
		$this->load->view('layouts/footer');
	}

	function importCSV()
	{
		$data = [];

		if (isset($_FILES["file"]["name"])) {
			$csv = $_FILES["file"]["tmp_name"];
			$handle = fopen($csv, "r");  // Open CSV file, read only mode

			// $test = fgetcsv($handle, 10000, ",");

			while (($row = fgetcsv($handle, 10000, ",")) != FALSE) //get row vales
			{
				$art_codigo = $row[0];
				$art_nombre = $row[1];
				$art_precio_compra = $row[2];
				$art_precio_venta = $row[3];

				$res = true;

				// Valida y formatea Código de Artículo
				$pos = strpos($art_codigo, "/");
				if ($pos === false) {
					$res = false;
				};

				if ($res) {
					$codigo1 = substr($art_codigo, 0, $pos);
					if (is_numeric($codigo1)) {
						$codigo1 = str_pad($codigo1, 2, '0', STR_PAD_LEFT);
					} else {
						$res = false;
					};
				};

				if ($res) {
					$codigo2 = substr($art_codigo, $pos + 1, strlen($art_codigo) - $pos);
					if (is_numeric($codigo2)) {
						$codigo2 = str_pad($codigo2, 4, '0', STR_PAD_LEFT);
					} else {
						$res = false;
					};
				};

				if ($res) {
					$art_codigo = $codigo1 . "/" . $codigo2;
				};

				// Valida Nombre de Artículo
				if ($res) {
					$art_nombre = substr($art_nombre, 0, 50);
				};

				// Valida y formatea Precio de Compra
				if ($res) {
					if (is_numeric($art_precio_compra)) {
						// $art_precio_compra = round($art_precio_compra, 2);
						$art_precio_compra = number_format($art_precio_compra, 2, ".",  ",");
					} else {
						$res = false;
					};
				};

				// Valida y formatea Precio de Venta
				if ($res) {
					if (is_numeric($art_precio_venta)) {
						$art_precio_venta = number_format($art_precio_venta, 2, ".",  ",");
					} else {
						$res = false;
					};
				};

				// Add data
				if ($res) {
					$data[] = array(
						'art_codigo' =>  $art_codigo,
						'art_nombre' =>  $art_nombre,
						'art_precio_compra' =>  $art_precio_compra,
						'art_precio_venta' =>  $art_precio_venta
					);
				}
			} // While

			// fclose($handle);
		} // if (isset($_FILES["file"]["name"]))

		// Return JSON
		echo json_encode($data);
	}

	function updateMasivo()
	{
		// Get current date
		$now = date('Y-m-d H:i:s');

		// Called from AJAX
		$data = json_decode(file_get_contents('php://input'), true);

		$this->db->trans_begin();
		$res = true;

		foreach ($data as $value) {
			$art_codigo = $value['art_codigo'];
			$art_nombre = $value['art_nombre'];
			$art_precio_compra = str_replace(',', '', $value['art_precio_compra']);
			$art_precio_venta = str_replace(',', '', $value['art_precio_venta']);

			// Busca Artículo
			$result = $this->Articulo_model->getPorCodigo($art_codigo);

			if (is_null($result)) {
				// Assign data into array elements
				$data = array(
					'art_codigo' => $art_codigo,
					'art_nombre' => $art_nombre,
					'art_precio_compra' => $art_precio_compra,
					'art_precio_venta' => $art_precio_venta,
					'art_usuario_modificacion' => $this->session->userdata("usu_username"),
					'art_fecha_modificacion' => $now
				);

				// Insert record
				$res =  $this->Articulo_model->insert($data);
			} else {
				$art_id = $result->art_id;

				// Assign data into array elements
				$data = array(
					'art_id' => $art_id,
					'art_codigo' => $art_codigo,
					'art_nombre' => $art_nombre,
					'art_precio_compra' => $art_precio_compra,
					'art_precio_venta' => $art_precio_venta,
					'art_usuario_modificacion' => $this->session->userdata("usu_username"),
					'art_fecha_modificacion' => $now
				);

				// Update record
				$res =  $this->Articulo_model->update($data);
			}
		}

		if ($res) {
			$this->db->trans_commit();
			echo json_encode("La actualización masiva fue realizada exitosamente");
		} else {
			$dbError = $this->db->error();
			$error = $dbError['message'];

			$this->db->trans_rollback();
			echo json_encode("No se pudo guardar la información: " . $error);
		}
	}
}
