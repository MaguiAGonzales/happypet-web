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
            { "data": "estado", class:"text-center", orderable: false, "render": function(data, type, row) {
                estado = data.substr(0, 1);
                fase = "";
                switch(estado) {
                    case "F":
                        clase = "success";
                        etiqueta = "En Proceso";
                        fase = (data.length > 1) ? "<br><span class='label label-default'> Fase " + data.substr(1, 1) + "</span>" : "";
                        break;
                    case "T":
                        clase = "info";
                        etiqueta = "Terminado";
                        break;
                    case "N":
                        clase = "danger";
                        etiqueta = "No Pasó";
                        break;
                }

                return '<button type="button" class="btn btn-'+ clase +' btn-xs">' + etiqueta + '</button> '  + fase;
            }},
        ],
        order: [[0, "desc"]]
    });

    $("#tbR").css("display","inline").html('<button type="button" class="btn btn-default btn-sm btn-refrescar" ><span class="glyphicon glyphicon-refresh" id="btnRefrescar"></span>');

    $("#tbR").on('click', '.btn-refrescar', function () {
        dtAdo.ajax.reload(null, false);
    });
});