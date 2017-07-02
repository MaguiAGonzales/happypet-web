<?php include_once("validar.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Salvando Vidas</title>
        <?php include_once("./sis_css.php"); ?>
        <style type="text/css">
            .lista{
                min-height: 65px;
            }
            .lista .foto{
                width: 120px;
                height: 120px;
            }
            .lista .nombre{
                text-transform: capitalize;
            }
        </style>
    </head>
    <body class="hold-transition skin-blue-light fixed sidebar-mini">
        <div class="wrapper">            
            <?php include_once("./sis_menu.php"); ?>

            <div class="content-wrapper">                
                <section class="content">               

                    <div class="row">                       
                        <div class="col-md-12">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Adopciones</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <ul class="users-list clearfix lista listado-adopciones"></ul>
                                </div>
                                <div class="box-footer text-center">
                                    <a href="adopciones.php" class="uppercase">Ver todos</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Extraviados</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <ul class="users-list clearfix lista listado-extraviados"></ul>
                                </div>
                                <div class="box-footer text-center">
                                    <a href="extraviados.php" class="uppercase">Ver todos</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="box box-warning">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Encontrados</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <ul class="users-list clearfix">                                    
                                        <li>
                                            <img src="img/user5-128x128.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">Sarah</a>
                                            <span class="users-list-date">14 Jan</span>
                                        </li>
                                        <li>
                                            <img src="img/user1-128x128.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">Alexander Pierce</a>
                                            <span class="users-list-date">Today</span>
                                        </li>
                                        <li>
                                            <img src="img/user3-128x128.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">Nadia</a>
                                            <span class="users-list-date">15 Jan</span>
                                        </li>
                                    </ul>
                                    <!-- /.users-list -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer text-center">
                                    <a href="javascript:void(0)" class="uppercase">Ver todos</a>
                                </div>
                                <!-- /.box-footer -->
                            </div>
                            <!--/.box -->
                        </div>
                    </div>
                    
                    
<!--                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Título</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            Contenido de la pagina
                        </div>
                         /.box-body 
                    </div>-->

                </section>
            </div>

            <div id="plantilla" style="display: none">
                <li>
                    <img src="" class="foto">
                    <a class="users-list-name nombre" href="#"></a>
                    <span class="users-list-date anio"></span>
                </li>
            </div>

            

            <?php include_once("sis_pie.php"); ?>

        </div>
        <?php include_once("./sis_js.php"); ?>
        <script type="text/javascript" src="js/index.js"></script>


    </body>
</html>
