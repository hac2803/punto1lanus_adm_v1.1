<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Ventas <small>Editar</small></h1>
  </section>
  <!-- Main content -->
  <section class="content">

    <div class="row">
      <!-- Mensajes de error -->
      <?php if ($this->session->flashdata("error")) : ?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <p><i class="icon fa fa-ban"></i><?= $this->session->flashdata("error"); ?></p>
        </div>
      <?php endif; ?>

      <!-- Mensajes Validación -->
      <?php if (!empty(validation_errors())) { ?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?= validation_errors(); ?>
        </div>
      <?php } ?>
    </div>

    <?php
    $vec_id = $venta_cabecera->vec_id;
    $cli_nombre = $venta_cabecera->cli_nombre;
    $vec_fecha = $venta_cabecera->vec_fecha;
    $vec_importe = $venta_cabecera->vec_importe;
    $vec_valor = $venta_cabecera->vec_valor;
    $vec_saldo = $venta_cabecera->vec_saldo;
    $vec_fecha = date("d/m/Y", strtotime($venta_cabecera->vec_fecha));

    if ($vec_saldo == 0) {
      $disabled = "disabled";
    } else {
      $disabled = "";
    }
    ?>

    <!-- Formulario -->
    <form method="post" id="frmVenta" action="<?php echo base_url() . 'Movimientos/Ventas/edit/' . $vec_id . '/' . $caller; ?>">

      <!-- Hidden Inputs -->
      <input type="hidden" id="vec_id" name="vec_id" value="<?= $vec_id; ?>">
      <table id="tbValores" class="hidden">
        <tbody>
          <!-- Data -->
        </tbody>
      </table>

      <!-- ------------------- -->
      <!-- Cliente / Artículos -->
      <!-- ------------------- -->
      <div class="box box-solid">
        <div class="box-body">

          <div class="row">
            <!-- Cliente -->
            <div class="col-md-4 form-group">
              <label for="">Cliente</label>
              <div class="input-group">
                <input type="text" class="form-control" disabled="disabled" id="cli_nombre" name="cli_nombre" value="<?= $cli_nombre; ?>">
                <span class="input-group-btn">
                  <button disabled="disabled" class="btn btn-primary btn-shadow" id="btn-pasajero" type="button" data-toggle="modal" data-target="#modal-clientes"><span class="fa fa-search"></span></button>
                </span>
              </div>
            </div>

            <!-- Fecha -->
            <div class="form-group col-md-2 pull-right">
              <label for="vec_fecha">Fecha:</label>
              <input type="text" class="form-control" id="vec_fecha" name="vec_fecha" value="<?= $vec_fecha; ?>" readonly>
            </div>
          </div> <!-- /.row -->

        </div> <!-- /.box-body -->
      </div> <!-- /.box-solid -->

      <!-- -------------------- -->
      <!-- Detalle de Artículos -->
      <!-- -------------------- -->
      <div class="box box-solid">
        <div class="box-body">
          <div class="table-responsive">
            <table id="DataTableArticulos" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <!-- <th class='col-md-1 hidden'>val_id</th> -->
                  <th class='col-md-1'>Código Barras</th>
                  <th class='col-md-2'>Artículo</th>
                  <th class='col-md-1'>Color</th>
                  <th class='col-md-1'>Talle</th>
                  <th class='col-md-1'>Precio Venta</th>
                  <th class='col-md-1'>ved_fecha_creacion</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($articulos)) : ?>
                  <?php foreach ($articulos as $row) : ?>
                    <tr>
                      <td><?php echo $row->sto_codigo_barras; ?></td>
                      <td><?php echo $row->art_nombre; ?></td>
                      <td><?php echo $row->col_nombre; ?></td>
                      <td><?php echo $row->sto_talle; ?></td>
                      <td><?php echo $row->ved_precio_venta; ?></td>
                      <td><?php echo $row->ved_fecha_creacion; ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div> <!-- .table-responsive -->
        </div> <!-- /.box-body -->
      </div> <!-- /.box-solid -->

      <!-- ------- -->
      <!-- Valores -->
      <!-- ------- -->
      <div class="box box-solid">
        <div class="box-body">

          <div class="row">

            <!-- Valor -->
            <div class="col-md-2 form-group">
              <label for="">Tipo Valor:</label>
              <select class="form-control" id="tva_id">
                <option value="">Seleccione una opción</option>
                <?php foreach ($tipos_valor as $row) : ?>
                  <option value="<?= $row->tva_id; ?>"><?= $row->tva_nombre ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Importe -->
            <div class="col-md-1 form-group">
              <label for="">Importe:</label>
              <input type="text" class="form-control" id="val_importe">
            </div>

            <!-- Button Agregar -->
            <div class='form-group col-md-9'>
              <br>
              <button type="button" <?= $disabled; ?> name="btnAddValor" id="btnAddValor" class="btn btn-success btn-shadow pull-right"><span class="fa fa-plus"></span> Agregar</button>
            </div>

          </div>
        </div> <!-- /.box-body -->
      </div> <!-- /.box-solid -->

      <!-- -------------------- -->
      <!-- Detalle de Valores -->
      <!-- -------------------- -->
      <div class="box box-solid">
        <div class="box-body">
          <div class="table-responsive">
            <table id="DataTableValores" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th class='col-md-2'>Tipo Valor</th>
                  <th class='col-md-1'>Fecha</th>
                  <th class='col-md-1'>Importe</th>
                  <th class='col-md-2'>Opciones</th>
                  <th class='col-md-1 hidden'>val_fecha_creacion</th>
                  <th class='col-md-1 hidden'>tva_id</th>
                  <th class='col-md-1 hidden'>val_id</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($valores)) : ?>
                  <?php foreach ($valores as $row) : ?>
                    <tr>
                      <td><?php echo $row->tva_nombre; ?></td>
                      <td><?php echo $row->val_fecha; ?></td>
                      <td><?php echo $row->val_importe; ?></td>
                      <td></td>
                      <td><?php echo $row->val_fecha_creacion; ?></td>
                      <td><?php echo $row->tva_id; ?></td>
                      <td><?php echo $row->val_id; ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>

          </div> <!-- .table-responsive -->
        </div> <!-- /.box-body -->
      </div> <!-- /.box-solid -->

      <!-- Footer -->
      <div class="box box-solid">
        <div class="box-body">

          <!-- Button Guardar -->
          <div class="row">
            <div class='form-group col-md-3'>
              <button type="button" <?= $disabled; ?> name="btnSave" id="btnSave" class="btn btn-primary btn-shadow"><span class="fa fa-save"></span> Guardar</button>
            </div>

            <div class="form-group col-md-3">
              <div class="input-group">
                <span class="input-group-addon"><strong>Total Venta:</strong></span>
                <input type="text" class="form-control text-right" id="vec_importe" name="vec_importe" value="<?= $vec_importe; ?>" readonly="readonly">
              </div>
            </div>


            <div class="form-group col-md-3">
              <div class="input-group">
                <span class="input-group-addon"><strong>Valores:</strong></span>
                <input type="text" class="form-control text-right" id="vec_valor" name="vec_valor" value="<?= $vec_valor; ?>" readonly="readonly">
              </div>
            </div>

            <div class="form-group col-md-3">
              <div class="input-group">
                <span class="input-group-addon"><strong>Saldo:</strong></span>
                <input type="text" class="form-control text-right" id="vec_saldo" name="vec_saldo" value="<?= $vec_saldo; ?>" readonly="readonly">
              </div>
            </div>

          </div> <!-- /.row -->
        </div> <!-- /.box-body -->
      </div> <!-- /.box-solid -->

    </form>

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
    // Máscaras
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#val_importe').mask('99999999999999999.00');

    //////////////////////////////////////////////////////////////////////////////////////////
    // Formato
    //////////////////////////////////////////////////////////////////////////////////////////
    $(document).on("focusout", "input[id=val_importe]", function() {
      precio = Number($('#val_importe').val()).toFixed(2);
      $('#val_importe').val(precio);
    })

    //////////////////////////////////////////////////////////////////////////////////////////
    // Inicializa DataTables
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#DataTableArticulos').DataTable({
      "language": {
        "lengthMenu": "Mostrar _MENU_ registros por página",
        "zeroRecords": "No se encontraron resultados en su búsqueda",
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
      "searching": false,
      "paging": false,
      "info": false,
      "order": [
        [5, "desc"]
      ],
      "columnDefs": [{
          "targets": [2, 3],
          "className": "text-center"
        },
        {
          "targets": [4],
          "className": "text-right"
        },
        {
          "targets": [5],
          "visible": false,
          "searchable": false
        }
      ]
    });
    $('.sidebar-menu').tree();
    var DataTableArticulos = $('#DataTableArticulos').DataTable();

    $('#DataTableValores').DataTable({
      "language": {
        "lengthMenu": "Mostrar _MENU_ registros por página",
        "zeroRecords": "No se encontraron resultados en su búsqueda",
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
      "searching": false,
      "paging": false,
      "info": false,
      "columns": [{
          data: "tva_nombre"
        },
        {
          data: "val_fecha"
        },
        {
          data: "val_importe"
        },
        {
          defaultContent: '<a href="#" rel="tooltip" title="Eliminar" class="btn btn-danger btn-xs btn-remove btn-shadow"><span class="fa fa-trash"></span></a>'
        },
        {
          data: "val_fecha_creacion"
        },
        {
          data: "tva_id"
        },
        {
          data: "val_id"
        }
      ],
      "order": [
        [4, "desc"]
      ],
      "columnDefs": [{
          "targets": [1, 3],
          "className": "text-center"
        },
        {
          "targets": [2],
          "className": "text-right"
        },
        {
          "targets": [3],
          "orderable": false
        },
        {
          "targets": [4, 5, 6],
          "visible": false,
          "searchable": false
        },
        {
          "targets": [1],
          "render": $.fn.dataTable.render.moment('YYYY-MM-DD', 'DD/MM/YYYY')
        }
      ]
    });
    $('.sidebar-menu').tree();
    var DataTableValores = $('#DataTableValores').DataTable();

    //////////////////////////////////////////////////////////////////////////////////////////
    // Calcular Total Valores
    //////////////////////////////////////////////////////////////////////////////////////////
    function calcularTotalValores() {
      // Get data from datatable
      var data = DataTableValores.rows().data();

      total = 0;

      for (var i = 0; i < data.length; i += 1) {
        total += Number(data[i].val_importe);
      }

      $("#vec_valor").val(total.toFixed(2));
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    // Calcular Saldo
    //////////////////////////////////////////////////////////////////////////////////////////
    function calcularSaldo() {
      saldo = Number($("#vec_importe").val() - $("#vec_valor").val()).toFixed(2);
      $("#vec_saldo").val(saldo);
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    // Guarda la Venta
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#btnSave').click(function() {

      if (validarVenta()) {

        // Add Valores to hidden table
        var data = DataTableValores.rows().data();
        for (var i = 0; i < data.length; i += 1) {
          html = "<tr>"
          html += "<td><input type='text' name='array_tva_id[]' value='" + data[i].tva_id + "'></td>"
          html += "<td><input type='text' name='array_val_importe[]' value='" + data[i].val_importe + "'></td>"
          html += "<td><input type='text' name='array_val_id[]' value='" + data[i].val_id + "'></td>"
          html += "</tr>"
          $("#tbValores tbody").append(html);
        }

        $('#frmVenta').submit();
      }
    });

    //////////////////////////////////////////////////////////////////////////////////////////
    // Elimina Valor
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#DataTableValores').on('click', 'tbody .btn-remove', function() {
      DataTableValores.row($(this).parents('tr')).remove().draw();
      calcularTotalValores();
      calcularSaldo();
    })

    //////////////////////////////////////////////////////////////////////////////////////////
    // Agrega Valor
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#btnAddValor').click(function() {
      if (validarValor()) {
        var val_fecha_creacion = moment();
        var val_fecha = moment().format("YYYY-MM-DD")

        tva_id = $("#tva_id").val();
        tva_nombre = $("#tva_id option:selected").text();
        val_importe = $("#val_importe").val();

        // Add row to datatable
        DataTableValores.row.add({
          "tva_nombre": tva_nombre,
          "val_fecha": val_fecha,
          "val_importe": val_importe,
          "val_fecha_creacion": val_fecha_creacion,
          "tva_id": tva_id,
          "val_id": 0
        }).draw();

        // Necesario para que funcione el Tooltip del botón
        $(function() {
          $("[rel='tooltip']").tooltip();
        });

        calcularTotalValores();
        calcularSaldo();

        // Limpiar controles
        $("#tva_id").val("");
        $("#tva_nombre").val("");
        $("#val_importe").val("");
        $("#tva_nombre").focus();
      }
    });

    //////////////////////////////////////////////////////////////////////////////////////////
    // Validar Valor
    //////////////////////////////////////////////////////////////////////////////////////////
    function validarValor() {
      tva_id = $("#tva_id").val();
      val_importe = Number($("#val_importe").val()).toFixed(2);

      // Tipo Valor
      if (tva_id == '') {
        alert2('Debe ingresar un Tipo de Valor')
        return false;
      };

      // Importe
      if (val_importe == 0 || isNaN(val_importe)) {
        alert2('Debe ingresar un Importe')
        return false;
      };

      return true;
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    // Validar Venta
    //////////////////////////////////////////////////////////////////////////////////////////
    function validarVenta() {
      cli_id = $("#cli_id").val();
      vec_saldo = Number($("#vec_saldo").val()).toFixed(2);

      // Ventas con Saldo es válida sólo si se informa Cliente
      if (vec_saldo < 0) {
        alert2('Los Valores no pueden ser mayores al Total de la Venta')
        return false;
      };

      // Ventas con Saldo es válida sólo si se informa Cliente
      if ((cli_id == '' || cli_id == 1) && (vec_saldo != 0.00)) {
        alert2('Sólo pueden ingresarse Ventas con Saldo cuando se informa Cliente')
        return false;
      };

      return true;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////
  }) // $(document).ready(function () {
  ////////////////////////////////////////////////////////////////////////////////////////////
</script>