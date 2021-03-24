<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Stock <small>Movimientos</small></h1>
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
        <form method="post" id="frmFecha" action="<?php echo base_url() ?>Consultas/Stock/movimientos">
          <!-- Fecha -->
          <div class="row">
            <!-- Código Stock -->
            <div class="form-group col-md-2">
              <label for="mst_fecha">Fecha</label>
              <div class='input-group date' id='datetimepicker1'>
                <input type='text' class="form-control" id="mst_fecha" name="mst_fecha" placeholder="dd/mm/aaaa" value="<?= $fecha_movimiento; ?>" autofocus />
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
              <table id="tbMovimientos" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Código Barras</th>
                    <th>Artículo</th>
                    <th>Color</th>
                    <th>Talle</th>
                    <th>Saldo Anterior</th>
                    <th>Saldo Actual</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($records)) : ?>
                    <?php foreach ($records as $row) : ?>
                      <tr>
                        <td><?php echo $row->mst_fecha_creacion; ?></td>
                        <td><?php echo $row->tmo_nombre; ?></td>
                        <td><?php echo $row->sto_codigo_barras; ?></td>
                        <td><?php echo $row->art_nombre; ?></td>
                        <td><?php echo $row->col_nombre; ?></td>
                        <td><?php echo $row->sto_talle; ?></td>
                        <td><?php echo $row->mst_stock_anterior; ?></td>
                        <td><?php echo $row->mst_stock_actual; ?></td>
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

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
  ////////////////////////////////////////////////////////////////////////////////////////////
  $(document).ready(function() {
    ////////////////////////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////////////////////
    // Máscaras
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#mst_fecha').mask('00/00/0000');

    //////////////////////////////////////////////////////////////////////////////////////////
    // Inicializa DataTables
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#tbMovimientos').DataTable({
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
          "targets": [0], // Fecha y Hora
          "render": $.fn.dataTable.render.moment('YYYY-MM-DD HH:mm:ss', 'DD/MM/YYYY HH:mm:ss')
        },
        {
          "targets": [4, 5, 6],
          "className": "text-center"
        }
      ]

    });
    $('.sidebar-menu').tree();

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
    // Submit form si cambia la Fecha
    //////////////////////////////////////////////////////////////////////////////////////////
    // Submit si cambia la Fecha Valor
    $('#datetimepicker1').on('dp.change', function() {
      $('#frmFecha').submit();
    });

    ////////////////////////////////////////////////////////////////////////////////////////////
  }) // $(document).ready(function () {
  ////////////////////////////////////////////////////////////////////////////////////////////
</script>