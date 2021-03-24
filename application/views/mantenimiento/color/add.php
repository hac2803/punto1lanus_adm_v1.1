<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Colores <small>Agregar</small></h1>
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

            <?php echo form_open(base_url().'Mantenimiento/Color/add'); ?>
              <!-- Hidden Inputs -->
              <div class="form-group row col-6">
                <input type="hidden" class="form-control"  id="" name="" value=""/>
              </div>

              <!-- Código -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md" for="col_codigo">Código:</label>
                <div class="col-md-2">
                  <input type="text" class="form-control form-control-md" id="col_codigo" name="col_codigo" value="<?= set_value('col_codigo'); ?>" autofocus>
                </div>
              </div>

              <!-- Nombre -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md" for="col_nombre">Nombre:</label>
                <div class="col-md-4">
                  <input type="text" class="form-control form-control-md" id="col_nombre" name="col_nombre" value="<?= set_value('col_nombre'); ?>">
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
  $('#col_codigo').mask('000');

////////////////////////////////////////////////////////////////////////////////////////////
}) // $(document).ready(function () {
////////////////////////////////////////////////////////////////////////////////////////////
</script>