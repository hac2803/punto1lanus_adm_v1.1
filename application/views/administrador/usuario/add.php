<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Usuarios <small>Agregar</small></h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box box-solid">
      <div class="box-body">

        <!-- Mensajes Validación -->
        <?php
          $validacion = validation_errors();
        ?>
        <?php if (!empty($validacion)) { ?>
            <div class="alert alert-danger">
              <?=$validacion?>
            </div>
        <?php } ?>

        <div class="row">
          <div class="col-md-12">
          
            <!-- Mensajes de error -->
            <?php if($this->session->flashdata("error")):?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
              </div>
            <?php endif;?>

            <?= form_open(base_url().'Administrador/Usuario/add'); ?>
              <!-- Hidden Inputs -->
              <div class="form-group row col-4">
                <input type="hidden" class="form-control"  id="" name="" value=""/>
              </div>

              <!-- Usuario -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="usu_username">Usuario:</label>
                <div class="col-md-2">
                  <input type="text" class="form-control form-control-md" id="usu_username" name="usu_username" value="<?php echo set_value('usu_username'); ?>" autofocus>
                </div>        
              </div>
              <!-- Clave -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="usu_password">Clave:</label>
                <div class="col-md-2">
                  <input type="password" class="form-control form-control-md" id="usu_password" name="usu_password" value="<?php echo set_value('usu_password'); ?>">
                </div>        
              </div>
              <!-- Confirmación de Clave -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="usu_password_confirmacion">Confirmación de Clave:</label>
                <div class="col-md-2">
                  <input type="password" class="form-control form-control-md" id="usu_password_confirmacion" name="usu_password_confirmacion" value="<?php echo set_value('usu_password_confirmacion'); ?>">
                </div>        
              </div>      
              <!-- Nombre -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="usu_nombre">Nombre:</label>
                <div class="col-md-4">
                  <input type="text" class="form-control form-control-md" id="usu_nombre" name="usu_nombre" value="<?php echo set_value('usu_nombre'); ?>">
                </div>        
              </div>
              <!-- Apellido -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="usu_apellido">Apellido:</label>
                <div class="col-md-4">
                  <input type="text" class="form-control form-control-md" id="usu_apellido" name="usu_apellido" value="<?php echo set_value('usu_apellido'); ?>">
                </div>        
              </div>
              <!-- Email -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md" for="usu_email">Email:</label>          
                <div class="col-md-4">
                  <input type="text" class="form-control"  id="usu_email" name="usu_email" value="<?= set_value('usu_email'); ?>"/>
                </div>  
              </div>
              <!-- Rol -->
              <?php $selected = set_value('rol_id'); ?>
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="rol_id">Rol:</label>
                <div class="col-md-2">
                  <select class="form-control" id="rol_id" name="rol_id">
                    <option value="">Seleccione una opción</option>
                    <?php foreach ($roles as $row): ?>
                      <option value="<?php echo $row->rol_id; ?>"<?php if ($row->rol_id == $selected) {echo "selected";}?>><?php echo $row->rol_nombre; ?></option>
                    <?php endforeach; ?>            
                  </select>
                </div>          
              </div>

              <!-- Activo -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="usu_activo">Activo:</label>
                <div class="col-md-1">
                  <input type="hidden" id="usu_activo" name="usu_activo" value="<?= set_value('usu_activo');?>">
                  <input type="checkbox" id="checkbox1" name="checkbox1">
                </div>
              </div>

              <br>              
              <!-- Button -->
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
  // Inicializa Bootstrap Switch
  //////////////////////////////////////////////////////////////////////////////////////////
  $('#checkbox1').bootstrapSwitch('onText', 'Si');
  $('#checkbox1').bootstrapSwitch('offText', 'No');
  $('#checkbox1').bootstrapSwitch('onColor', 'success');
  $('#checkbox1').bootstrapSwitch('offColor', 'danger');
  if ($('#usu_activo').val() == "1" || $('#usu_activo').val() == ""){
    $('#checkbox1').bootstrapSwitch('state', true);
    $('#usu_activo').val('1');
  }else{
    $('#checkbox1').bootstrapSwitch('state', false);
    $('#usu_activo').val('0');
  }

  //////////////////////////////////////////////////////////////////////////////////////////
  // Eventos Bootstrap Switch
  //////////////////////////////////////////////////////////////////////////////////////////
  $('#checkbox1').on('switchChange.bootstrapSwitch', function(event, state) {
    if (state == true){
      $('#usu_activo').val('1');
    }else{
      $('#usu_activo').val('0');
    }
  });

////////////////////////////////////////////////////////////////////////////////////////////
}) // $(document).ready(function () {
////////////////////////////////////////////////////////////////////////////////////////////
</script>
