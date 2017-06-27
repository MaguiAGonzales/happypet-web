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
                                <div class="row listado"></div> 
                            </div>
                        </div>
                    </div>
                </section>
            </div>


            <?php include_once("sis_pie.php"); ?>

        </div>
        <?php include_once("./sis_js.php"); ?>
        <!--<script type="text/javascript" src="js/adopciones.js"></script>-->

    </body>
</html>
