<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Permisos <small>Editar</small></h1>
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
            $prm_id = set_value('prm_id');
            $rol_id = set_value('rol_id');
            $men_id = set_value('men_id');
            $prm_read = set_value('prm_read');
            $prm_insert = set_value('prm_insert');
            $prm_update = set_value('prm_update');
            $prm_delete = set_value('prm_delete');
          }else{
            // Get data from database
            $prm_id = $data->prm_id;
            $rol_id = $data->rol_id;
            $men_id = $data->men_id;
            $prm_read = $data->prm_read;
            $prm_insert = $data->prm_insert;
            $prm_update = $data->prm_update;
            $prm_delete = $data->prm_delete;
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

            <?php echo form_open(base_url().'Administrador/Permiso/edit/'.$prm_id);?>
              <!-- Hidden Inputs -->
              <div class="form-group row col-4">  
                <input type="hidden" class="form-control" id="prm_id" name="prm_id" value="<?php echo $prm_id;?>"/>
              </div>

              <!-- Rol -->
              <?php $selected = $rol_id; ?>
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="rol">Rol:</label>
                <div class="col-md-4"> 
                  <select name="rol_id" id="rol_id" class="form-control">
                    <option value="">Seleccione una opción</option>
                    <?php foreach($roles as $row): ?>
                      <option value="<?php echo $row->rol_id;?>"<?php if ($row->rol_id == $selected) {echo "selected";};?>><?php echo $row->rol_nombre;?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <!-- Menú -->
              <?php $selected = $men_id; ?>
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="menu">Menú:</label>
                <div class="col-md-4"> 
                  <select name="men_id" id="men_id" class="form-control">
                    <option value="">Seleccione una opción</option>
                    <?php foreach($menus as $row): ?>
                      <option value="<?php echo $row->men_id;?>"<?php if ($row->men_id == $selected) {echo "selected";};?>><?php echo $row->men_link;?></option>                    
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <!-- Leer -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="prm_read">Leer:</label>
                <div class="col-md-1">
                  <input type="hidden" id="prm_read" name="prm_read" value="<?= $prm_read;?>">
                  <input type="checkbox" id="checkbox1" name="checkbox1">
                </div>
              </div>

              <!-- Agregar -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="prm_insert">Agregar:</label>
                <div class="col-md-1">
                  <input type="hidden" id="prm_insert" name="prm_insert" value="<?= $prm_insert;?>">
                  <input type="checkbox" id="checkbox2" name="checkbox2">
                </div>
              </div>

              <!-- Modificar -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="prm_update">Modificar:</label>
                <div class="col-md-1">
                  <input type="hidden" id="prm_update" name="prm_update" value="<?= $prm_update;?>">
                  <input type="checkbox" id="checkbox3" name="checkbox3">
                </div>
              </div>

              <!-- Eliminar -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="prm_delete">Eliminar:</label>
                <div class="col-md-1">
                  <input type="hidden" id="prm_delete" name="prm_delete" value="<?= $prm_delete;?>">
                  <input type="checkbox" id="checkbox4" name="checkbox4">
                </div>
              </div>

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
  // Inicializa Bootstrap Switch
  //////////////////////////////////////////////////////////////////////////////////////////
  $('#checkbox1').bootstrapSwitch('onText', 'Si');
  $('#checkbox1').bootstrapSwitch('offText', 'No');
  $('#checkbox1').bootstrapSwitch('onColor', 'success');
  $('#checkbox1').bootstrapSwitch('offColor', 'danger');
  if ($('#prm_read').val() == "1" || $('#prm_read').val() == ""){
    $('#checkbox1').bootstrapSwitch('state', true);
    $('#prm_read').val('1');
  }else{
    $('#checkbox1').bootstrapSwitch('state', false);
    $('#prm_read').val('0');
  }

  $('#checkbox2').bootstrapSwitch('onText', 'Si'); 
  $('#checkbox2').bootstrapSwitch('offText', 'No');
  $('#checkbox2').bootstrapSwitch('onColor', 'success');
  $('#checkbox2').bootstrapSwitch('offColor', 'danger');
  if ($('#prm_insert').val() == "1" || $('#prm_insert').val() == ""){
    $('#checkbox2').bootstrapSwitch('state', true);
    $('#prm_insert').val('1');
  }else{
    $('#checkbox2').bootstrapSwitch('state', false);
    $('#prm_insert').val('0');
  }

  $('#checkbox3').bootstrapSwitch('onText', 'Si');
  $('#checkbox3').bootstrapSwitch('offText', 'No');
  $('#checkbox3').bootstrapSwitch('onColor', 'success');
  $('#checkbox3').bootstrapSwitch('offColor', 'danger');
  if ($('#prm_update').val() == "1" || $('#prm_update').val() == ""){
    $('#checkbox3').bootstrapSwitch('state', true);
    $('#prm_update').val('1');
  }else{
    $('#checkbox3').bootstrapSwitch('state', false);
    $('#prm_update').val('0');
  }

  $('#checkbox4').bootstrapSwitch('onText', 'Si');
  $('#checkbox4').bootstrapSwitch('offText', 'No');
  $('#checkbox4').bootstrapSwitch('onColor', 'success');
  $('#checkbox4').bootstrapSwitch('offColor', 'danger');
  if ($('#prm_delete').val() == "1" || $('#prm_delete').val() == ""){
    $('#checkbox4').bootstrapSwitch('state', true);
    $('#prm_delete').val('1');
  }else{
    $('#checkbox4').bootstrapSwitch('state', false);
    $('#prm_delete').val('0');
  }

  //////////////////////////////////////////////////////////////////////////////////////////
  // Eventos Bootstrap Switch
  //////////////////////////////////////////////////////////////////////////////////////////
  $('#checkbox1').on('switchChange.bootstrapSwitch', function(event, state) {
    if (state == true){
      $('#prm_read').val('1');
    }else{
      $('#prm_read').val('0');
    }
  });

  $('#checkbox2').on('switchChange.bootstrapSwitch', function(event, state) {
    if (state == true){
      $('#prm_insert').val('1');
    }else{
      $('#prm_insert').val('0');
    }
  });

  $('#checkbox3').on('switchChange.bootstrapSwitch', function(event, state) {
    if (state == true){
      $('#prm_update').val('1');
    }else{
      $('#prm_update').val('0');
    }
  });

  $('#checkbox4').on('switchChange.bootstrapSwitch', function(event, state) {
    if (state == true){
      $('#prm_delete').val('1');
    }else{
      $('#prm_delete').val('0');
    }
  });

////////////////////////////////////////////////////////////////////////////////////////////
}) // $(document).ready(function () {
////////////////////////////////////////////////////////////////////////////////////////////
</script>