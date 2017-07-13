$(function () {
    var mAdo = $("#mAdopcion");
    var fAdo = $("#fAdopcion");

    var dtAdo = $('#dtAdopcion').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todo"] ],
        ajax:{
            url :"funciones/admin_adopcion.php?f=1",
            type: "post"
        },
        "dom": "<'row text-sm'<'col-xs-6'B><'col-xs-6 text-right'f>>t<'row text-sm'<'col-xs-6 col-sm-4'<'#tbR'>i><'col-xs-6 col-sm-4 text-center'l><'col-xs-12 col-sm-4 text-right'p>>",
        buttons: [
           
        ],
        columns: [
            { "data": "id"},
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
                        etiqueta = "TERMINADO";
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
        $("#tbhEstado").val(fila.estado);

        $("#imgMascotaFoto").attr("src", "data:image/jpeg;base64," + fila.imagen);
        $("#tbMascotaNombre").val(fila.nombre);
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

        if(fila.estado != "F1"){
            $.post("funciones/admin_test.php", {f: "info", id: fila.id_test}, function(d) {
                $("#tbPregunta1").val(d.r1);
                $("#tbPregunta2").val(d.r2);
                $("#chbPregunta21").prop("checked", d.r21=="1"?true:false).change().bootstrapToggle('disable');
                $("#tbPregunta3").val(d.r3);
                $("#chbPregunta31").prop("checked", d.r31=="1"?true:false).change().bootstrapToggle('disable');
                $("#tbPregunta4").val(d.r4);
                $("#chbPregunta41").prop("checked", d.r41=="1"?true:false).change().bootstrapToggle('disable');
                $("#chbPregunta51").prop("checked", d.r51=="1"?true:false).change().bootstrapToggle('disable');
                $("#tbPregunta6").val(d.r6);
                $("#tbPregunta7").val(d.r7);
                $("#tbPregunta8").val(d.r8);
                $("#chbPregunta81").prop("checked", d.r81=="1"?true:false).change().bootstrapToggle('disable');
                $("#tbPregunta9").val(d.r9);
                $("#tbPregunta101").val(d.r101);
                $("#tbPregunta10").val(d.r10);

                $("#r11_1").html(d.r111=="1"?"SI":"NO").addClass(d.r111=="1"?"bg-green":"");
                $("#r11_2").html(d.r112=="1"?"SI":"NO").addClass(d.r112=="1"?"bg-green":"");
                $("#r11_3").html(d.r113=="1"?"SI":"NO").addClass(d.r113=="1"?"bg-green":"");
                $("#r11_4").html(d.r114=="1"?"SI":"NO").addClass(d.r114=="1"?"bg-green":"");
                $("#r11_5").html(d.r115=="1"?"SI":"NO").addClass(d.r115=="1"?"bg-green":"");
                $("#r11_6").html(d.r116=="1"?"SI":"NO").addClass(d.r116=="1"?"bg-green":"");
                $("#r11_7").html(d.r117=="1"?"SI":"NO").addClass(d.r117=="1"?"bg-green":"");
                $("#r11_8").html(d.r118=="1"?"SI":"NO").addClass(d.r118=="1"?"bg-green":"");
                $("#r11_9").html(d.r119=="1"?"SI":"NO").addClass(d.r119=="1"?"bg-green":"");

                $("#tbPregunta12").val(d.r12);
                $("#chbPregunta121").prop("checked", d.r12.length>0?true:false).change().bootstrapToggle('disable');
            },'json').fail(function() {
                toastr["error"]("Ocurrió un error al traer el TEST");
            });
        }




        $("#tbResultado").val(fila.resultado);


        $("#btnGuardarAdopcion").show();

        switch (fila.estado){
            case "F1":
                $("#fase1").addClass("fase-llena");
                $("#fase2, #fase3").removeClass("fase-llena");

                $('#chbAprobado').prop('checked', true).change();
                $("#fase2 input, #fase3 input").attr('readonly','readonly');
                $('#chbAprobado').bootstrapToggle('disable');

                $('#btnFase1Detalle').prop('disabled',false);
                $('#btnFase2Detalle').prop('disabled',true);
                break;
            case "F2":
                $("#fase1, #fase2").addClass("fase-llena");
                $("#fase3").removeClass("fase-llena");

                $('#chbAprobado').prop('checked', true).change();
                $("#fase2 input").removeAttr('readonly');
                $("#fase3 input").attr('readonly','readonly');
                $('#chbAprobado').bootstrapToggle('enable');

                $('#btnFase1Detalle').prop('disabled',false);
                $('#btnFase2Detalle').prop('disabled',false);
                break;
            case "F3":
                $("#fase1, #fase2, #fase3").addClass("fase-llena");

                $('#chbAprobado').prop('checked', true).change();
                $("#fase2 input").attr('readonly','readonly');
                $("#fase3 input").removeAttr('readonly');
                $('#chbAprobado').bootstrapToggle('disable');

                $('#btnFase1Detalle').prop('disabled',false);
                $('#btnFase2Detalle').prop('disabled',false);

                $("#tbHora").timepicker();
                $('#tbFecha').datepicker();
                break;
            case "NP":
                $("#fase1, #fase2").addClass("fase-llena");
                $("#fase3").removeClass("fase-llena");

                $('#chbAprobado').prop('checked', false).change();
                $("#fase2 input, #fase3 input").attr('readonly','readonly');
                $('#chbAprobado').bootstrapToggle('disable');

                $('#btnFase1Detalle').prop('disabled',false);
                $('#btnFase2Detalle').prop('disabled',false);

                $("#btnGuardarAdopcion").hide();
                break;
            case "TE":
                $("#fase1, #fase2, #fase3").addClass("fase-llena");

                $('#chbAprobado').prop('checked', true).change();
                $("#fase2 input, #fase3 input").attr('readonly','readonly');
                $('#chbAprobado').bootstrapToggle('disable');

                $('#btnFase1Detalle').prop('disabled',false);
                $('#btnFase2Detalle').prop('disabled',false);

                $("#tbIdVisitaAdopcion").val(fila.id_visita_adopcion);
                $("#tbFecha").val(fechaIngAesp(fila.fecha_adopcion));
                $("#tbHora").val(hora12(fila.hora_adopcion).toUpperCase());
                $("#tbDescripcion").val(fila.descripcion_adopcion);

                $("#btnGuardarAdopcion").hide();

                break;
        }

        mAdo.modal('show');
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



});