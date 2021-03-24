<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Stock <small>Consulta</small></h1>
  </section>
  <!-- Main content --> 
  <section class="content">

    <!-- Detail -->
    <div class="box box-solid">
      <div class="box-body">

        <!-- Mensajes de error -->
        <?php if($this->session->flashdata("error")):?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
          </div>
        <?php endif;?>

        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                  <tr>
                    <th>Código Barras</th>
                    <th>Artículo</th>
                    <th>Color</th>
                    <th>Talle</th>
                    <th>Cantidad</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($records)):?>
                  <?php foreach($records as $row):?>
                    <tr>
                      <td><?php echo $row->sto_codigo_barras; ?></td>
                      <td><?php echo $row->art_nombre; ?></td>
                      <td><?php echo $row->col_nombre; ?></td>
                      <td><?php echo $row->sto_talle; ?></td>
                      <td><?php echo $row->sto_cantidad; ?></td>
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
