<?php include_once("validar.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Detalle Evento</title>
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
                                <a href="eventos.php">EVENTO</a> &nbsp;
                                <i class="fa fa-angle-right text-gray"></i> &nbsp;
                                DETALLE DE EVENTO</h3>
                        </div>
                        <div class="box-body">
                            <div class="container-fluid">
                                <div class="detalleEvento">
                                    <form id="fEvento" class="form" role="form">
                                        
                                        <fieldset class="form-group">
                                            <legend>Información del Evento</legend>
                                            <div class="form-group">
                                                <label for="tbTitulo">Nombre</label>
                                                <input type="text" class="form-control" id="tbTitulo" name="titulo" autofocus>
                                                <input type="hidden" id="tbId" name="id" value="<?php  echo isset($_REQUEST["id"]) ? $_REQUEST["id"] : "" ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="tbDescripcion">Descripción</label>
                                                <textarea id="tbDescripcion" rows="2" class="form-control" name="descripcion"></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-6 has-feedback"">
                                                    <label for="tbFecha">Fecha</label>
                                                    <input type="text" class="form-control" id="tbFecha" name="fecha">
                                                    <span class="glyphicon glyphicon-calendar form-control-feedback" style="margin-right: 10px;"></span>
                                                </div>
                                                <div class="form-group col-sm-6 has-feedback"">
                                                    <label for="tbHora">Hora</label>
                                                    <input type="text" class="form-control" id="tbHora" name="hora">
                                                    <span class="glyphicon glyphicon-clock-o form-control-feedback" style="margin-right: 10px;"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tbLugar">Lugar</label>
                                                <input type="text" class="form-control" id="tbLugar" name="lugar">
                                            </div>
                                            <div class="form-group">
                                                <label for="tbReferencia">Referencia</label>
                                                <input type="text" class="form-control" id="tbReferencia" name="referencia">
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 text-center">
                                                    <a class="btn btn-default" href="eventos.php" role="button">Cancelar</a> &nbsp; &nbsp;
                                                    <button type="button" class="btn btn-primary" id="btnGuardar">Actualizar</button>
                                                </div>
                                            </div>
                                        </fieldset>

                                    </form>                              
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


            <?php include_once("sis_pie.php"); ?>

        </div>
        <?php include_once("./sis_js.php"); ?>
        <script type="text/javascript" src="js/evento_detalle.js"></script>

    </body>
</html>
