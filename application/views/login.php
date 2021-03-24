<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?PHP echo SITE_TITLE ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="icon" href="<?php echo base_url() ?>assets/images/favicon.png" type="image/png">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/AdminLTE.min.css">
</head>

  <!-- Mensajes Validación -->
  <?php
    $validacion = validation_errors();
    if ($validacion) {
      $this->session->set_flashdata("error", $validacion);
    }
  ?>

<body class="hold-transition login-page">

  <div class="login-box">
    <div class="login-logo mb-5">
      <img src="<?php echo base_url()?>assets/images/Logo_Punto1_360_Transparente.png">
      <h3>ADMINISTRACIÓN</h3>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Introduzca sus datos de ingreso</p>
      <?php if($this->session->flashdata("error")):?>
        <div class="alert alert-danger">
          <p><?php echo $this->session->flashdata("error")?></p>
        </div>
      <?php endif; ?>
      <form action="<?php echo base_url();?>auth/login" method="post">
        <!-- Usuario -->
        <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Usuario" name="usu_username" value="<?php echo set_value('usu_username'); ?>" autofocus>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <!-- Clave -->
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Clave" name="usu_password" value="<?php echo set_value('usu_password'); ?>">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <!-- Button -->
        <div class="row">
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

</body>
</html>
