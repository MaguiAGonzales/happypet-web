<?php include_once("validar.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Eventos</title>
        <?php include_once("./sis_css.php"); ?>
        <style type="text/css">
            .listado .well:hover{
                background-color: #FFF;
                cursor: pointer;
            }
            .listado .well .text-right{
                font-size: 1em;
            }
            .listado .well .text-muted{
                font-size: .85em;
            }
            .listado .well p{
                 font-size: 1.1em;
             }
            .listado .well h4{
                 margin-top: 0;
                font-size: 1.5em;
             }
        </style>
    </head>
    <body class="hold-transition skin-blue-light fixed sidebar-mini">
        <div class="wrapper">            
            <?php include_once("./sis_menu.php"); ?>
            
            <div class="content-wrapper">                
                <section class="content">               
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">EVENTOS</h3>
                        </div>
                        <div class="box-body">
                            <div class="container-fluid">
                                <div class="row" style="margin-bottom: 15px">
                                    <div class="col-xs-12">
                                        <a class="btn btn-primary" href="eventos_detalle.php" role="button">
                                            <span class='glyphicon glyphicon-plus'></span> Nuevo Evento</a>
                                    </div>
                                </div>
                                <div class="row listado"></div>
                            </div>
                        </div>
                        
                        <div id="plantilla" style="display:none">
                            <div class="col-sm-6 col-md-4" >
                                <div class="well" cod="0">
                                    <h4 class="text-primary titulo">Campaña de Adopción</h4>
                                    <p>
                                        <span class="text-muted">Lugar :</span> <span class="lugar">Plazuela La Recoleta</span>
                                    </p>
                                    <div class="text-right">
                                        <span class="text-muted">Fecha :</span> <span class="fecha">28/06/2017</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-muted">Hora :</span> <span class="hora">10:30 a.m.</span>
                                    </div>
                                    <div class="shareFb">

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
        <script type="text/javascript" src="js/eventos.js"></script>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.10&appId=708232555880412";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
    </body>
</html>
