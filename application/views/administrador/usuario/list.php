<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Usuarios <small>Listado</small></h1>
  </section>
  <!-- Main content --> 
  <section class="content">
    <!-- Default box -->
    <div class="box box-solid">
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <?php if($permisos->prm_insert == 1): ?>
              <a href="<?php echo base_url();?>Administrador/Usuario/add" class="btn btn-primary btn-shadow"><span class="fa fa-plus"></span> Agregar</a>
            <?php endif; ?>
          </div>
        </div>
        <hr>
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table id="DataTableUsuarios" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Usuario</th>
                      <th>Email</th> 
                      <th>Rol</th>
                      <th>Activo</th>                      
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($records)):?>
                    <?php foreach($records as $row):?>
                      <tr>
                        <td><?php echo $row->usu_nombre; ?></td>
                        <td><?php echo $row->usu_apellido; ?></td>
                        <td><?php echo $row->usu_username; ?></td>
                        <td><?php echo $row->usu_email; ?></td>
                        <td><?php echo $row->rol_nombre; ?></td>

                        <!-- Activo -->
                        <td>
                          <?php if($row->usu_activo == 0): ?>
                            <a href="#" class="btn btn-danger btn-xs btn-shadow"><span class="fa fa-times"></span></a>
                          <?php else: ?>
                            <a href="#" class="btn btn-success btn-xs btn-shadow"><span class="fa fa-check"></span></a>
                          <?php endif; ?>
                        </td>

                        <td>
                          <div class="btn-group">
                            <?php if($permisos->prm_update == 1): ?>
                              <a href="<?php echo base_url()?>Administrador/Usuario/edit/<?php echo $row->usu_id;?>" rel="tooltip" title="Editar" class="btn btn-warning btn-xs btn-shadow"><span class="fa fa-pencil"></span></a>
                            <?php endif; ?>
                            <?php if($permisos->prm_update == 1): ?>
                              <a href="<?php echo base_url();?>Administrador/Usuario/delete/<?php echo $row->usu_id;?>" rel="tooltip" title="Eliminar" class="btn btn-danger btn-xs btn-remove btn-shadow"><span class="fa fa-trash"></span></a>
                            <?php endif; ?>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach;?>
                    <?php endif;?>
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
    $('#DataTableUsuarios').DataTable({
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
        "targets": [5, 6],
        "className": "text-center"
      }]

    });
    $('.sidebar-menu').tree();

    ////////////////////////////////////////////////////////////////////////////////////////////
  }) // $(document).ready(function () {
  ////////////////////////////////////////////////////////////////////////////////////////////
</script>