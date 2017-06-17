<?php include_once("validar.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mis Mascotas ! SV</title>
        <?php include_once("./sis_css.php"); ?>
        <style type="text/css">
            .btn-agregar{
                color: #FFF !important;
            }
            .btn-refrescar{
                margin-right: 6px;
                font-size: .8em !important;
                padding: 3px 5px 2px 5px;
            }
            .btnSeparated {
                margin-right: 5px;
            }
            .dt-btn {
                cursor: pointer;
                opacity: 0.4;
            }
            .dt-btn:hover {
                opacity: 1;
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
                            <h3 class="box-title">Mis Mascotas</h3>
                        </div>
                        <div class="box-body">
                            <div class="container-fluid">
                                <table id="dtMascotas" class="table table-condensed table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th style="width: 115px">Foto</th>
                                            <th>Nombre</th>
                                            <th>Tipo</th>
                                            <th>Sexo</th>
                                            <th>Año Nac.</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        
        <div id="mMascota" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form id="fMascota" class="form-horizontal">                            
                            <div class="form-group">
                                <label for="tbNombre" class="col-sm-3 control-label">Nombre</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="tbNombre" name="nombre" maxlength="50" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rbSexo" class="col-sm-3 control-label">Sexo</label>
                                <div class="col-sm-9">
                                    <label class="radio-inline" for="rbMasculino">
                                        <input type="radio" id="rbMasculino" name="sexo" value="M" checked="checked"> Macho
                                    </label>
                                    <label class="radio-inline" for="rbFemenino">
                                        <input type="radio" id="rbFemenino" name="sexo" value="F"> Hembra
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tbParticularidades" class="col-sm-3 control-label">Particularidades</label>
                                <div class="col-sm-9">
                                    <input type="text" id="tbParticularidades" name="particularidades" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tbEstado" class="col-sm-3 control-label">Estado</label>
                                <div class="col-sm-9">
                                    <input type="text" id="tbEstado" name="estado" class="form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-xs-6 text-left">
                                <button type="reset" class="btn btn-default" data-dismiss="modal" tabindex="-1">Cancelar</button>
                            </div>
                            <div class="col-xs-6">
                                <button type="button" id="btnGuardarMascota" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php include_once("sis_pie.php"); ?>
        <?php include_once("sis_js.php"); ?>
        
        <script type="text/javascript" src="js/mismascotas.js"></script>
        
    </body>
</html>
