<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Cuenta Corriente <small>Listado</small></h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box box-solid">
      <div class="box-body">

        <!-- Mensajes de error-->
        <?php if ($this->session->flashdata("error")) : ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
          </div>
        <?php endif; ?>

        <hr>
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table id="DataTableDeudores" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Fecha</th>
                    <th>Importe</th>
                    <th>Saldo</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($records)) : ?>
                    <?php foreach ($records as $row) : ?>
                      <tr>
                        <td><?php echo $row->cli_nombre; ?></td>
                        <td><?php echo $row->cli_telefono; ?></td>
                        <td><?php echo $row->vec_fecha; ?></td>
                        <td><?php echo $row->vec_importe; ?></td>
                        <td><?php echo $row->vec_saldo; ?></td>
                        <td>
                          <div class="btn-group">
                            <?php if ($permisos->prm_update == 1) : ?>
                              <a href="<?php echo base_url() ?>Movimientos/Ventas/edit/<?php echo $row->vec_id; ?>/2" rel="tooltip" title="Venta" class="btn btn-warning btn-xs btn-shadow"><span class="fa fa-pencil"></span></a>
                            <?php endif; ?>
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
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
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
    // Inicializa DataTables
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#DataTableDeudores').DataTable({
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
      "order": [
        [2, "asc"]
      ],
      "columnDefs": [{
          "targets": [2, 5],
          "className": "text-center"
        },
        {
          "targets": [3, 4],
          "className": "text-right"
        },
        {
          "targets": [5],
          "orderable": false
        },
        {
          "targets": [2],
          "render": $.fn.dataTable.render.moment('YYYY-MM-DD', 'DD/MM/YYYY')
        }
      ]
    });
    $('.sidebar-menu').tree();

    ////////////////////////////////////////////////////////////////////////////////////////////
  }) // $(document).ready(function () {
  ////////////////////////////////////////////////////////////////////////////////////////////
</script>