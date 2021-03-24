<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Artículos <small>Agregar</small></h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box box-solid">
      <div class="box-body">

        <div class="row">
          <div class="col-md-12">
          
            <!-- Mensajes de error -->
            <?php if($this->session->flashdata("error")):?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-ban"></i><?= $this->session->flashdata("error"); ?></p>
              </div>
            <?php endif;?>

            <!-- Mensajes Validación -->
            <?php if (!empty(validation_errors())) { ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= validation_errors(); ?>
              </div>
            <?php } ?>

            <?php echo form_open(base_url().'Mantenimiento/Articulo/add'); ?>
              <!-- Hidden Inputs -->
              <div class="form-group row col-6">
                <input type="hidden" class="form-control"  id="coeficiente" name="coeficiente" value="<?= $coeficiente; ?>"/>
              </div>

              <!-- Código -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md" for="art_codigo">Código:</label>
                <div class="col-md-2">
                  <input type="text" class="form-control form-control-md" id="art_codigo" name="art_codigo" value="<?= set_value('art_codigo'); ?>" autofocus>
                </div>
              </div>

              <!-- Nombre -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md" for="art_nombre">Nombre:</label>
                <div class="col-md-4">
                  <input type="text" class="form-control form-control-md" id="art_nombre" name="art_nombre" value="<?= set_value('art_nombre'); ?>">
                </div>
              </div>

              <!-- Precio Compra -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md" for="art_precio_compra">Precio Compra:</label>
                <div class="col-md-2">
                  <input type="text" class="form-control form-control-md" id="art_precio_compra" name="art_precio_compra" value="<?= set_value('art_precio_compra'); ?>">
                </div>        
              </div>

              <!-- Precio Venta -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md" for="art_precio_venta">Precio Venta:</label>
                <div class="col-md-2">
                  <input type="text" class="form-control form-control-md" id="art_precio_venta" name="art_precio_venta" value="<?= set_value('art_precio_venta'); ?>">
                </div>        
              </div>

              <!-- Código Stock -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md" for="sto_codigo">Código Stock:</label>
                <div class="col-md-2">
                  <input type="text" class="form-control form-control-md" id="sto_codigo" name="sto_codigo" value="<?= set_value('sto_codigo'); ?>">
                </div>
              </div>

              <!-- Button -->
              <br>
              <div class="form-group row col-6">
                <!-- <div class="col-md-2"></div> -->
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary btn-shadow"><span class="fa fa-save"></span> Guardar</button>
                </div>    
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
$(document).ready(function () {
////////////////////////////////////////////////////////////////////////////////////////////

  //////////////////////////////////////////////////////////////////////////////////////////
  // Máscaras
  //////////////////////////////////////////////////////////////////////////////////////////
  $('#art_codigo').mask('00/0000', {clearIfNotMatch: true});
  $('#sto_codigo').mask('000000');
  $('#art_precio_compra').mask('99999999999999999.00');
  $('#art_precio_venta').mask('99999999999999999.00');

  //////////////////////////////////////////////////////////////////////////////////////////
  // Formato
  //////////////////////////////////////////////////////////////////////////////////////////
  $(document).on("focusout", "input[id=art_precio_compra]", function(){
    precio = Number($('#art_precio_compra').val()).toFixed(2);
    $('#art_precio_compra').val(precio);
  })
  $(document).on("focusout", "input[id=art_precio_venta]", function(){
    precio = Number($('#art_precio_venta').val()).toFixed(2);
    $('#art_precio_venta').val(precio);
  })

  //////////////////////////////////////////////////////////////////////////////////////////
  // Calcula Precio de Venta
  //////////////////////////////////////////////////////////////////////////////////////////
  $(document).on("paste keyup", "input[id=art_precio_compra]", function(){
    precio_compra = Number($('#art_precio_compra').val()).toFixed(2);
    coeficiente = Number($('#coeficiente').val()).toFixed(2);
    precio_venta = Number(precio_compra * coeficiente).toFixed(2);
    $('#art_precio_venta').val(precio_venta);
  })

////////////////////////////////////////////////////////////////////////////////////////////
}) // $(document).ready(function () {
////////////////////////////////////////////////////////////////////////////////////////////
</script>