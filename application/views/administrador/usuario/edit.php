<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Usuarios <small>Editar</small></h1>
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

        <?php 
          if (!empty($validacion)) {
            // Get data from validation
            $usu_id = set_value('usu_id');
            $usu_username = set_value('usu_username');
            $usu_nombre = set_value('usu_nombre');
            $usu_apellido = set_value('usu_apellido');
            $usu_email = set_value('usu_email');
            $usu_activo = set_value('usu_activo');
            $rol_id = set_value('rol_id');
          }else{
            // Get data from database
            $usu_id = $data->usu_id;
            $usu_username = $data->usu_username;
            $usu_nombre = $data->usu_nombre;
            $usu_apellido = $data->usu_apellido;
            $usu_email = $data->usu_email;
            $usu_activo = $data->usu_activo;
            $rol_id = $data->rol_id;
          }
        ?>

        <div class="row">
          <div class="col-md-12">
            <!-- Mensajes de error -->
            <?php if($this->session->flashdata("error")):?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
              </div>
            <?php endif;?>
            <!-- Form -->
            <?php echo form_open(base_url().'Administrador/Usuario/edit/'.$usu_id);?>

              <!-- Hidden Inputs -->
              <div class="form-group row col-8">
                <input type="hidden" class="form-control"  id="usu_id" name="usu_id" value="<?php echo $usu_id; ?>"/>
              </div>   

              <!-- Usuario -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="usu_username">Usuario:</label>
                <div class="col-md-2">
                  <input type="text" class="form-control form-control-md" id="usu_username" name="usu_username" value="<?php echo $usu_username; ?>" disabled>
                  <input type="hidden" class="form-control form-control-md" id="usu_username" name="usu_username" value="<?php echo $usu_username; ?>">
                </div>
              </div>

              <!-- Nombre -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="usu_nombre">Nombre:</label>
                <div class="col-md-4">
                  <input type="text" class="form-control form-control-md" id="usu_nombre" name="usu_nombre" value="<?php echo $usu_nombre; ?>" autofocus>
                </div>        
              </div>

              <!-- Apellido -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="usu_apellido">Apellido:</label>
                <div class="col-md-4">
                  <input type="text" class="form-control form-control-md" id="usu_apellido" name="usu_apellido" value="<?php echo $usu_apellido; ?>">
                </div>        
              </div>

              <!-- Email -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md" for="usu_email">Email:</label>
                <div class="col-md-4">
                  <input type="text" class="form-control form-control-md" id="usu_email" name="usu_email" value="<?php echo $usu_email; ?>">
                </div>        
              </div>

              <!-- Rol -->
              <?php $selected = $rol_id; ?>
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
                  <input type="hidden" id="usu_activo" name="usu_activo" value="<?=$usu_activo;?>">
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
