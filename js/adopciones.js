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
        // con = dtAdo.parents(".dataTables_wrapper");

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

        $("#tbResultado").val(fila.resultado);


        $("#btnGuardarAdopcion").show();

        switch (fila.estado){
            case "F1":
                $("#fase1").addClass("fase-llena");
                $("#fase2, #fase3").removeClass("fase-llena");

                $('#chbAprobado').prop('checked', true).change();
                $("#fase2 input, #fase3 input").attr('readonly','readonly');
                $('#chbAprobado').bootstrapToggle('disable');
                break;
            case "F2":
                $("#fase1, #fase2").addClass("fase-llena");
                $("#fase3").removeClass("fase-llena");

                $('#chbAprobado').prop('checked', true).change();
                $("#fase2 input").removeAttr('readonly');
                $("#fase3 input").attr('readonly','readonly');
                $('#chbAprobado').bootstrapToggle('enable');
                break;
            case "F3":
                $("#fase1, #fase2, #fase3").addClass("fase-llena");

                $('#chbAprobado').prop('checked', true).change();
                $("#fase2 input").attr('readonly','readonly');
                $("#fase3 input").removeAttr('readonly');
                $('#chbAprobado').bootstrapToggle('disable');


                $("#tbHora").timepicker();
                $('#tbFecha').datepicker();
                break;
            case "NP":
                $("#fase1, #fase2").addClass("fase-llena");
                $("#fase3").removeClass("fase-llena");

                $('#chbAprobado').prop('checked', false).change();
                $("#fase2 input, #fase3 input").attr('readonly','readonly');
                $('#chbAprobado').bootstrapToggle('disable');

                $("#btnGuardarAdopcion").hide();
                break;
            case "TE":
                $("#fase1, #fase2, #fase3").addClass("fase-llena");

                $('#chbAprobado').prop('checked', true).change();
                $("#fase2 input, #fase3 input").attr('readonly','readonly');
                $('#chbAprobado').bootstrapToggle('disable');

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
        con.waitMe({ text : 'Guardando Resultado del Test de Adopción...' });

        var data = fAdo.serializeArray();
        data.push({name: 'f', value: "f3" });
        data.push({name: 'ida', value: $("#tbId").val() });
        data.push({name: 'aprobado', value: $("#chbAprobado").prop("checked") });
        data.push({name: 'resultado', value: $("#tbResultado").val() });

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
            toastr["error"]("Ocurrió un error al guardar el resultado");
            con.waitMe('hide');
        });

    });



});