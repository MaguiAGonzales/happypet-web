<?php include_once("validar.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Adopciones</title>
        <?php include_once("./sis_css.php"); ?>
        <style type="text/css">
            #fAdopcion legend{
                cursor: pointer;
            }
            .text-centrado{
                vertical-align: middle !important;
                text-align: center;
            }
            .fase{
                border: 1px solid #CCC;
                margin-bottom: 5px;
                padding: 10px;
                font-size: 1.2em;
            }
            .fase-llena{
                background-color: #fffddd;
                border: 1px solid #ffe27c;
            }
            .fase label{
                font-size: .8em !important;
                font-weight: normal;
                margin-bottom: 0;
            }
            .fase .form-group{
                margin-bottom: 0;
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
                            <h3 class="box-title">VISITAS MENSUALES</h3>
                        </div>
                        <div class="box-body">
                            <div class="container-fluid">
                                <table id="dtAdopcion" class="table table-condensed table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px">N°</th>
                                            <th style="width: 100px">Foto</th>
                                            <th>Nombre</th>
                                            <th>Usuario</th>
                                            <th>Fecha Registro</th>
                                            <th>Visitas</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div id="mAVisita" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document" style="width:95%">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">CALENDARIO DE VISITAS MENSUALES</h4>
                            <input type="text" id="idMascota" style="display: none;">
                        </div>
                        <div  class="modal-body">
                            <form id="fAdopcion" class="form" role="form">
                                <div class="row text-center">
                                    <img id="imgMascotaFoto" src="img/user1-128x128.jpg" class="img-circle" style="width: 128px; height: 128px">
                                    <h1 id="h1NombreMascota">Ojitos</h1>
                                </div>
                            </form>
                        </div>
                        <div style="float: right; margin-right: 30px">
                            <button class="btn btn-default" data-toggle="modal" data-target="#mAgregarVisita">Agregar</button>
                        </div>
                        <table id="table-visitas" class="table table-condensed table-bordered table-striped table-hover" style="background-color: #fff; border-bottom-color: f0f0f0;">
                            <thead>
                            <tr>
                                <th class="text-center">Voluntario: </th>
                                <th class="text-center">Persona que atendi&oacute;: </th>
                                <th class="text-center">Parentesco: </th>
<!--                                <th class="text-center">Pregunta 1: </th>-->
                                <th class="text-center">Respuesta 1: </th>
<!--                                <th class="text-center">Pregunta 2: </th>-->
                                <th class="text-center">Respuesta 2: </th>
<!--                                <th class="text-center">Pregunta 3: </th>-->
                                <th class="text-center">Respuesta 3: </th>
<!--                                <th class="text-center">Pregunta 4: </th>-->
                                <th class="text-center">Respuesta 4: </th>
                                <th class="text-center">Veterinaria: </th>
                                <th class="text-center">Fecha esterilizaci&oacute;n: </th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-default" data-dismiss="modal" tabindex="-1">Cancelar</button>
                            <button type="button" id="btnGuardarAdopcion" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="mAgregarVisita" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document" enctype="multipart/form-data" style="width:80 j %">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Programar nueva visita</h4>
                        </div>
                        <div  class="modal-body">
                            <form id="fAgregarVisita" class="form" role="form">
                                <input type="text" id="tbId" style="display: none;">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="tbVoluntario">Voluntario</label>
                                        <input type="text" class="form-control" id="tbVoluntario">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tbPersona_atiende">Persona que atiende</label>
                                        <input type="text" class="form-control" id="tbPersona_atiende">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="tbParentesco">Parentesco</label>
                                        <input type="text" class="form-control" id="tbParentesco">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tbCelular">Celular</label>
                                        <input type="text" class="form-control" id="tbCelular">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="tbPregunta1">Pregunta 1</label>
                                        <textarea rows="3" class="form-control" id="tbPregunta1" readonly>¿La mascota ya est&aacute; vacunada? Si no lo est&aacute; ¿por qu&eacute;?</textarea>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tbRespuesta1">Respuesta 1</label>
                                        <textarea rows="3" class="form-control" id="tbRespuesta1">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="tbPregunta2">Pregunta 2</label>
                                        <textarea rows="3" class="form-control" id="tbPregunta2" readonly>¿La mascota ya está desparacitada? Si no lo está ¿por qué?
                                        </textarea>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tbRespuesta2">Respuesta 1</label>
                                        <textarea rows="3" class="form-control" id="tbRespuesta2">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="tbPregunta3">Pregunta 3</label>
                                        <textarea rows="3" class="form-control" id="tbPregunta3" readonly>Descripci&oacute;n del estado de la mascota, ¿es adecuado?</textarea>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tbRespuesta3">Respuesta 1</label>
                                        <textarea rows="3" class="form-control" id="tbRespuesta3">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="tbPregunta4">Pregunta 4</label>
                                        <textarea rows="3" class="form-control" id="tbPregunta4" readonly>Descripci&oacute;n de las condiciones del ambiente donde la mascota vive, ¿es adecuado?</textarea>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tbRespuesta4">Respuesta 1</label>
                                        <textarea rows="3" class="form-control" id="tbRespuesta4">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="tbVeterinaria">Veterinaria</label>
                                        <input type="text" class="form-control" id="tbVeterinaria">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tbFecha_esterilizacion">Fecha Esterilizaci&oacute;n</label>
                                        <input type="text" class="form-control" id="tbFecha_esterilizacion">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-default" data-dismiss="modal" tabindex="-1">Cancelar</button>
                            <button type="button" id="btnGuardarVisita" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php include_once("sis_pie.php"); ?>

        </div>
        <?php include_once("./sis_js.php"); ?>
        <script type="text/javascript" src="js/visitas_mensuales.js"></script>

    </body>
</html>
