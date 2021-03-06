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
                            <h3 class="box-title">ADOPCIONES</h3>
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
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div id="mAdopcion" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">DETALLE DE ADOPCIÓN</h4>
                        </div>
                        <div  class="modal-body">
                            <form id="fAdopcion" class="form" role="form">
                                <div class="row text-center">
                                    <img id="imgMascotaFoto" src="img/user1-128x128.jpg" class="img-circle" style="width: 128px; height: 128px">
                                </div>
                                <fieldset class="form-group">
                                    <legend data-toggle="collapse" href="#secMascota" aria-expanded="true" aria-controls="secMascota">Información Básica de la Mascota</legend>
                                    <section id="secMascota" class="collapse in">
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="tbMascotaNombre">Nombre</label>
                                                <input type="text" class="form-control" id="tbMascotaNombre"readonly>
                                                <input type="hidden" id="tbId">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="cbMascotaTipo">Tipo</label>
                                                <input type="text" class="form-control" id="tbMascotaTipo"readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="tbMascotaSexo">sexo</label>
                                                <input type="text" class="form-control" id="tbMascotaSexo"readonly>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="tbMascotaAnio">Año Nacimiento</label>
                                                <input type="text" class="form-control" id="tbMascotaAnio" readonly>
                                            </div>
                                        </div>
                                    </section>
                                </fieldset>
                                <fieldset class="form-group">
                                    <legend data-toggle="collapse" href="#secUsuario" aria-expanded="true" aria-controls="secUsuario">Información Básica del Usuario</legend>
                                    <section id="secUsuario" class="collapse in">
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="tbUsuarioDni">DNI</label>
                                                <input type="text" class="form-control" id="tbUsuarioDni" readonly>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="tbUsuarioNombres">Nombre Completo</label>
                                                <input type="text" class="form-control" id="tbUsuarioNombres" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="tbUsuarioDireccion">Dirección</label>
                                                <input type="text" class="form-control" id="tbUsuarioDireccion" readonly>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="tbUsuarioReferencia">Referencia</label>
                                                <input type="text" class="form-control" id="tbUsuarioReferencia" readonly>
                                            </div>
                                        </div>
                                    </section>
                                </fieldset>
                                <fieldset class="form-group" style="margin-bottom: 0">
                                    <legend>Proceso de Adopción</legend>
                                    <input type="hidden" id="tbhEstado">
                                    <div id="fase1" class="fase">
                                        <b>FASE N° 1</b> : Datos para la Adopción
                                        <button type="button" id="btnFase1Detalle" class="btn btn-success btn-xs pull-right" data-toggle="modal" data-target="#mDetalleFase1">Detalle</button>
                                    </div>
                                    <div id="fase2" class="fase">
                                        <b>FASE N° 2</b> : Test de Adopción
                                        <button type="button" id="btnFase2Detalle" class="btn btn-warning btn-xs pull-right" data-toggle="modal" data-target="#mDetalleFase2">Detalle</button>
                                        <div class="row">
                                            <div class="form-group col-sm-2">
                                                <label for="chbAprobado">Aprobado: </label>
                                                <div>
                                                    <input id="chbAprobado" type="checkbox" checked data-toggle="toggle" data-on="SI" data-off="NO" data-onstyle="success" data-offstyle="danger">
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-10">
                                                <label for="tbResultado">Resultado: </label>
                                                <input type="text" class="form-control" id="tbResultado">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="fase3" class="fase">
                                        <b>FASE N° 3</b> : Fecha de Visita
