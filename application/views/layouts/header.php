<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= SITE_TITLE ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="icon" href="<?php echo base_url() ?>assets/images/favicon.png" type="image/png">

    <!-- jquery-ui (autocomplete) -->
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui.css">   -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">

    <!-- Template -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/AdminLTE.min.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/_all-skins.min.css">

    <!-- Bootstrp Toogle -->
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-toggle.min.css"> -->

    <!-- jquery-confirm v3.3.0 (http://craftpip.github.io/jquery-confirm/) -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-confirm-v3.3.4/jquery-confirm.css">

    <!-- Calendario Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.css">

    <!-- DataTables FixedHeader  https://datatables.net/extensions/fixedheader/ -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dataTables.fixedHeader.min.css">

    <!-- Bootstrap Switch -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-switch/bootstrap-switch.css">
    <!-- <link rel="stylesheet" href="https://unpkg.com/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css">
  <link rel="stylesheet" href="https://getbootstrap.com/assets/css/docs.min.css">  -->

    <!-- hac2803 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/hac2803.css">

    <!-- Selectize -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/selectize.bootstrap3.css">

    <!----------------------------------------------------------------------------------------------------------------------------------->
    <!-- JAVASCRIPT --------------------------------------------------------------------------------------------------------------------->
    <!----------------------------------------------------------------------------------------------------------------------------------->
    <script>
        var base_url_js = "<?php echo base_url(); ?>";
    </script>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->

    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

    <!-- bootstrap-switch -->
    <script defer src="<?php echo base_url(); ?>assets/js/bootstrap-switch/bootstrap-switch.js"></script>
    <!-- <script defer src="https://unpkg.com/bootstrap-switch"></script> -->

    <!-- SlimScroll -->
    <!-- <script defer src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.min.js"></script> -->

    <!-- DataTables -->
    <script defer src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
    <script defer src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>

    <!-- FastClick -->
    <script defer src="<?php echo base_url(); ?>assets/js/fastclick.js"></script>

    <!-- AdminLTE App -->
    <script defer src="<?php echo base_url(); ?>assets/js/adminlte.min.js"></script>

    <!-- JQuery mask -->
    <script defer src="<?php echo base_url(); ?>assets/js/jquery.mask.min.js"></script>

    <!-- Bootstrap Toogle (Option Button)-->
    <script defer src="<?php echo base_url(); ?>assets/js/bootstrap-toggle.min.js"></script>

    <!-- Highcharts-->
    <script defer src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
    <script defer src="<?php echo base_url(); ?>assets/js/exporting.js"></script>

    <!-- jQuery Print -->
    <!-- <script defer src="<?php echo base_url(); ?>assets/js/jquery.print.js"></script> -->

    <!-- Jquery UI js -->
    <!-- <script defer src="<?php echo base_url(); ?>assets/jquery-ui/j}query-ui.js"></script> -->

    <!-- jquery-confirm (http://craftpip.github.io/jquery-confirm/) -->
    <script defer src="<?php echo base_url(); ?>assets/js/jquery-confirm-v3.3.4/jquery-confirm.js"></script>

    <!-- Parse, validate, manipulate, and display dates and times in JavaScript (https://momentjs.com/) -->
    <script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/moment-es.js"></script>

    <!-- DateTime plug-in para DataTables -->
    <!-- Convert date / time source data into one suitable for display -->
    <!-- https://datatables.net/plug-ins/dataRender/datetime -->
    <script defer src="<?php echo base_url(); ?>assets/js/datetime.js"></script>

    <!-- DataTables FixedHeader  https://datatables.net/extensions/fixedheader/ -->
    <script defer src="<?php echo base_url(); ?>assets/js/dataTables.fixedHeader.min.js"></script>

    <!-- Calendario Bootstrap -->
    <script defer src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker-v4.17.47/bootstrap-datetimepicker.min.js"></script>

    <!-- Funciones varias -->
    <script src="<?php echo base_url(); ?>assets/js/hac2803.js"></script>

    <!-- Selectize -->
    <script src="<?php echo base_url(); ?>assets/js/selectize.js"></script>

    <!-- DataTables Export -->
    <!-- 
  <script defer src="<?php echo base_url(); ?>assets/template/datatables-export/js/dataTables.buttons.min.js"></script>
  <script defer src="<?php echo base_url(); ?>assets/template/datatables-export/js/buttons.flash.min.js"></script>
  <script defer src="<?php echo base_url(); ?>assets/template/datatables-export/js/jszip.min.js"></script>
  <script defer src="<?php echo base_url(); ?>assets/template/datatables-export/js/pdfmake.min.js"></script>
  <script defer src="<?php echo base_url(); ?>assets/template/datatables-export/js/vfs_fonts.js"></script>
  <script defer src="<?php echo base_url(); ?>assets/template/datatables-export/js/buttons.html5.min.js"></script>
  <script defer src="<?php echo base_url(); ?>assets/template/datatables-export/js/buttons.print.min.js"></script>
  -->


</head>

<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>M</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Menú</b></span>
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <img src="<?php echo base_url() ?>assets/images/Logo_Punto1_360_Transparente.png" style="margin-top:5px;width:200px;height:42px;border:0;">

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- <img src="<?php echo base_url() ?>assets/template/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
                                <span class="hidden-xs">Usuario: <?php echo $this->session->userdata("usu_nombre") ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <a href="<?php echo base_url(); ?>Administrador/Usuario/cambiar_clave"> Cambiar Clave</a>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </li>
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <a href="<?php echo base_url(); ?>auth/logout"> Cerrar Sesión</a>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>