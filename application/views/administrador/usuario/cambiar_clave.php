<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Usuarios <small>Cambiar Clave</small></h1>
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
            $usu_password = set_value('usu_password');
            $usu_password_nueva = set_value('usu_password_nueva');
            $usu_password_confirmacion = set_value('usu_password_confirmacion');
          }else{
            // Get data from database
            $usu_id = $data->usu_id;
            $usu_username = $data->usu_username;
            $usu_nombre = $data->usu_nombre;
            $usu_apellido = $data->usu_apellido;
            $usu_password = ''; // No puede desencriptarse la password almacenada en la base de datos
            $usu_password_nueva = '';
            $usu_password_confirmacion = '';
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
            <!-- Mensajes de Confirmación -->
            <?php if($this->session->flashdata("success")):?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i><?php echo $this->session->flashdata("success"); ?></p>
              </div>
            <?php endif;?>
            <!-- Form -->
            <?php echo form_open(base_url().'Administrador/Usuario/cambiar_clave/'.$usu_id);?>
              <!-- ID -->
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
                  <input type="text" class="form-control form-control-md" id="usu_nombre" name="usu_nombre" value="<?php echo $usu_nombre; ?>" disabled>
                  <input type="hidden" class="form-control form-control-md" id="usu_nombre" name="usu_nombre" value="<?php echo $usu_nombre; ?>">
                </div>        
              </div>
              <!-- Apellido -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="usu_apellido">Apellido:</label>
                <div class="col-md-4">
                  <input type="text" class="form-control form-control-md" id="usu_apellido" name="usu_apellido" value="<?php echo $usu_apellido; ?>" disabled>
                  <input type="hidden" class="form-control form-control-md" id="usu_apellido" name="usu_apellido" value="<?php echo $usu_apellido; ?>">
                </div>        
              </div>
              <!-- Clave Actual -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="usu_password_nueva">Clave Actual:</label>
                <div class="col-md-2">
                  <input type="password" class="form-control form-control-md" id="usu_password" name="usu_password" value="<?php echo $usu_password; ?>" autofocus>
                </div>        
              </div>
              <!-- Nueva Clave -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="usu_password_nueva">Nueva Clave:</label>
                <div class="col-md-2">
                  <input type="password" class="form-control form-control-md" id="usu_password_nueva" name="usu_password_nueva" value="<?php echo $usu_password_nueva; ?>">
                </div>        
              </div>
              <!-- Confirmación Nueva Clave -->
              <div class="form-group row col-6">
                <label class="col-md-2 col-form-label col-form-label-md text-primary" for="usu_password_confirmacion">Confirmación Nueva Clave:</label>
                <div class="col-md-2">
                  <input type="password" class="form-control form-control-md" id="usu_password_confirmacion" name="usu_password_confirmacion" value="<?php echo $usu_password_confirmacion; ?>">
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
