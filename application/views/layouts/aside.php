        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <!-- <li class="header">Menú</li> -->
                    <li>
                        <a href="<?php echo base_url(); ?>dashboard">
                            <i class="fa fa-home"></i> <span>Inicio</span>
                        </a>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-share-alt"></i> <span>Movimientos</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url(); ?>Movimientos/Ventas/add"><i class="fa fa-circle-o"></i> Ventas</a></li>
                            <li><a href="<?php echo base_url(); ?>Movimientos/Ventas/deudores"><i class="fa fa-circle-o"></i> Cuenta Corriente</a></li>
                            <li><a href="<?php echo base_url(); ?>Movimientos/Stock/ingreso"><i class="fa fa-circle-o"></i> Ingresos de Stock</a></li>
                            <li><a href="<?php echo base_url(); ?>Movimientos/Stock/ajuste"><i class="fa fa-circle-o"></i> Ajustes de Stock</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-print"></i> <span>Consultas</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url(); ?>Consultas/Ventas"><i class="fa fa-circle-o"></i> Ventas</a></li>
                            <li><a href="<?php echo base_url(); ?>Consultas/Valor"><i class="fa fa-circle-o"></i> Valores</a></li>
                            <li><a href="<?php echo base_url(); ?>Consultas/Stock"><i class="fa fa-circle-o"></i> Stock</a></li>
                            <li><a href="<?php echo base_url(); ?>Consultas/Stock/movimientos"><i class="fa fa-circle-o"></i> Movimientos de Stock</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-cogs"></i> <span>Mantenimiento</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url(); ?>Mantenimiento/Cliente"><i class="fa fa-circle-o"></i> Clientes</a></li>
                            <li><a href="<?php echo base_url(); ?>Mantenimiento/Articulo"><i class="fa fa-circle-o"></i> Artículos</a></li>
                            <li><a href="<?php echo base_url(); ?>Mantenimiento/Color"><i class="fa fa-circle-o"></i> Colores</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-user-circle-o"></i> <span>Administrador</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url(); ?>Administrador/Usuario"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                            <li><a href="<?php echo base_url(); ?>Administrador/Permiso"><i class="fa fa-circle-o"></i> Permisos</a></li>
                        </ul>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->