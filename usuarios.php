<?php include_once("validar.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Usuarios | SV</title>
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
                            <h3 class="box-title">Usuarios</h3>
                        </div>
                        <div class="box-body">
                            <div class="container-fluid">
                                <table id="dtMascotas" class="table table-condensed table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th style="width: 115px">Foto</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Correo</th>
                                            <th>Celular</th>
                                            <th>Direcci&oacute;n</th>
                                            <th>Rol</th>
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

        <input type="hidden" id="tbIdUsuario" value="<?php echo $_SESSION["id"] ?>">
        
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
                                    <input type="hidden" id="tbId" value="0">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="tbNombre">Apellidos</label>
                                    <input type="text" class="form-control" id="tbApellidos" name="apellidos" autofocus>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="tbAnio">Ciudad</label>
                                    <input type="text" class="form-control" id="tbCiudad" name="ciudad">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="tbAnio">Correo</label>
                                    <input type="text" class="form-control" id="tbCorreo" name="correo">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="tbAnio">Celular</label>
                                    <input type="text" class="form-control" id="tbCelular" name="celular">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="tbAnio">DNI</label>
                                    <input type="text" class="form-control" id="tbDni" name="dni">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="tbAnio">Ocupacion</label>
                                    <input type="text" class="form-control" id="tbOcupacion" name="ocupacion">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="tbAnio">Fecha de Nacimiento</label>
                                    <input type="text" class="form-control" id="tbFecha_nacimiento" name="fecha_nacimiento">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="tbAnio">Telefono</label>
                                    <input type="text" class="form-control" id="tbTelefono" name="telefono">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="tbAnio">Direccion</label>
                                    <input type="text" class="form-control" id="tbDireccion" name="direccion">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="tbAnio">Referencia</label>
                                    <input type="text" class="form-control" id="tbReferencia" name="referencia">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="tbAnio">Contrase&ntilde;ia</label>
                                    <input type="password" class="form-control" id="tbContrasenia" name="contrasenia">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="tbAnio">Rol</label>
                                    <div class="id_rol">

                                    <select class="selectpicker form-control" id="tbRol" name="Rol">
                                        <option value="1">Administrador</option>
                                        <option value="0">Usuario</option>
                                    </select>
                                </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default" data-dismiss="modal" tabindex="-1">Cancelar</button>
                        <button type="button" id="btnGuardarUsuario" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        
        <?php include_once("sis_pie.php"); ?>
        <?php include_once("sis_js.php"); ?>
        
        <script type="text/javascript" src="js/fileinput.min.js"></script>
        <script type="text/javascript" src="js/mini-lightbox.min.js"></script>
        <script type="text/javascript" src="js/usuario.js"></script>
        
    </body>
</html>
