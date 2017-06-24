<?php include_once("validar.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Adopciones</title>
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
                            <h3 class="box-title">ADOPCIONES</h3>
                            <!--<input type="hidden" id="tbhTipo" value="<?php echo $_GET["t"] ?>">-->
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
                            <h4 class="modal-title"></h4>
                        </div>
                        <div  class="modal-body">
                            <form id="fAdopcion" class="form" role="form">
                                <div class="row text-center">
                                    <img src="img/user1-128x128.jpg" class="img-circle">
                                </div>
                                <fieldset class="form-group">
                                    <legend data-toggle="collapse" href="#secMascota" aria-expanded="true" aria-controls="secMascota">Información Básica de la Mascota</legend>
                                    <section id="secMascota" class="collapse in">
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="tbNombre">Nombre</label>
                                                <input type="text" class="form-control" id="tbNombre" name="nombre" readonly>
                                                <input type="hidden" id="tbId">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="cbTipo">Tipo</label>
                                                <select id="cbTipo" name="tipo" class="form-control" readonly="">
                                                    <option>Perro</option>
                                                    <option>Gato</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="cbSexo">sexo</label>
                                                <select id="cbSexo" name="sexo" class="form-control" readonly="">
                                                    <option>Hembra</option>
                                                    <option>Macho</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="tbAnio">Año Nacimiento</label>
                                                <input type="text" class="form-control" id="tbAnio" name="anio" readonly>
                                            </div>
                                        </div>
                                    </section>
                                </fieldset>
                                <fieldset class="form-group">
                                    <legend data-toggle="collapse" href="#secUsuario" aria-expanded="true" aria-controls="secUsuario">Información Básica del Usuario</legend>
                                    <section id="secUsuario" class="collapse in">
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
                                    </section>

                                </fieldset>
                                <fieldset class="form-group">
                                    <legend>Proceso de Adopción</legend>
                                </fieldset>
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

        </div>
        <?php include_once("./sis_js.php"); ?>
        <script type="text/javascript" src="js/adopciones.js"></script>

    </body>
</html>
