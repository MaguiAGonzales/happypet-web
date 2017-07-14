<header class="main-header">
                <!-- Logo -->
                <a href="index.php" class="logo">
                    <span class="logo-mini">S<b>V</b></span>
                    <span class="logo-lg">salvando<b>Vidas</b></span>
                </a>
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src=" <?php echo "data:image/jpeg;base64," . $_SESSION["foto"]; ?>" class="user-image" >
                                    <span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo "data:image/jpeg;base64," . $_SESSION["foto"] ?>" class="img-circle" >
                                        <p>
                                            <?php echo $_SESSION["nombre"] . " " . $_SESSION["apellidos"] ?>
                                            <small><?php echo $_SESSION["ciudad"] ?></small>
                                        </p>
                                    </li>
                                    
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Cambiar Clave</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="logout.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>                           
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- =============================================== -->

            <aside class="main-sidebar">
                <section class="sidebar">
                    <ul class="sidebar-menu" data-widget="tree">                       
                        <li class=""><a href="index.php"><i class="fa fa-home text-blue"></i> <span>Inicio</span></a></li>
                        <li><a href="mismascotas.php"><i class="fa fa-angellist "></i> <span>Mis Mascotas</span></a></li>
                        <li><a href="adopciones.php"><i class="fa fa-heart"></i> <span>Adopciones</span></a></li>
                        <!--<li><a href="notificaciones.php"><i class="fa fa-bell"></i> <span>Notificaciones</span></a></li>-->
                        <li class="treeview active">
                            <a href="#">
                                <i class="fa fa-bullhorn"></i> <span>Alertas</span>
                                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="denuncias.php"><i class="fa fa-legal"></i> <span>Denuncias</span></a></li>
                                <li><a href="extraviados.php"><i class="fa fa-exclamation-triangle"></i> <span>Extraviados</span></a></li>
                                <li><a href="encontrados.php"><i class="fa fa-eye"></i> <span>Encontrados</span></a></li>
                            </ul>
                        </li>                                                
                        <li><a href="eventos.php"><i class="fa fa-calendar"></i> <span>Eventos</span></a></li>
                    </ul>
                </section>
            </aside>

            <!-- =============================================== -->