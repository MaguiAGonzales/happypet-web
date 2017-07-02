<?php include_once("validar.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Extraviados</title>
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
                            <h3 class="box-title">EXTRAVIADOS</h3>
                        </div>
                        <div class="box-body">
                            <div class="container-fluid">
                                <div class="row listadoEx"></div>
                            </div>
                        </div>
                        
                        <div id="plantilla" style="display:none">
                            <div class="col-sm-4 col-md-3" >
                                <div class="thumbnail">
                                    <img src="img/denuncia_maltrato.jpg" width="100%"  style="height: 200px" class="foto">
                                    <div class="caption">
                                        <h4 class="text-center titulo">Se Busca</h4>
                                        <p><span class="label label-danger estado">Se Busca</span><span class="fecha pull-right">12/05/2017</span></p>
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
        <script type="text/javascript" src="js/extraviados.js"></script>

    </body>
</html>
