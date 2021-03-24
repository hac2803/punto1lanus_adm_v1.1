<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Ventas <small>Agregar</small></h1>
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
    $vec_fecha = date("d/m/Y", strtotime("now"));
    ?>

    <!-- Formulario -->
    <form method="post" id="frmVenta" action="<?php echo base_url() ?>Movimientos/Ventas/add">

      <!-- Hidden Inputs -->
      <input type="hidden" id="cli_id" name="cli_id" value="1">
      <table id="tbArticulos" class="hidden">
        <tbody>
          <!-- Data -->
        </tbody>
      </table>
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
                <input type="text" class="form-control" disabled="disabled" id="cli_nombre" name="cli_nombre" value="">
                <span class="input-group-btn">
                  <button class="btn btn-primary btn-shadow" id="btn-pasajero" type="button" data-toggle="modal" data-target="#modal-clientes"><span class="fa fa-search"></span></button>
                </span>
              </div>
            </div>

            <!-- Fecha -->
            <div class="form-group col-md-2 pull-right">
              <label for="vec_fecha">Fecha:</label>
              <input type="text" class="form-control" id="vec_fecha" name="vec_fecha" value="<?= $vec_fecha; ?>" readonly>
            </div>
          </div> <!-- /.row -->

          <div class="row">
            <!-- Código Stock -->
            <div class="form-group col-md-2">
              <label for="sto_codigo_barras">Código Barras</label>
              <input type="text" class="form-control" id="sto_codigo_barras" name="sto_codigo_barras" autofocus>
            </div>

            <!-- Artículo -->
            <div class="form-group col-md-3">
              <label for="art_nombre">Artículo</label>
              <input type="text" class="form-control" id="art_nombre" name="art_nombre" readonly>
            </div>

            <!-- Color -->
            <div class="form-group col-md-2">
              <label for="col_nombre">Color</label>
              <input type="text" class="form-control" id="col_nombre" name="col_nombre" readonly>
            </div>

            <!-- Talle -->
            <div class="form-group col-md-1">
              <label for="sto_talle">Talle</label>
              <input type="text" class="form-control" id="sto_talle" name="sto_talle" readonly>
            </div>

            <!-- Precio Venta -->
            <div class="form-group col-md-2">
              <label for="ved_precio_venta">Precio Venta</label>
              <input type="text" class="form-control" id="ved_precio_venta" name="ved_precio_venta">
            </div>

            <!-- Button Agregar -->
            <div class='form-group col-md-2'>
              <br>
              <button type="button" name="btnAddArticulo" id="btnAddArticulo" class="btn btn-success btn-shadow pull-right"><span class="fa fa-plus"></span> Agregar</button>
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
                  <th class='col-md-1'>Código Barras</th>
                  <th class='col-md-2'>Artículo</th>
                  <th class='col-md-1'>Color</th>
                  <th class='col-md-1'>Talle</th>
                  <th class='col-md-1'>Precio Venta</th>
                  <th class='col-md-1'>Opciones</th>
                  <th class='col-md-1'>ved_fecha_creacion</th>
                </tr>
              </thead>
              <tbody>
                <!-- Data -->
                <!-- Data -->
                <!-- Data -->
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
              <button type="button" name="btnAddValor" id="btnAddValor" class="btn btn-success btn-shadow pull-right"><span class="fa fa-plus"></span> Agregar</button>
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
                  <th class='col-md-1'>val_fecha_creacion</th>
                  <th class='col-md-1'>val_id</th>
                </tr>
              </thead>
              <tbody>
                <!-- Data -->
                <!-- Data -->
                <!-- Data -->
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
              <button type="button" name="btnSave" id="btnSave" class="btn btn-primary btn-shadow"><span class="fa fa-save"></span> Guardar</button>
            </div>

            <div class="form-group col-md-3">
              <div class="input-group">
                <span class="input-group-addon"><strong>Total Venta:</strong></span>
                <input type="text" class="form-control text-right" id="vec_importe" name="vec_importe" value="0.00" readonly="readonly">
              </div>
            </div>

            <div class="form-group col-md-3">
              <div class="input-group">
                <span class="input-group-addon"><strong>Valores:</strong></span>
                <input type="text" class="form-control text-right" id="vec_valor" name="vec_valor" value="0.00" readonly="readonly">
              </div>
            </div>

            <div class="form-group col-md-3">
              <div class="input-group">
                <span class="input-group-addon"><strong>Saldo:</strong></span>
                <input type="text" class="form-control text-right" id="vec_saldo" name="vec_saldo" value="0.00" readonly="readonly">
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

