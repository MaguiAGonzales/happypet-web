$(function () {
    var mAdo = $("#mAVisita");
    var fAdo = $("#fAdopcion");

    var dtAdo = $('#dtAdopcion').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todo"] ],
        ajax:{
            url :"funciones/admin_visitas_mensuales.php?f=1",
            type: "post"
        },
        "dom": "<'row text-sm'<'col-xs-6'B><'col-xs-6 text-right'f>>t<'row text-sm'<'col-xs-6 col-sm-4'<'#tbR'>i><'col-xs-6 col-sm-4 text-center'l><'col-xs-12 col-sm-4 text-right'p>>",
        buttons: [
           
        ],
        columns: [
            { "data": "id_mascota"},
            { "data": "imagen", orderable: false, "render": function(data, type, row) {
                return '<img src="data:image/jpeg;base64,'+data+'" width="90" class="img-bordered-sm" />';
            }},
            { "data": "nombre"},
            { "data": "usuario", className:"hidden-xs"  },
            { "data": "fecha" },
            { "data": "estado", class:"text-centrado", orderable: false, "render": function(data, type, row) {
                estado = data.substr(0, 1);
                fase = "";
                switch(estado) {
                    case "F":
                        clase = "success";
                        etiqueta = "EN PROCESO";
                        subClase = "default";
                        switch (data.substr(1, 1)){
                            case "1":
                                subClase = "success";
                                break;
                            case "2":
                                subClase = "warning";
                                break;
                            case "3":
                                subClase = "info";
                                break;
                        }
                        fase = "<br><span class='label label-" + subClase + "'> Fase " + data.substr(1, 1) + "</span>";
                        break;
                    case "T":
                        clase = "primary";
                        etiqueta = "VER CALENDARIO DE VISITAS";
                        break;
                    case "N":
                        clase = "danger";
                        etiqueta = "NO PASÓ";
                        break;
                }

                return '<button type="button" class="btn btn-'+ clase +' btn-xs dt-btn-estado">' + etiqueta + '</button> '  + fase;
            }},
        ],
        order: [[0, "desc"]]
    });

    $("#tbR").css("display","inline").html('<button type="button" class="btn btn-default btn-sm btn-refrescar" ><span class="glyphicon glyphicon-refresh" id="btnRefrescar"></span>');

    $("#tbR").on('click', '.btn-refrescar', function () {
        dtAdo.ajax.reload(null, false);
    });



    dtAdo.on('click', '.dt-btn-estado', function () {
        var fila = dtAdo.row($(this).parents('tr')).data();

        $("#tbId").val(fila.id);
        $("#idMascota ").val(fila.id_mascota);
        $("#tbhEstado").val(fila.estado);

        $("#imgMascotaFoto").attr("src", "data:image/jpeg;base64," + fila.imagen);
        $("#tbMascotaNombre").val(fila.nombre);
        $("#h1NombreMascota").text(fila.nombre);
        $("#tbMascotaTipo").val(fila.tipo_mascota);
        $("#tbMascotaSexo").val(fila.sexo);
        $("#tbMascotaAnio").val(fila.ano_nacimiento);

        $("#tbUsuarioDni").val(fila.dni);
        $("#tbUsuarioNombres").val(fila.usuario);
        $("#tbUsuarioDireccion").val(fila.direccion);
        $("#tbUsuarioReferencia").val(fila.referencia);

        $("#tbUsuarioDni_fase1").val(fila.dni);
        $("#tbUsuarioNombres_fase1").val(fila.usuario);
        $("#tbUsuarioTelefonoFijo_fase1").val(fila.telefono);
        $("#tbUsuarioTelefonoCelular_fase1").val(fila.celular);
        $("#tbUsuarioOcupacion_fase1").val(fila.ocupacion);
        $("#tbUsuarioCiudad_fase1").val(fila.ciudad);

        $.post("funciones/admin_horario.php", {f: "horario", id: fila.id_horario}, function(d) {
            $("#tbUsuarioDias_fase1").val(d.dias);
            $("#tbUsuarioHoras_fase1").val(d.horas);
        },'json').fail(function() {
            toastr["error"]("Ocurrió un error al traer el Horario");
        });

        $("#tbResultado").val(fila.resultado);

        mAdo.modal('show');
        cargarVisitas();
    });

    mAdo.on('shown.bs.modal', function (e) {
        switch ($("#tbhEstado").val()){
            case "F2":
                $("#tbResultado").focus();
                break;
            case "F3":
                $("#tbFecha").focus();
                break;
        }
    })

    mAdo.on('hidden.bs.modal', function (e) {
        $('#fAdopcion')[0].reset();
        con = $("#fAdopcion").parents(".modal-content");
        con.waitMe('hide');
    })

    $('#chbAprobado').change(function() {
        $("#tbReferencia").prop("readonly", !$(this).prop('checked')).focus().val("");
    })

    $("#btnGuardarAdopcion").on("click",function(){
        con = $("#fAdopcion").parents(".modal-content");

        switch($("#tbhEstado").val()){
            case "F2":
                con.waitMe({ text : 'Guardando Resultado del Test de Adopción...' });

                var data = fAdo.serializeArray();
                data.push({name: 'f', value: "f3" });
                data.push({name: 'ida', value: $("#tbId").val() });
                data.push({name: 'aprobado', value: $("#chbAprobado").prop("checked") });
                data.push({name: 'resultado', value: $("#tbResultado").val() });

                break;
            case "F3":
                con.waitMe({ text : 'Guardando Fecha de Visita de Adopción...' });

                var data = fAdo.serializeArray();
                data.push({name: 'f', value: "visita" });
                data.push({name: 'ida', value: $("#tbId").val() });

                break;
        }

        $.post("funciones/admin_adopcion.php", data, function(d) {
            if (!d.success) {
                toastr["error"](d.msg);
            }else {
                toastr["success"](d.msg);
                mAdo.modal('hide');
                dtAdo.ajax.reload();
            }
            con.waitMe('hide');
        },'json').fail(function() {
            toastr["error"]("Ocurrió un error al guardar. Inténtelo luego");
            con.waitMe('hide');
        });

    });

    $("#btnGuardarVisita").on("click",function(){
        //obtiene la foto

        // para convertir a base 64
        con = $("#fMascota").parents(".modal-content");
        con.waitMe({text: 'Guardando Visita Mensual...'});

        var data = $("#fAgregarVisita").serializeArray();
        data.push({name: 'f', value: $("#tbId").val() == 0 ? "fInsertar" : "fEditar"});
        data.push({name: 'nombre_voluntario', value: $("#tbVoluntario").val()});
        data.push({name: 'nombre_persona_atiende', value: $("#tbPersona_atiende").val()});
        data.push({name: 'parentesco', value: $("#tbParentesco").val()});
        data.push({name: 'telefono', value: $("#tbCelular").val()});
        // data.push({name: 'p1', value: $("#tbPregunta1").val()});
        data.push({name: 'r1', value: $("#tbRespuesta1").val()});
        // data.push({name: 'p2', value: $("#tbPregunta2").val()});
        data.push({name: 'r2', value: $("#tbRespuesta2").val()});
        // data.push({name: 'p3', value: $("#tbPregunta3").val()});
        data.push({name: 'r3', value: $("#tbRespuesta3").val()});
        // data.push({name: 'p4', value: $("#tbPregunta4").val()});
        data.push({name: 'r4', value: $("#tbRespuesta4").val()});
        data.push({name: 'veterinaria', value: $("#tbVeterinaria").val()});
        data.push({name: 'fecha_esterilizacion', value: $("#tbFecha_esterilizacion").val()});
        data.push({name: 'id_mascota', value: $("#idMascota").val()});
        data.push({name: 'id', value: $("#tbId").val()});

        console.log(data);

        $.post("funciones/admin_visitas_mensuales.php", data, function (d) {
            if (!d.success) {
                toastr["error"](d.msg);
            }
            else {
                toastr["success"](d.msg);
                $("#mAgregarVisita").modal('hide');
                cargarVisitas();
            }
            con.waitMe('hide');
        }, 'json');
    });
});

