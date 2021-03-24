<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Colores <small>Editar</small></h1>
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
            $col_id = set_value('col_id');
            $col_codigo = set_value('col_codigo');
            $col_nombre = set_value('col_nombre');
          }else{
            // Get data from database
            $col_id = $data->col_id;
            $col_codigo = $data->col_codigo;
            $col_nombre = $data->col_nombre;
          }
        ?>

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

            <?php echo form_open(base_url().'Mantenimiento/Color/edit/'.$col_id);?>
              <!-- Hidden Inputs -->
              <div class="form-group row col-6">  
                <input type="hidden" class="form-control"  id="col_id" name="col_id" value="<?= $col_id; ?>"/>
              </div>

              <!-- Código -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md" for="col_codigo">Código:</label>
                <div class="col-md-2">
                  <input type="text" class="form-control form-control-md" id="col_codigo" name="col_codigo" value="<?= $col_codigo; ?>" autofocus/>
                </div>        
              </div>

              <!-- Nombre -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md" for="col_nombre">Nombre:</label>
                <div class="col-md-4">
                  <input type="text" class="form-control form-control-md" id="col_nombre" name="col_nombre" value="<?= $col_nombre; ?>">
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