<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- Modal Clientes -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="modal-clientes">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Clientes</h4>
      </div>
      <div class="modal-body">
        <table id="tbClientes" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Teléfono</th>
              <th>Seleccionar</th>
            </tr>
          </thead>

          <tbody>
            <?php if (!empty($clientes)) : ?>
              <?php foreach ($clientes as $row) : ?>
                <tr>
                  <td><?php echo $row->cli_nombre; ?></td>
                  <td><?php echo $row->cli_telefono; ?></td>
                  <?php $dataCliente = $row->cli_id . "*" . $row->cli_nombre . "*" . $row->cli_telefono; ?>
                  <td>
                    <button type="button" class="btn btn-success btn-xs btn-check-cliente" value="<?php echo $dataCliente; ?>"><span class="fa fa-check"></span></button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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
    $('#sto_codigo_barras').mask('000000000000');
    $('#ved_precio_venta').mask('99999999999999999.00');
    $('#val_importe').mask('99999999999999999.00');

    //////////////////////////////////////////////////////////////////////////////////////////
    // Formato
    //////////////////////////////////////////////////////////////////////////////////////////
    $(document).on("focusout", "input[id=ved_precio_venta]", function() {
      precio = Number($('#ved_precio_venta').val()).toFixed(2);
      $('#ved_precio_venta').val(precio);
    })

    $(document).on("focusout", "input[id=val_importe]", function() {
      precio = Number($('#val_importe').val()).toFixed(2);
      $('#val_importe').val(precio);
    })

    //////////////////////////////////////////////////////////////////////////////////////////
    // Inicializa DataTables
    //////////////////////////////////////////////////////////////////////////////////////////
    buttons = '<div class="btn-group">';
    buttons += '<a href="#" rel="tooltip" title="Eliminar" class="btn btn-danger btn-xs btn-remove btn-shadow"><span class="fa fa-trash"></span></a>';
    buttons += '<a href="#" rel="tooltip" title="Cambio" class="btn btn-primary btn-xs btn-change btn-shadow"><span class="fa fa-refresh"></span></a>';
    buttons += '</div>';

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
      "columns": [{
          data: "sto_codigo_barras"
        },
        {
          data: "art_nombre"
        },
        {
          data: "col_nombre"
        },
        {
          data: "sto_talle"
        },
        {
          data: "ved_precio_venta"
        },
        {
          defaultContent: buttons
        },
        {
          data: "ved_fecha_creacion"
        }
      ],
      "order": [
        [6, "desc"]
      ],
      "columnDefs": [{
          "targets": [2, 3, 5],
          "className": "text-center"
        },
        {
          "targets": [4],
          "className": "text-right"
        },
        {
          "targets": [5],
          "orderable": false
        },
        {
          "targets": [6],
          "visible": false,
          "searchable": false
        }
      ]
    });
    $('.sidebar-menu').tree();
    var DataTableArticulos = $('#DataTableArticulos').DataTable();

    $('#tbClientes').DataTable({
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
      "columnDefs": [{
        "targets": [2],
        "className": "text-center",
        "orderable": false
      }]
    });
    $('.sidebar-menu').tree();

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
          "targets": [4, 5],
          "visible": false,
          "searchable": false
        }
      ]
    });
    $('.sidebar-menu').tree();
    var DataTableValores = $('#DataTableValores').DataTable();

    //////////////////////////////////////////////////////////////////////////////////////////
    // Obtiene datos del Artículo
    //////////////////////////////////////////////////////////////////////////////////////////
    $("#sto_codigo_barras").on("input", function() {
      var value = $(this).val();

      if (value.length == 12) {
        var param = {};
        param.codigo_barras = value;

        $.ajax({
          url: base_url_js + 'Movimientos/Stock/getPorCodigoBarrasAjax/',
          type: 'POST',
          data: JSON.stringify(param),
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          success: function(resp) {
            sto_codigo_barras = resp.sto_codigo_barras;
            art_nombre = resp.art_nombre;
            col_nombre = resp.col_nombre;
            sto_talle = resp.sto_talle;
            ved_precio_venta = Number(resp.art_precio_venta).toFixed(2);

            $("#art_nombre").val(art_nombre);
            $("#col_nombre").val(col_nombre);
            $("#sto_talle").val(sto_talle);
            $("#ved_precio_venta").val(ved_precio_venta);
            $("#ved_precio_venta").focus();

          },
          error: function(xhr, status, error) {
            console.log(error);
          }
        }); // $.ajax
      } else {
        // Limpiar controles
        $("#art_nombre").val("");
        $("#col_nombre").val("");
        $("#sto_talle").val("");
        $("#ved_precio_venta").val("");
      }
    })

    //////////////////////////////////////////////////////////////////////////////////////////
    // Elimina Artículo
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#DataTableArticulos').on('click', 'tbody .btn-remove', function() {
      DataTableArticulos.row($(this).parents('tr')).remove().draw();
      calcularTotalArticulos();
      calcularSaldo();
    })

    //////////////////////////////////////////////////////////////////////////////////////////
    // Cambio Artículo
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#DataTableArticulos').on('click', 'tbody .btn-change', function() {
      ved_precio_venta = DataTableArticulos.row($(this).parents('tr')).data().ved_precio_venta;
      ved_precio_venta = Number(ved_precio_venta * -1).toFixed(2);
      DataTableArticulos.row($(this).parents('tr')).data().ved_precio_venta = ved_precio_venta;
      DataTableArticulos.row($(this).parents('tr')).invalidate().draw();

      // Necesario para que funcione el Tooltip del botón
      $(function() {
        $("[rel='tooltip']").tooltip();
      });

      calcularTotalArticulos();
      calcularSaldo();
    })

    //////////////////////////////////////////////////////////////////////////////////////////
    // Agrega Artículo
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#btnAddArticulo').click(function() {
      if (validarArticulo()) {
        var ved_fecha_creacion = moment();

        sto_codigo_barras = $("#sto_codigo_barras").val();
        art_nombre = $("#art_nombre").val();
        col_nombre = $("#col_nombre").val();
        sto_talle = $("#sto_talle").val();
        ved_precio_venta = $("#ved_precio_venta").val();

        // Add row to datatable
        DataTableArticulos.row.add({
          "sto_codigo_barras": sto_codigo_barras,
          "art_nombre": art_nombre,
          "col_nombre": col_nombre,
          "sto_talle": sto_talle,
          "ved_precio_venta": ved_precio_venta,
          "ved_fecha_creacion": ved_fecha_creacion
        }).draw();

        // Necesario para que funcione el Tooltip del botón
        $(function() {
          $("[rel='tooltip']").tooltip();
        });

        calcularTotalArticulos();
        calcularSaldo();

        // Limpiar controles
        $("#sto_codigo_barras").val("");
        $("#art_nombre").val("");
        $("#col_nombre").val("");
        $("#sto_talle").val("");
        $("#ved_precio_venta").val("");
        $("#sto_codigo_barras").focus();
      }
    });

    //////////////////////////////////////////////////////////////////////////////////////////
    // Validar Artículo
    //////////////////////////////////////////////////////////////////////////////////////////
    function validarArticulo() {
      sto_codigo_barras = $("#sto_codigo_barras").val();
      art_nombre = $("#art_nombre").val();
      col_nombre = $("#col_nombre").val();
      sto_talle = $("#sto_talle").val();
      ved_precio_venta = Number($("#ved_precio_venta").val()).toFixed(2);

      // Código Barras
      if (sto_codigo_barras.length != 12) {
        alert2('Código de Barras inválido');
        return false;
      };

      // Artículo
      if (art_nombre == '') {
        alert2('Artículo inválido');
        return false;
      };

      // Color
      if (col_nombre == '') {
        alert2('Color inválido');
        return false;
      };

      // Talle
      if (sto_talle < 1 || sto_talle > 5) {
        alert2('Talle inválido');
        return false;
      };

      // Precio Venta
      if (ved_precio_venta == 0 || isNaN(ved_precio_venta)) {
        alert2('Debe ingresar un Precio Venta');
        return false;
      };

      return true;
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    // Calcular Total Articulos
    //////////////////////////////////////////////////////////////////////////////////////////
    function calcularTotalArticulos() {
      // Get data from datatable
      var data = DataTableArticulos.rows().data();

      total = 0;

      for (var i = 0; i < data.length; i += 1) {
        total += Number(data[i].ved_precio_venta);
      }

      $("#vec_importe").val(total.toFixed(2));
    }

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
        // Add Artículos to hidden table
        var data = DataTableArticulos.rows().data();
        for (var i = 0; i < data.length; i += 1) {
          html = "<tr>"
          html += "<td><input type='text' name='array_sto_codigo_barras[]' value='" + data[i].sto_codigo_barras + "'></td>"
          html += "<td><input type='text' name='array_ved_precio_venta[]' value='" + data[i].ved_precio_venta + "'></td>"
          html += "</tr>"
          $("#tbArticulos tbody").append(html);
        }

        // Add Valores to hidden table
        var data = DataTableValores.rows().data();
        for (var i = 0; i < data.length; i += 1) {
          html = "<tr>"
          html += "<td><input type='text' name='array_tva_id[]' value='" + data[i].tva_id + "'></td>"
          html += "<td><input type='text' name='array_val_importe[]' value='" + data[i].val_importe + "'></td>"
          html += "</tr>"
          $("#tbValores tbody").append(html);
        }

        $('#frmVenta').submit();
      }
    });

    //////////////////////////////////////////////////////////////////////////////////////////
    // Selección de Cliente
    //////////////////////////////////////////////////////////////////////////////////////////
    $(document).on("click", ".btn-check-cliente", function() {
      data = $(this).val()
      info = data.split("*")
      $("#cli_id").val(info[0])
      $("#cli_nombre").val(info[1])

      $("#modal-clientes").modal("hide");
    })

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
        var val_fecha = moment().format("DD/MM/YYYY")

        tva_id = $("#tva_id").val();
        tva_nombre = $("#tva_id option:selected").text();
        val_importe = $("#val_importe").val();

        // Add row to datatable
        DataTableValores.row.add({
          "tva_nombre": tva_nombre,
          "val_fecha": val_fecha,
          "val_importe": val_importe,
          "val_fecha_creacion": val_fecha_creacion,
          "tva_id": tva_id
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

      // Se agregaron Artículos
      if (!DataTableArticulos.data().count()) {
        alert2('Debe ingresar al menos un Artículo')
        return false;
      }

      // Saldo
      if (vec_saldo < 0) {
        alert2('El Saldo no puede ser menor a cero')
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