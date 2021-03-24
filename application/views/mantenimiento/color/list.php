<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Colores <small>Listado</small></h1>
  </section>
  <!-- Main content --> 
  <section class="content">
    <!-- Default box -->
    <div class="box box-solid">
      <div class="box-body">

        <!-- Mensajes de error-->
        <?php if($this->session->flashdata("error")):?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
          </div>
        <?php endif;?>

        <div class="row">
          <div class="col-md-12">
            <?php if($permisos->prm_insert == 1): ?>
              <a href="<?php echo base_url();?>Mantenimiento/Color/add" class="btn btn-primary btn-shadow"><span class="fa fa-plus"></span> Agregar</a>
            <?php endif; ?>
          </div>
        </div>
        <hr>
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table id="DataTableColores" class="table table-bordered table-striped table-hover table-sm">
                  <thead>
                    <tr>
                      <th>Código</th>
                      <th>Nombre</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($records)):?>
                    <?php foreach($records as $row):?>
                      <tr>
                        <td><?php echo $row->col_codigo; ?></td>
                        <td><?php echo $row->col_nombre; ?></td>
                        <td>
                          <div class="btn-group">
                            <?php if($permisos->prm_update == 1): ?>
                              <a href="<?php echo base_url()?>Mantenimiento/Color/edit/<?php echo $row->col_id;?>" rel="tooltip" title="Editar" class="btn btn-warning btn-xs btn-shadow"><span class="fa fa-pencil"></span></a>
                            <?php endif; ?>
                            <?php if($permisos->prm_delete == 1): ?>
                              <a href="<?php echo base_url();?>Mantenimiento/Color/delete/<?php echo $row->col_id;?>" rel="tooltip" title="Eliminar" class="btn btn-danger btn-xs btn-remove btn-shadow"><span class="fa fa-trash"></span></a>
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
    $('#DataTableColores').DataTable({
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
        "className": "text-center"
      }]  

    });
    $('.sidebar-menu').tree();

    ////////////////////////////////////////////////////////////////////////////////////////////
  }) // $(document).ready(function () {
  ////////////////////////////////////////////////////////////////////////////////////////////
</script>