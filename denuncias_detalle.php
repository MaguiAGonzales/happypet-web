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
                                <i class="fa fa-angle-right text-gray"></i> &nbsp;
                                <a href="denuncias_lista.php?t=<?php echo $_GET["t"] ?>"><?php echo $_GET["t"] ?></a> &nbsp;
                                <i class="fa fa-angle-right text-gray"></i> &nbsp;
                                DETALLE DE DENUNCIA</h3>
                        </div>
                        <div class="box-body">
                            <div class="container-fluid">
                                <div class="detalleDenuncia">
                                    <div class="text-center">
                                        <img id="imgFoto" class="img-bordered-sm" src="" width="300">
                                    </div>
                                    
                                    
                                    <form id="fDenuncia" class="form" role="form">
                                        
                                        <fieldset class="form-group">
                                            <legend>Información Básica</legend>
                                            <div class="form-group">
                                                <label for="tbTitulo">Titulo</label>
                                                <input type="text" class="form-control" id="tbTitulo" name="titulo" autofocus>
                                                <input type="hidden" id="tbId" value="<?php echo $_REQUEST["id"] ?>">
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-6  has-feedback"">
                                                    <label for="tbFecha">Fecha</label>
                                                    <input type="text" class="form-control" id="tbFecha" name="fecha">
                                                    <span class="glyphicon glyphicon-calendar form-control-feedback" style="margin-right: 10px;"></span>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="cbTipo">Tipo</label>
                                                    <select id="cbTipo" name="tipo" class="form-control">
                                                        <option>MALTRATOS</option>
                                                        <option>ACCIDENTES</option>
                                                        <option>OTROS</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tbDescripcion">Descripción</label>
                                                <textarea id="tbDescripcion" rows="2" class="form-control" name="descripcion"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="tbDescripcion">Activar</label>
                                                <div>
                                                    <label class="radio-inline">
                                                        <input id="dbSi" type="radio" name="visible" value="1"> SI
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input id="dbNo" type="radio" name="visible" value="0"> NO
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <legend>Información del Usuario</legend>
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label for="tbDni">DNI</label>
                                                    <input type="text" class="form-control" id="tbDni" readonly>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="tbNombres">Nombre Completo</label>
                                                    <input type="text" class="form-control" id="tbNombres" readonly>
                                                </div>                                                
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label for="tbDireccion">Dirección</label>
                                                    <input type="text" class="form-control" id="tbDireccion" readonly>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="tbReferencia">Referencia</label>
                                                    <input type="text" class="form-control" id="tbReferencia" readonly>
                                                </div>                                                
                                            </div>
                                            <div class="row">                                                
                                                <div class="form-group col-sm-6">                                                    
                                                    <label for="tbTelefono">Teléfono</label>
                                                    <input type="text" class="form-control" id="tbTelefono" readonly>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="tbCorreo" >Correo Electónico</label>
                                                    <input type="text" class="form-control" id="tbCorreo" readonly>
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
        <script type="text/javascript" src="js/denuncias_detalle.js"></script>

    </body>
</html>