<!--                                        <button type="button" class="btn btn-info btn-xs pull-right">Detalle</button>-->
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="tbFecha">Fecha: </label>
                                                <div class="input-group date">
                                                    <input id="tbFecha" class="form-control pull-right" type="text" name="fecha">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="tbHora">Hora: </label>
                                                <div class="input-group">
                                                    <input id="tbHora" class="form-control timepicker" type="text" name="hora">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-clock-o"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for="tbDescripcion">Descripcion: </label>
                                                <input type="text" class="form-control" id="tbDescripcion" name="descripcion">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-default" data-dismiss="modal" tabindex="-1">Cancelar</button>
                            <button type="button" id="btnGuardarAdopcion" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>


            <div id="mDetalleFase1" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">FASE 1 : Información del Usuario</h4>
                        </div>
                        <div  class="modal-body">
                            <form id="fDetalleFase1" class="form" role="form">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="tbUsuarioDni_fase1">DNI</label>
                                        <input type="text" class="form-control" id="tbUsuarioDni_fase1" readonly>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tbUsuarioNombres_fase1">Nombre Completo</label>
                                        <input type="text" class="form-control" id="tbUsuarioNombres_fase1" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="tbUsuarioTelefonoFijo_fase1">Telefono Fijo</label>
                                        <input type="text" class="form-control" id="tbUsuarioTelefonoFijo_fase1" readonly>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tbUsuarioTelefonoCelular_fase1">Telefono Celular</label>
                                        <input type="text" class="form-control" id="tbUsuarioTelefonoCelular_fase1" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="tbUsuarioOcupacion_fase1">Ocupacion</label>
                                        <input type="text" class="form-control" id="tbUsuarioOcupacion_fase1" readonly>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tbUsuarioCiudad_fase1">Ciudad</label>
                                        <input type="text" class="form-control" id="tbUsuarioCiudad_fase1" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="tbUsuarioDias_fase1">Dias</label>
                                        <input type="text" class="form-control" id="tbUsuarioDias_fase1" readonly>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tbUsuarioHoras_fase1">Horas</label>
                                        <input type="text" class="form-control" id="tbUsuarioHoras_fase1" readonly>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-default" data-dismiss="modal" tabindex="-1">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="mDetalleFase2" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">FASE 2 : Información del Test</h4>
                        </div>
                        <div  class="modal-body">
                            <form id="fDetalleFase2" class="form" role="form">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="tbPregunta1">Pregunta 1</label>
                                        <input type="text" class="form-control" id="tbPregunta1" readonly>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tbPregunta2">Pregunta 2</label>
                                        <input type="text" class="form-control" id="tbPregunta2" readonly>
                                        <input id="chbPregunta21" type="checkbox" checked data-toggle="toggle" data-on="SI" data-off="NO" data-onstyle="success" data-offstyle="danger">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="tbPregunta3">Pregunta 3</label>
                                        <input type="text" class="form-control" id="tbPregunta3" readonly>
                                        <input id="chbPregunta31" type="checkbox" checked data-toggle="toggle" data-on="SI" data-off="NO" data-onstyle="success" data-offstyle="danger">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tbPregunta4">Pregunta 4</label>
                                        <input type="text" class="form-control" id="tbPregunta4" readonly>
                                        <input id="chbPregunta41" type="checkbox" checked data-toggle="toggle" data-on="SI" data-off="NO" data-onstyle="success" data-offstyle="danger">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="chbPregunta51">Pregunta 5</label>
                                        <input id="chbPregunta51" type="checkbox" checked data-toggle="toggle" data-on="SI" data-off="NO" data-onstyle="success" data-offstyle="danger">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tbPregunta6">Pregunta 6</label>
                                        <input type="text" class="form-control" id="tbPregunta6" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="tbPregunta7">Pregunta 7</label>
                                        <input type="text" class="form-control" id="tbPregunta7" readonly>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tbPregunta8">Pregunta 8</label>
                                        <input type="text" class="form-control" id="tbPregunta8" readonly>
                                        <input id="chbPregunta81" type="checkbox" checked data-toggle="toggle" data-on="SI" data-off="NO" data-onstyle="success" data-offstyle="danger">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="tbPregunta9">Pregunta 9</label>
                                        <input type="text" class="form-control" id="tbPregunta9" readonly>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tbPregunta10">Pregunta 10</label>
                                        <input type="text" class="form-control" id="tbPregunta10" readonly>
                                        <input type="text" class="form-control" id="tbPregunta101" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12" style="margin-bottom: 0px;">
                                        <label>11. Señale los cuidados que usted y su familia estarían dispuestos a darle al adoptado:</label>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label></label>
                                        <ul class="list-group">
                                            <li class="list-group-item"><span class="badge" id="r11_1">no</span>Visitas al Veterinario</li>
                                            <li class="list-group-item"><span class="badge" id="r11_2">no</span>Paseos con Correa</li>
                                            <li class="list-group-item"><span class="badge" id="r11_3">no</span>Vacunación</li>
                                            <li class="list-group-item"><span class="badge" id="r11_4">no</span>Dosis antipulgas</li>
                                            <li class="list-group-item"><span class="badge" id="r11_5">no</span>Plato con agual impia todos los dias</li>
                                        </ul>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label></label>
                                        <ul class="list-group">
                                            <li class="list-group-item"><span class="badge" id="r11_6">no</span>Alimentación</li>
                                            <li class="list-group-item"><span class="badge" id="r11_7">no</span>Desparacitación</li>
                                            <li class="list-group-item"><span class="badge" id="r11_8">no</span>Limpieza diaria de arenero</li>
                                            <li class="list-group-item"><span class="badge" id="r11_9">no</span>Corte de pelo</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="tbPregunta12">Pregunta 12</label>
                                        <input type="text" class="form-control" id="tbPregunta12" readonly>
                                        <input id="chbPregunta121" type="checkbox" checked data-toggle="toggle" data-on="SI" data-off="NO" data-onstyle="success" data-offstyle="danger">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-default" data-dismiss="modal" tabindex="-1">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>




            <?php include_once("sis_pie.php"); ?>

        </div>
        <?php include_once("./sis_js.php"); ?>
        <script type="text/javascript" src="js/adopciones.js"></script>

    </body>
</html>
