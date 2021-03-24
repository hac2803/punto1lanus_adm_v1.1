<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Ventas <small>Consulta</small></h1>
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
        <form method="get" id="frmFecha" action="<?php echo base_url() ?>Consultas/Ventas/">
          <!-- Fecha -->
          <div class="row">
            <div class="form-group col-md-2">
              <label for="vec_fecha">Fecha</label>
              <div class='input-group date' id='datetimepicker1'>
                <input type='text' class="form-control" id="vec_fecha" name="vec_fecha" placeholder="dd/mm/aaaa" value="<?php echo $vec_fecha; ?>" autofocus>
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
              <table id="DataTableVentas" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Importe</th>
                    <th>Saldo</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($records)) : ?>
                    <?php foreach ($records as $row) : ?>
                      <tr>
                        <td><?php echo $row->vec_fecha_creacion; ?></td>
                        <td><?php echo $row->cli_nombre; ?></td>
                        <td><?php echo $row->vec_importe; ?></td>
                        <td><?php echo $row->vec_saldo; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url(); ?>Movimientos/Ventas/edit/<?php echo $row->vec_id; ?>/1" rel="tooltip" title="Venta" class="btn btn-warning btn-xs btn-shadow"><span class="fa fa-pencil"></span></a>
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
                <input type="text" class="form-control text-right" id="vec_importe" name="vec_importe" value="0.00" readonly="readonly">
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
    $('#vec_fecha').mask('00/00/0000');

    //////////////////////////////////////////////////////////////////////////////////////////
    // Inicializa DataTables
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#DataTableVentas').DataTable({
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
          data: "vec_fecha_creacion"
        },
        {
          data: "cli_nombre"
        },
        {
          data: "vec_importe"
        },
        {
          data: "vec_saldo"
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
          "targets": [4],
          "className": "text-center"
        },
        {
          "targets": [2, 3],
          "className": "text-right"
        }
      ]

    });
    $('.sidebar-menu').tree();
    var DataTableVentas = $('#DataTableVentas').DataTable();

    //////////////////////////////////////////////////////////////////////////////////////////
    // Inicializa Calendarios
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#datetimepicker1').datetimepicker({
      locale: 'es',
      format: 'L', // Sólo Fechas (sin Horas)
      maxDate: new Date(), // Fecha Máxima HOY
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
      var data = DataTableVentas.rows().data();

      total = 0;

      for (var i = 0; i < data.length; i += 1) {
        total += Number(data[i].vec_importe);
      }

      $("#vec_importe").val(total.toFixed(2));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////
  }) // $(document).ready(function () {
  ////////////////////////////////////////////////////////////////////////////////////////////
</script>