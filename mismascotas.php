<?php include_once("validar.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mis Mascotas ! SV</title>
        <?php include_once("./sis_css.php"); ?>
        <link rel="stylesheet" href="css/fileinput.min.css">
        <link rel="stylesheet" href="css/lightbox.min.css">
        <style>
            .kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
                margin: 0;
                padding: 0;
                border: none;
                box-shadow: none;
                text-align: center;
            }
            .kv-avatar .file-input {
                display: table-cell;
                max-width: 200px;
            }
            .kv-reqd {
                color: red;
                font-family: monospace;
                font-weight: normal;
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div  class="modal-body">
                        <form id="fMascota" class="form" role="form" enctype="multipart/form-data">
                            <div class="kv-avatar center-block text-center" style="width:120px; padding-bottom: 10px;">
                                <input id="avatar-1" type="file" class="file-loading" required>
                                <input type="hidden" id="img64">
                            </div>  
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="tbNombre">Nombre</label>
                                    <input type="text" class="form-control" id="tbNombre" name="nombre" autofocus>
                                    <input type="hidden" id="tbId">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="cbTipo">Tipo</label>
                                    <select id="cbTipo" name="tipo" class="form-control">
                                        <option>Perro</option>
                                        <option>Gato</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="cbSexo">sexo</label>
                                    <select id="cbSexo" name="sexo" class="form-control">
                                        <option>Hembra</option>
                                        <option>Macho</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="tbAnio">Año Nacimiento</label>
                                    <input type="text" class="form-control" id="tbAnio" name="anio">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tbParticularidades">Particularidades</label>
                                <input type="text" class="form-control" id="tbParticularidades" name="particularidades">
                            </div>
                            <div class="form-group">
                                <label for="tbSalud">Salud</label>
                                <input type="text" class="form-control" id="tbSalud" name="salud">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default" data-dismiss="modal" tabindex="-1">Cancelar</button>
                        <button type="button" id="btnGuardarMascota" class="btn btn-primary">Guardar</button>                         
                    </div>
                </div>
            </div>
        </div>
        
        <?php include_once("sis_pie.php"); ?>
        <?php include_once("sis_js.php"); ?>
        
        <script type="text/javascript" src="js/fileinput.min.js"></script>
        <script type="text/javascript" src="js/mini-lightbox.min.js"></script>
        <script type="text/javascript" src="js/mismascotas.js"></script>
        
    </body>
</html>
