<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Permisos <small>Listado</small></h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box box-solid">
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <a href="<?php echo base_url(); ?>Administrador/Permiso/add" class="btn btn-primary btn-shadow"><span class="fa fa-plus"></span> Agregar</a>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table id="DataTablePermisos" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Menú</th>
                    <th>Rol</th>
                    <th>Link</th>
                    <th>Leer</th>
                    <th>Agregar</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($records)) : ?>
                    <?php foreach ($records as $row) : ?>
                      <tr>
                        <td><?php echo $row->men_nombre; ?></td>
                        <td><?php echo $row->rol_nombre; ?></td>
                        <td><?php echo $row->men_link; ?></td>
                        <td>
                          <?php if ($row->prm_read == 0) : ?>
                            <a href="#" class="btn btn-danger btn-xs btn-shadow"><span class="fa fa-times"></span></a>
                          <?php else : ?>
                            <a href="#" class="btn btn-success btn-xs btn-shadow"><span class="fa fa-check"></span></a>
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if ($row->prm_insert == 0) : ?>
                            <a href="#" class="btn btn-danger btn-xs btn-shadow"><span class="fa fa-times"></span></a>
                          <?php else : ?>
                            <a href="#" class="btn btn-success btn-xs btn-shadow"><span class="fa fa-check"></span></a>
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if ($row->prm_update == 0) : ?>
                            <a href="#" class="btn btn-danger btn-xs btn-shadow"><span class="fa fa-times"></span></a>
                          <?php else : ?>
                            <a href="#" class="btn btn-success btn-xs btn-shadow"><span class="fa fa-check"></span></a>
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if ($row->prm_delete == 0) : ?>
                            <a href="#" class="btn btn-danger btn-xs btn-shadow"><span class="fa fa-times"></span></a>
                          <?php else : ?>
                            <a href="#" class="btn btn-success btn-xs btn-shadow"><span class="fa fa-check"></span></a>
                          <?php endif; ?>
                        </td>

                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Administrador/Permiso/edit/<?php echo $row->prm_id; ?>" rel="tooltip" title="Editar" class="btn btn-warning btn-xs btn-shadow"><span class="fa fa-pencil"></span></a>
                            <a href="<?php echo base_url(); ?>Administrador/Permiso/delete/<?php echo $row->prm_id; ?>" rel="tooltip" title="Eliminar" class="btn btn-danger btn-xs btn-remove btn-shadow"><span class="fa fa-trash"></span></a>
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
    $('#DataTablePermisos').DataTable({
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
        "targets": [3, 4, 5, 6, 7],
        "className": "text-center"
      }]

    });
    $('.sidebar-menu').tree();

    ////////////////////////////////////////////////////////////////////////////////////////////
  }) // $(document).ready(function () {
  ////////////////////////////////////////////////////////////////////////////////////////////
</script>