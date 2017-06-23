<?php include_once("validar.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Salvando Vidas</title>
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
                            <h3 class="box-title">
                                <a href="denuncias.php">DENUNCIAS</a> &nbsp;
                                <i class="fa fa-angle-right text-gray"></i>&nbsp; <?php echo $_GET["t"] ?></h3>
                            <input type="hidden" id="tbhTipo" value="<?php echo $_GET["t"] ?>">
                        </div>
                        <div class="box-body">
                            <div class="container-fluid">
                                <div class="row listado"></div> 
                            </div>
                        </div>
                        
                        <div id="plantillaD" style="display:none">
                            <div class="col-sm-4 col-md-3" >
                                <div class="thumbnail">
                                    <img src="img/denuncia_maltrato.jpg" width="100%"  style="height: 200px" class="foto">
                                    <div class="caption">
                                        <h4 class="titulo">Maltratos</h4>
                                        <p><span class="estado">Nuevo</span><span class="fecha pull-right">12/05/2017</span></p>
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
        <script type="text/javascript" src="js/denuncias_lista.js"></script>

    </body>
</html>
