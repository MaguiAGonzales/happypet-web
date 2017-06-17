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
                                    <img src="<?php echo $_SESSION["foto"] ?>" class="user-image" >
                                    <span class="hidden-xs">ikarina</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo $_SESSION["foto"] ?>" class="img-circle" >
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
                        
                        <li class="active"><a href="index.php"><i class="fa fa-home text-blue"></i> <span>Inicio</span></a></li>
                        <li><a href="mismascotas.php"><i class="fa fa-angellist "></i> <span>Mis Mascotas</span></a></li>
                        <li><a href="adopciones.php"><i class="fa fa-heart"></i> <span>Adopciones</span></a></li>
                        <li><a href="notificaciones.php"><i class="fa fa-bell"></i> <span>Alertas</span></a></li>
                        <li><a href="denuncias.php"><i class="fa fa-legal"></i> <span>Denuncias</span></a></li>
                        <li><a href="perdidas.pgp"><i class="fa fa-ban"></i> <span>Extraviados</span></a></li>
                        <li><a href="perdidas.pgp"><i class="fa fa-calendar"></i> <span>Eventos</span></a></li>
                    </ul>
                </section>
            </aside>

            <!-- =============================================== -->