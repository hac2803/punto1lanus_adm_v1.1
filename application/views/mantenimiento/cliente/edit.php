<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Clientes <small>Editar</small></h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box box-solid">
      <div class="box-body">

        <!-- Get Data -->
        <?php
        if (!empty(validation_errors())) {
          // Get data from validation
          $cli_id = set_value('cli_id');
          $cli_nombre = set_value('cli_nombre');
          $cli_telefono = set_value('cli_telefono');
        } else {
          // Get data from database
          $cli_id = $data->cli_id;
          $cli_nombre = $data->cli_nombre;
          $cli_telefono = $data->cli_telefono;
        }
        ?>
        <div class="row">
          <div class="col-md-12">

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

            <form method="post" action="<?php echo base_url() . 'Mantenimiento/Cliente/edit/' . $cli_id; ?>">
              <!-- Hidden Inputs -->
              <div class="form-group col-6">
              <input type="hidden" class="form-control"  id="cli_id" name="cli_id" value="<?= $cli_id; ?>"/>
              </div>

              <!-- Nombre -->
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="cli_nombre">Nombre:</label>
                  <input type="text" class="form-control text-uppercase" id="cli_nombre" name="cli_nombre" value="<?= $cli_nombre; ?>" autofocus>
                </div>
              </div>

              <!-- Teléfono -->
              <div class="form-group row">
                <div class="col-md-2">
                  <label for="cli_telefono">Teléfono:</label>
                  <input type="text" class="form-control" id="cli_telefono" name="cli_telefono" placeholder="(011) 4444-4444" value="<?= $cli_telefono; ?>">
                </div>
              </div>

              <br>

              <!-- Button -->
              <div class="form-group col-6">
                <button type="submit" class="btn btn-primary btn-shadow"><span class="fa fa-save"></span> Guardar</button>
              </div>

            </form>
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
    // Máscaras
    //////////////////////////////////////////////////////////////////////////////////////////
    $('#cli_telefono').mask('(999) 9999-9999', {
      clearIfNotMatch: true
    });

    //////////////////////////////////////////////////////////////////////////////////////////
    // Formato
    //////////////////////////////////////////////////////////////////////////////////////////
    $(document).on("focusout", "input[id=art_precio_compra]", function() {
      precio = Number($('#art_precio_compra').val()).toFixed(2);
      $('#art_precio_compra').val(precio);
    })
    $(document).on("focusout", "input[id=art_precio_venta]", function() {
      precio = Number($('#art_precio_venta').val()).toFixed(2);
      $('#art_precio_venta').val(precio);
    })

    //////////////////////////////////////////////////////////////////////////////////////////
    // Calcula Precio de Venta
    //////////////////////////////////////////////////////////////////////////////////////////
    $(document).on("paste keyup", "input[id=art_precio_compra]", function() {
      precio_compra = Number($('#art_precio_compra').val()).toFixed(2);
      coeficiente = Number($('#coeficiente').val()).toFixed(2);
      precio_venta = Number(precio_compra * coeficiente).toFixed(2);
      $('#art_precio_venta').val(precio_venta);
    })

    ////////////////////////////////////////////////////////////////////////////////////////////
  }) // $(document).ready(function () {
  ////////////////////////////////////////////////////////////////////////////////////////////
</script>