$(function () {
    var mMas = $("#mMascota");
    var fMas = $("#fMascota");
    
    var dtMas = $('#dtMascotas').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todo"] ],
        ajax:{
            url :"funciones/admin_mascota.php?f=1",
            type: "post"
        },
        "dom": "<'row text-sm'<'col-xs-6'B><'col-xs-6 text-right'f>>t<'row text-sm'<'col-xs-6 col-sm-4'<'#tbR'>i><'col-xs-6 col-sm-4 text-center'l><'col-xs-12 col-sm-4 text-right'p>>",
        buttons: [
            {
                text: "<span class='glyphicon glyphicon-plus'></span> Nueva Mascota",
                className: "btn-primary btn-agregar",
                action: function ( e, dt, node, config ) {
                    $("#tbId").val(0);
                    mMas.find(".modal-title").html("Nueva Mascota");
                    mMas.modal('show');
                }
            }
        ],
        columnDefs: [{
            targets: -1,
            data: null,
//            defaultContent: "<span class='glyphicon glyphicon-pencil dt-btn dt-btn-editar'></span> &nbsp;<span class='glyphicon glyphicon-trash dt-btn dt-btn-eliminar'></span>",
            defaultContent: "<span class='glyphicon glyphicon-pencil dt-btn dt-btn-editar'></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='glyphicon glyphicon-trash dt-btn dt-btn-eliminar'></span>",
            className: "text-center",
            responsivePriority: -1,
            width: "40px",
        }],
        columns: [
            { "data": "id", "visible": false},
            { "data": "imagen", orderable: false, "render": function(data, type, row) {
                return '<img src="data:image/jpeg;base64,'+data+'" width="90" class="img-bordered-sm" data-lightbox="' + row.id + '" data-title="' + row.nombre + '" />';
            }},
            { "data": "nombre"},
            { "data": "tipo_mascota", className:"hidden-xs"  },
            { "data": "sexo" },
            { "data": "ano_nacimiento"},
            { "data": null, "orderable": false}
        ],
        order: [[0, "desc"]],
        initComplete: function (settings, json) {
            new MiniLightbox(".img-bordered-sm");
            new MiniLightbox({
                selector: ".img-bordered-sm"
                // the common container where the images are appended
              , delegation: "html"
            });
        }
    });

    $("#tbR").css("display","inline").html('<button type="button" class="btn btn-default btn-sm btn-refrescar" ><span class="glyphicon glyphicon-refresh" id="btnRefrescar"></span>');

    $("#tbR").on('click', '.btn-refrescar', function () {
        dtMas.ajax.reload(null, false);
    });

    dtMas.on('click', '.dt-btn-editar', function () {
//        var fila = dtCli.row($(this).parents('tr')).data();
//        $("#tbDniPro").attr("data-remote","funciones/admin_cliente.php?f=20&id=" + fila.id);
//
//        if(fila.dni != ""){
//            mCli.find(".modal-title").html("Editar Cliente");
//            $("#sPersona").show();
//            $("#sEmpresa").hide();
//
//            $("#tbDniCli").val(fila.dni);
//            $("#tbNombresCli").val(fila.nombres);
//            $("#tbPaternoCli").val(fila.paterno);
//            $("#tbMaternoCli").val(fila.materno);
//
//            if(fila.razon_social == "M")
//                $("#rbMasculinoCli").prop("checked", true);
//            else
//                $("#rbFemeninoCli").prop("checked", true);
//        }else{
//            mCli.find(".modal-title").html("Editar Empresa");
//            $("#sPersona").hide();
//            $("#sEmpresa").show();
//
//            $("#tbRucCli").val(fila.ruc);
//            $("#tbRazonSocCli").val(fila.razon_social);
//        }
//        $("#tbId").val(fila.id);
//
//        $("#tbTelefonoCli").val(fila.telefono);
//        $("#tbDireccionCli").val(fila.direccion);
//        $("#tbCorreoCli").val(fila.correo);
//
//        $("#tbRucCli").val(fila.ruc);
//        $("#tbRazonSocialCli").val(fila.razon_cliente);
//
//        mCli.modal('show');
    });

    $("#btnGuardarMascota").on("click",function(){
        //obtiene la foto
        if(typeof($("#avatar-1")[0].files[0]) !== "undefined") {
            var imgAvatar = $("#avatar-1")[0].files[0];

            // para convertir a base 64
            var reader = new FileReader();
            reader.onload = function (re) {
                var img64 = re.target.result;
                img64 = img64.split(',')[1];

                con = $("#fMascota").parents(".modal-content");
                con.waitMe({text: 'Guardando Mascota...'});

                var data = fMas.serializeArray();
                data.push({name: 'f', value: $("#tbId").val() == 0 ? "setImage" : 3});
                data.push({name: 'adoptado', value: 0});
                data.push({name: 'adoptable', value: 1});
                data.push({name: 'id_usuario', value: $("#tbIdUsuario").val()});
                data.push({name: 'imagen', value: img64});
                data.push({name: 'id', value: $("#tbId").val()});

                console.log(data);

                $.post("funciones/admin_mascota.php", data, function (d) {
                    if (!d.success) {
                        toastr["error"](d.msg);
                    }
                    else {
                        toastr["success"](d.msg);
                        mMas.modal('hide');
                        dtMas.ajax.reload();
                    }
                    con.waitMe('hide');
                }, 'json');

            };
            reader.onerror = function (error) {
                console.log('Error: ', error);
            };

            console.log(imgAvatar);

            reader.readAsDataURL(imgAvatar);
        }else{
            if($("#tbId").val() == 0)
                alert("No se selecciono imagen");
            else{
                var data = fMas.serializeArray();
                data.push({name: 'f', value: $("#tbId").val() == 0 ? "setImage" : 3});
                data.push({name: 'adoptado', value: 0});
                data.push({name: 'adoptable', value: 1});
                data.push({name: 'id_usuario', value: $("#tbIdUsuario").val()});
                data.push({name: 'imagen', value: ''});
                data.push({name: 'id', value: $("#tbId").val()});

                console.log(data);

                $.post("funciones/admin_mascota.php", data, function (d) {
                    if (!d.success) {
                        toastr["error"](d.msg);
                    }
                    else {
                        toastr["success"](d.msg);
                        mMas.modal('hide');
                        dtMas.ajax.reload();
                    }
                    con.waitMe('hide');
                }, 'json');
            }
        }
        
    });

    dtMas.on('click', '.dt-btn-eliminar', function () {
        con = $('#dtMascotas').parents(".dataTables_wrapper");

        var da = dtMas.row($(this).parents('tr')).data();
        bootbox.confirm("¿Seguro que desea eliminar el registro de la Mascota : <b>" + da.nombre + "</b>?", function(rpta){
            if(rpta){
                con.waitMe({ text: 'Eliminando...' });
                $.post("funciones/admin_mascota.php", {"f": 4, id: da.id }, function(d){
                    if(!d.success){
                        toastr["error"](d.msg);
                    }else{
                        toastr["success"](d.msg);
                        dtMas.ajax.reload();
                    }
                    con.waitMe('hide');
                },"json");
            }
        });
    });

    dtMas.on('click', '.dt-btn-editar', function () {
        con = $('#dtMascotas').parents(".dataTables_wrapper");

        var da = dtMas.row($(this).parents('tr')).data();

        $("#tbId").val(da.id);
        mMas.find(".modal-title").html("Editar Mascota");
        mMas.modal('show');

        $.post("funciones/admin_mascota.php", {"f": 5, id: da.id }, function(d){
            $("#tbNombre").val(d.nombre);
            $("div.id_tipo select").val(d.tipo_mascota);
            $("div.id_macho select").val(d.sexo);
            $("#tbAnio").val(d.ano_nacimiento);
            $("div.id_tamanio select").val(d.tamano);
            $("#tbParticularidades").val(d.particularidades);
            $("#tbSalud").val(d.salud);
            if(d.adoptable === "1")
                $("#adoptado_si").prop('checked', true);
            else
                $("#adoptado_no").prop('checked', true);

            if(d.esterilizado === "1")
                $("#esterilizado_si").prop('checked', true);
            else
                $("#esterilizado_no").prop('checked', true);

            $("#imgPreview").attr("src","data:image/jpeg;base64,"+d.imagen);

        });
    });

    mMas.on('shown.bs.modal', function (e) {
        $("#tbNombre").focus();
    })

    mMas.on('hidden.bs.modal', function (e) {
        $('#fMascota')[0].reset();
        $('#avatar-1').fileinput('refresh');
        con = $("#fMascota").parents(".modal-content");
        con.waitMe('hide');
    })
    
    //--------------------------------
 
    $("#avatar-1").fileinput({
        overwriteInitial: true,
        maxFileSize: 2500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Quitar Imagen',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        defaultPreviewContent: '<img id="imgPreview" src="img/logo.png" alt="Your Avatar" style="width:120px">',
        layoutTemplates: {main2: '{preview} {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

});