<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Artículos <small>Actualización Masiva</small></h1>
	</section>
	<!-- Main content -->
	<section class="content">

		<!-- Mensajes -->
		<div class="messages" style="display:none"></div>

		<!-- Formulario Import -->
		<form method="post" id="frmImportar" enctype="multipart/form-data">
			<div class="box box-solid">
				<div class="box-body">
					<div class="row">
						<div class="col-md-2">
							<label class="btn btn-primary btn-shadow" for="inpFile">
								<input type="file" name="file" id="inpFile" required accept=".xls, .xlsx" style="display:none">
								Seleccionar archivo
							</label>
						</div>

						<div class="col-md-4">
							<input type="text" class="form-control" disabled="disabled" id="filename" name="filename" value="">
						</div>

						<div class="col-md-6">
							<button type="submit" disabled="disabled" id="btnImportar" class="btn btn-info btn-shadow pull-right"><span class="fa fa-exchange"></span> Importar</button>
						</div>
					</div>
				</div>
			</div>
		</form>

		<!-- Detail -->
		<div class="box box-solid">
			<div class="box-body">
				<div class="table-responsive">
					<table id="DataTableArticulos" class="table table-bordered table-striped table-hover table-sm">
						<thead>
							<tr>
								<th>Código</th>
								<th>Nombre</th>
								<th>Precio Compra</th>
								<th>Precio Venta</th>
							</tr>
						</thead>
						<tbody>
							<!-- Data -->
							<!-- Data -->
							<!-- Data -->
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!-- Footer -->
		<div class="box box-solid">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<button type="button" id="btnGuardar" class="btn btn-primary btn-shadow" onclick="this.blur();"><span class="fa fa-save"></span> Guardar</button>
						<a href="<?php echo base_url(); ?>assets/resources/articulos.xlsx" class="btn btn-warning btn-shadow pull-right" onclick="this.blur();"><span class="fa fa-download"></span> Descargar Excel</a>
					</div>
				</div>
			</div>
		</div>

	</section> <!-- /.content -->
</div> <!-- /.content-wrapper -->


<!-- Ajax Loader -->
<div id='ajax_loader' style="display:none"></div>

<script>
	////////////////////////////////////////////////////////////////////////////////////////////
	$(document).ready(function() {
		////////////////////////////////////////////////////////////////////////////////////////////

		//////////////////////////////////////////////////////////////////////////////////////////
		// Tooltip
		//////////////////////////////////////////////////////////////////////////////////////////
		$(function() {
			$("[rel='tooltip']").tooltip();
		});

		//////////////////////////////////////////////////////////////////////////////////////////
		// Inicializa DataTables
		//////////////////////////////////////////////////////////////////////////////////////////
		$('#DataTableArticulos').DataTable({
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por página",
				"zeroRecords": "No se importaron registros",
				"searchPlaceholder": "Buscar registros",
				"info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
				"infoEmpty": "No existen registros",
				"infoFiltered": "(filtrado de un total de _MAX_ registros)",
				"search": "Buscar:",
				"paginate": {
					"first": "Primero",
					"last": "Último",
					"next": "Siguiente",
					"previous": "Anterior"
				},
			},
			"columns": [{
					data: "art_codigo"
				},
				{
					data: "art_nombre"
				},
				{
					data: "art_precio_compra"
				},
				{
					data: "art_precio_venta"
				}
			],
			"columnDefs": [{
				"targets": [2, 3],
				"className": "text-right"
			}]

		});
		$('.sidebar-menu').tree();
		var DataTableArticulos = $('#DataTableArticulos').DataTable();

		//////////////////////////////////////////////////////////////////////////////////////////
		// Selección de archivo Excel
		//////////////////////////////////////////////////////////////////////////////////////////
		$("#inpFile").change(function() {
			if (this.files.length > 0) {
				$('#filename').val(this.files[0].name);
				$("#btnImportar").prop("disabled", false);
			}
		});

		//////////////////////////////////////////////////////////////////////////////////////////
		// Importar
		//////////////////////////////////////////////////////////////////////////////////////////
		$("#frmImportar").submit(function() {
			event.preventDefault();

			$.ajax({
				url: "<?php echo base_url(); ?>Mantenimiento/Articulo/import",
				method: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				success: function(data) {

					$.each(JSON.parse(data), function(key, value) {
						art_codigo = value.art_codigo;
						art_nombre = value.art_nombre;
						art_precio_compra = value.art_precio_compra;
						art_precio_venta = value.art_precio_venta;

						// Add row to datatable
						DataTableArticulos.row.add({
							"art_codigo": art_codigo,
							"art_nombre": art_nombre,
							"art_precio_compra": art_precio_compra,
							"art_precio_venta": art_precio_venta
						}).draw();
					})
				}
			})

		});

		//////////////////////////////////////////////////////////////////////////////////////////
		// Guardar
		//////////////////////////////////////////////////////////////////////////////////////////
		$("#btnGuardar").click(function() {

			if (validarData()) {
				var data = DataTableArticulos.rows().data().toArray();

				$.ajax({
					url: "<?php echo base_url(); ?>Mantenimiento/Articulo/updateMasivo",
					type: "POST",
					data: JSON.stringify(data),
					contentType: "application/json; charset=utf-8",
					dataType: "json",
					success: function(resp) {
						var html = '<div class="alert alert-success alert-dismissible">';
						html += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
						html += '<p><i class="icon fa fa-thumbs-up"></i>' + resp + '</p></div>';
						$(".messages").prepend(html);
						$('.messages').css("display", "block");
					},
					error: function(xhr, status, error) {
						var html = '<div class="alert alert-danger alert-dismissible">';
						html += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
						html += '<p><i class="icon fa fa-thumbs-down"></i>' + error + '</p></div>';
						$(".messages").prepend(html);
						$('.messages').css("display", "block");
					}
				})
			}

		});

		//////////////////////////////////////////////////////////////////////////////////////////
		// Validar que existan registros
		//////////////////////////////////////////////////////////////////////////////////////////
		function validarData() {

			// Se agregaron Artículos
			if (!DataTableArticulos.data().count()) {
				alert2('Antes de Guardar, debe seleccionar e importar un archivo')
				return false;
			}

			return true;
		}

		////////////////////////////////////////////////////////////////////////////////////////////
	}) // $(document).ready(function () {
	////////////////////////////////////////////////////////////////////////////////////////////
</script>