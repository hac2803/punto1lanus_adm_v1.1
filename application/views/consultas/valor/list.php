<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Valores <small>Consulta</small></h1>
  </section>
  <!-- Main content -->
  <section class="content">

    <!-- Header -->
    <div class="box box-solid">
      <div class="box-body">

        <!-- Mensajes de error -->
        <?php if ($this->session->flashdata("error")) : ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
          </div>
        <?php endif; ?>

        <!-- Formulario Fecha -->
        <form method="get" id="frmFecha" action="<?php echo base_url() ?>Consultas/Valor/">
          <!-- Fecha -->
          <div class="row">
            <!-- Código Stock -->
            <div class="form-group col-md-2">
              <label for="val_fecha">Fecha</label>
              <div class='input-group date' id='datetimepicker1'>
                <input type='text' class="form-control" id="val_fecha" name="val_fecha" placeholder="dd/mm/aaaa" value="<?= $val_fecha; ?>" autofocus />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>
        </form>

      </div> <!-- /.box-body -->
    </div> <!-- /.box -->

    <!-- Detail -->
    <div class="box box-solid">
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table id="DataTableValores" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Tipo Valor</th>
                    <th>Importe</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($records)) : ?>
                    <?php foreach ($records as $row) : ?>
                      <tr>
                        <td><?php echo $row->val_fecha_creacion; ?></td>
                        <td><?php echo $row->tva_nombre; ?></td>
                        <td><?php echo $row->val_importe; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Movimientos/Ventas/edit/<?= $row->vec_id; ?>/3" rel="tooltip" title="Venta" class="btn btn-warning btn-xs btn-shadow"><span class="fa fa-pencil"></span></a>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div> <!-- /.box-body -->
    </div> <!-- /.box -->

    <!-- Footer -->
    <div class="box box-solid">
      <div class="box-body">
        <!-- Formulario -->
        <form>
          <div class="row">
            <div class="form-group col-md-2 pull-right">
              <div class="input-group">
                <span class="input-group-addon"><strong>Total:</strong></span>
                <input type="text" class="form-control text-right" id="val_importe" name="val_importe" value="0.00" readonly="readonly">
              </div>
            </div>
          </div> <!-- /.row -->
        </form>
      </div> <!-- /.box-body -->
    </div> <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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
    $('#val_fecha').mask('00/00/0000');

    //////////////////////////////////////////////////////////////////////////////////////////
    // Inicializa DataTables
    //////////////////////////////////////////////////////////////////////////////////////////
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
      "columns": [{
          data: "val_fecha_creacion"
        },
        {
          data: "tva_nombre"
        },
        {
          data: "val_importe"
        },
        {
          data: "opciones"
        }
      ],
      "columnDefs": [{
          "targets": [0], // Fecha
          "render": $.fn.dataTable.render.moment('YYYY-MM-DD HH:mm:ss', 'DD/MM/YYYY HH:mm:ss')
        },
        {
          "targets": [3],
          "className": "text-center"
        },
        {
          "targets": [2],
          "className": "text-right"
        }
      ]

    });
    $('.sidebar-menu').tree();
    var DataTableValores = $('#DataTableValores').DataTable();

    //////////////////////////////////////////////////////////////////////////////////////////
    // Inicializa Calendarios
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#datetimepicker1').datetimepicker({
      locale: 'es',
      format: 'L', // Sólo Fechas (sin Horas)
      // allowInputToggle: true, // Abre el calendario al hacer foco en el campo Fecha
      useCurrent: false //Important! See issue #1075
    });

    //////////////////////////////////////////////////////////////////////////////////////////
    // Calcula Total
    //////////////////////////////////////////////////////////////////////////////////////////
    calcularTotal();

    //////////////////////////////////////////////////////////////////////////////////////////
    // Submit form si cambia la Fecha
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#datetimepicker1').on('dp.change', function() {
      $('#frmFecha').submit();
    });

    //////////////////////////////////////////////////////////////////////////////////////////
    // Calcular Total Ventas
    //////////////////////////////////////////////////////////////////////////////////////////
    function calcularTotal() {
      // Get data from datatable
      var data = DataTableValores.rows().data();

      total = 0;

      for (var i = 0; i < data.length; i += 1) {
        total += Number(data[i].val_importe);
      }

      $("#val_importe").val(total.toFixed(2));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////
  }) // $(document).ready(function () {
  ////////////////////////////////////////////////////////////////////////////////////////////
</script>