function cargarVisitas(){
    var html = '';
    $.post("funciones/admin_visitas_mensuales.php?f=listarVisitas&id_mascota="+$("#idMascota").val(), function (d) {
        $.each(d, function (index, ele) {
            html += '<tr><td>'+ele.nombre_voluntario+'</td><td>'+ele.nombre_persona_atiende+'</td>'
            html += '<td>'+ele.parentesco+'</td><td>'+ele.p1+'</td><td>'+ele.r1+'</td><td>'+ele.p2+'</td>'
            html += '<td>'+ele.r2+'</td><td>'+ele.p3+'</td><td>'+ele.r3+'</td><td>'+ele.p4+'</td><td>'+ele.r4+'</td>'
            html += '<td>'+ele.veterinaria+'</td><td>'+ele.fecha_esterilizacion+'</td>'
            // html += '<td class=" text-center"><span class="glyphicon glyphicon-pencil dt-btn dt-btn-editar"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span onClick="eliminar('+ele.id+')" class="glyphicon glyphicon-trash dt-btn dt-btn-eliminar"></span></td></tr>'
            html += '<td class=" text-center"><span onClick="editar('+ele.id+')" class="glyphicon glyphicon-pencil dt-btn dt-btn-editar"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span onClick="eliminar('+ele.id+')" class="glyphicon glyphicon-trash dt-btn dt-btn-eliminar"></span></td></tr>'
        });
        $('#table-visitas tbody').html(html);
    }, 'json');
}

function editar(id){
    $.post("funciones/admin_visitas_mensuales.php?f=5&id="+id, function (d) {
        $("#tbVoluntario").val(d.nombre_voluntario);
        $("#tbPersona_atiende").val(d.nombre_persona_atiende);
        $("#tbParentesco").val(d.parentesco);
        $("#tbCelular").val(d.telefono);
        $("#tbPregunta1").val(d.p1);
        $("#tbRespuesta1").val(d.r1);
        $("#tbPregunta2").val(d.p2);
        $("#tbRespuesta2").val(d.r2);
        $("#tbPregunta3").val(d.p3);
        $("#tbRespuesta3").val(d.r3);
        $("#tbPregunta4").val(d.p4);
        $("#tbRespuesta4").val(d.r4);
        $("#tbVeterinaria").val(d.veterinaria);
        $("#tbFecha_esterilizacion").val(d.fecha_esterilizacion);
        $("#idMascota").val(d.id_mascota);
        $("#tbId").val(d.id);
        $("#mAgregarVisita").modal('show');
    }, 'json');
}

function eliminar(id){
    $.post("funciones/admin_visitas_mensuales.php?f=4&id="+id, function (d) {
        if (!d.success) {
            toastr["error"](d.msg);
        }
        else {
            toastr["success"](d.msg);
            cargarVisitas();
        }
    }, 'json');
}