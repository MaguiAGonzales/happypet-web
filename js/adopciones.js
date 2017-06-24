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
            {
                text: "<span class='glyphicon glyphicon-plus'></span> Nueva Adopción",
                className: "btn-primary btn-agregar",
                action: function ( e, dt, node, config ) {
                    $("#tbId").val(0);
                    mAdo.find(".modal-title").html("Nueva Adopción");
                    mAdo.modal('show');
                }
            }
        ],
        columns: [
            { "data": "id"},
            { "data": "imagen", orderable: false, "render": function(data, type, row) {
                return '<img src="data:image/jpeg;base64,'+data+'" width="90" class="img-bordered-sm" />';
            }},
            { "data": "nombre"},
            { "data": "usuario", className:"hidden-xs"  },
            { "data": "fecha" },
            { "data": "estado", class:"text-center", orderable: false, "render": function(data, type, row) {
                return '<button type="button" class="btn btn-'+ (data=='P'?"success":"warning") +' btn-xs">' + (data=="P"?"En Proceso":"Finalizado") + '</button>';
                // return '<span class="label label-'+ (data=='P'?"success":"warning") +'">' + (data=="P"?"En Proceso":"Finalizado") + '</span>';
            }},
        ],
        order: [[0, "desc"]]
    });

    $("#tbR").css("display","inline").html('<button type="button" class="btn btn-default btn-sm btn-refrescar" ><span class="glyphicon glyphicon-refresh" id="btnRefrescar"></span>');

    $("#tbR").on('click', '.btn-refrescar', function () {
        dtAdo.ajax.reload(null, false);
    });
});