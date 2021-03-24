<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Stock <small>Ajustes</small></h1>
  </section>
  <!-- Main content -->
  <section class="content">

    <!-- Header -->
    <div class="box box-solid">
      <div class="box-body">

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

        <!-- Formulario -->
        <form id="frmHeader">

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

            <!-- Cantidad -->
            <div class="form-group col-md-1">
              <label for="sto_cantidad">Cantidad</label>
              <input type="text" class="form-control" id="sto_cantidad" name="sto_cantidad" readonly>
            </div>

            <!-- Cantidad Real -->
            <div class="form-group col-md-1">
              <label for="sto_cantidad_real">Cant. Real</label>
              <input type="text" class="form-control" id="sto_cantidad_real" name="sto_cantidad_real">
            </div>

            <!-- Button Agregar -->
            <div class='form-group col-md-2'>
              <br>
              <button type="button" name="btnAdd" id="btnAdd" class="btn btn-success btn-shadow pull-right"><span class="fa fa-plus"></span> Agregar</button>
            </div>
          </div> <!-- /.row -->

          <!-- Button Guardar -->
          <!-- <div class="row">
            <div class='form-group col-md-12'>
              <button type="button" name="btnSave" id="btnSave" class="btn btn-primary btn-shadow"><span class="fa fa-save"></span> Guardar</button>
            </div>
          </div> /.row -->

        </form>

      </div> <!-- /.box-body -->
    </div> <!-- /.box -->


    <!-- Detail -->
    <div class="box box-solid">
      <div class="box-body">
        <div class="table-responsive">
          <table id="DataTableAjustes" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <!-- <th class='col-md-1 hidden'>val_id</th> -->
                <th class='col-md-1'>Código Barras</th>
                <th class='col-md-2'>Artículo</th>
                <th class='col-md-1'>Color</th>
                <th class='col-md-1'>Talle</th>
                <th class='col-md-1'>Cantidad</th>
                <th class='col-md-1'>Cantidad Real</th>
                <th class='col-md-2'>Opciones</th>
                <th class='col-md-1 hidden'>Fecha Creación</th>
              </tr>
            </thead>
            <tbody>
              <!-- Data -->
              <!-- Data -->
              <!-- Data -->
            </tbody>
          </table>
        </div> <!-- .table-responsive -->
      </div>
    </div>


    <!-- Footer -->
    <div class="box box-solid">
      <div class="box-body">

        <!-- Formulario -->
        <form role="form" method="post" id="frmFooter" action="<?php echo base_url() ?>Movimientos/Stock/ajuste">

          <!-- Hidden Inputs -->
          <div class="form-group">
            <input type="hidden" class="form-control" id="" name="" value="" />
          </div>

          <!-- Hidden table with Datatable Data -->
          <div class="form-group">
            <table id="tbData" class="hidden">
              <tbody>
                <!-- Data -->
              </tbody>
            </table>
          </div>

          <!-- Button Guardar -->
          <div class="row">
            <div class='form-group col-md-10'>
              <button type="button" name="btnSave" id="btnSave" class="btn btn-primary btn-shadow"><span class="fa fa-save"></span> Guardar</button>
            </div>

            <!-- <div class="form-group col-md-2">
              <div class="input-group">
                <span class="input-group-addon"><strong>Total:</strong></span>
                <input type="text" class="form-control text-right" id="vec_importe" name="vec_importe" value="0.00" readonly="readonly">
              </div>
            </div> -->
          </div> <!-- /.row -->

        </form>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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
    $('#sto_codigo_barras').mask('000000000000');
    $('#sto_cantidad_real').mask('99999999999999999');

    //////////////////////////////////////////////////////////////////////////////////////////
    // Inicializa DataTable
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#DataTableAjustes').DataTable({
      //estableciendo lenguaje en español para las tablas
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

      "columns": [{
          data: "codigo_barras"
        },
        {
          data: "articulo"
        },
        {
          data: "color"
        },
        {
          data: "talle"
        },
        {
          data: "cantidad"
        },
        {
          data: "cantidad_real"
        },
        {
          defaultContent: '<a href="#" rel="tooltip" title="Eliminar" class="btn btn-danger btn-xs btn-remove btn-shadow"><span class="fa fa-trash"></span></a>'
        },
        {
          data: "fecha_creacion"
        }
      ],
      "order": [
        [7, "desc"]
      ],
      "columnDefs": [{
          "targets": [2, 3, 6],
          "className": "text-center"
        },
        {
          "targets": [4, 5],
          "className": "text-right"
        },
        {
          "targets": [7],
          "visible": false,
          "searchable": false
        }
      ]
    });
    $('.sidebar-menu').tree();
    var DataTable = $('#DataTableAjustes').DataTable();

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
            sto_cantidad = resp.sto_cantidad;

            $("#art_nombre").val(art_nombre);
            $("#col_nombre").val(col_nombre);
            $("#sto_talle").val(sto_talle);
            $("#sto_cantidad").val(sto_cantidad);
            $("#sto_cantidad_real").focus();

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
        $("#sto_cantidad").val("");
        $("#sto_cantidad_real").val("");
      }
    })

    //////////////////////////////////////////////////////////////////////////////////////////
    // Elimina Artículo
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#DataTableAjustes').on('click', 'tbody .btn-remove', function() {
      DataTable.row($(this).parents('tr')).remove().draw();
    })

    //////////////////////////////////////////////////////////////////////////////////////////
    // Agrega Artículo
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#btnAdd').click(function() {
      if (validarItem()) {
        var fecha_creacion = moment();

        sto_codigo_barras = $("#sto_codigo_barras").val();
        art_nombre = $("#art_nombre").val();
        col_nombre = $("#col_nombre").val();
        sto_talle = $("#sto_talle").val();
        sto_cantidad = $("#sto_cantidad").val();
        sto_cantidad_real = $("#sto_cantidad_real").val();

        // Add row to datatable
        DataTable.row.add({
          "codigo_barras": sto_codigo_barras,
          "articulo": art_nombre,
          "color": col_nombre,
          "talle": sto_talle,
          "cantidad": sto_cantidad,
          "cantidad_real": sto_cantidad_real,
          "fecha_creacion": fecha_creacion
        }).draw();

        // Necesario para que funcione el Tooltip del botón
        $(function() {
          $("[rel='tooltip']").tooltip();
        });

        // Limpiar controles
        $("#sto_codigo_barras").val("");
        $("#art_nombre").val("");
        $("#col_nombre").val("");
        $("#sto_talle").val("");
        $("#sto_cantidad").val("");
        $("#sto_cantidad_real").val("");
        $("#sto_codigo_barras").focus();
      }
    });

    //////////////////////////////////////////////////////////////////////////////////////////
    // Validar Item
    //////////////////////////////////////////////////////////////////////////////////////////
    function validarItem() {
      sto_codigo_barras = $("#sto_codigo_barras").val();
      art_nombre = $("#art_nombre").val();
      col_nombre = $("#col_nombre").val();
      sto_talle = $("#sto_talle").val();
      sto_cantidad_real = $("#sto_cantidad_real").val();

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

      // Cantidad Real
      if (sto_cantidad_real == "" || isNaN(sto_cantidad_real)) {
        alert2('Debe ingresar una Cantidad Real');
        return false;
      };

      return true;
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    // Guarda el Ajuste
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#btnSave').click(function() {
      // Get data from datatable
      var data = DataTable.rows().data();

      // Add rows to hidden table
      for (var i = 0; i < data.length; i += 1) {
        html = "<tr>"
        html += "<td><input type='text' name='array_sto_codigo_barras[]' value='" + data[i].codigo_barras + "'></td>"
        html += "<td><input type='text' name='array_sto_cantidad[]' value='" + data[i].cantidad_real + "'></td>"
        html += "</tr>"
        $("#tbData tbody").append(html);
      }

      $('#frmFooter').submit();
    });

    ////////////////////////////////////////////////////////////////////////////////////////////
  }) // $(document).ready(function () {
  ////////////////////////////////////////////////////////////////////////////////////////////
</script>