<?php include_once("validar.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Denuncias</title>
        <?php include_once("./sis_css.php"); ?>
        <style type="text/css">
            
        </style>
    </head>
    <body class="hold-transition skin-blue-light fixed sidebar-mini">
        <div class="wrapper">            
            <?php include_once("./sis_menu.php"); ?>
            
            <div class="content-wrapper">                
                <section class="content">               
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">DENUNCIAS</h3>
                        </div>
                        <div class="box-body">
                            <div class="container-fluid">
                                <div class="row tipo-denuncias">
                                    <div class="col-sm-6 col-md-4">
                                        <div class="thumbnail">
                                            <img src="img/denuncia_accidente.jpg" width="100%" tipo="ACCIDENTES">
                                            <div class="caption">
                                                <h3>
                                                    Accidentes <span id="totalAccidentes" class="label label-danger pull-right">02</span>
                                                </h3>                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="thumbnail">
                                            <img src="img/denuncia_maltrato.jpg" width="100%" tipo="MALTRATOS">
                                            <div class="caption">
                                                <h3>
                                                    Maltratos <span id="totalMaltratos" class="label label-warning pull-right">04</span>
                                                </h3>                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="thumbnail">
                                            <img src="img/denuncia_otro.jpg" width="100%" tipo="OTROS">
                                            <div class="caption">
                                                <h3>
                                                    Otros <span id="totalOtros" class="label label-info pull-right">01</span>
                                                </h3>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


            <?php include_once("sis_pie.php"); ?>

        </div>
        <?php include_once("./sis_js.php"); ?>
        <script type="text/javascript" src="js/denuncias.js"></script>

    </body>
</html>
