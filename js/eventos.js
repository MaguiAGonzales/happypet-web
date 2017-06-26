$(function () {
    cargarEventos();

    $(".listado").on("click", ".well", function(){
        document.location = "eventos_detalle.php?id="  + $(this).attr("cod");
    })

    var menu = new BootstrapMenu('.listado .well', {
        fetchElementData: function(item) {
            return item;
        },
        actions: [{
            name: 'Eliminar',
            onClick: function(eve) {
                con = $('.listado');

                titulo = eve.find(".titulo").html();
                cod = eve.attr("cod");

                bootbox.confirm("¿Seguro que desea eliminar el evento: <b>" + titulo + "</b>?", function(rpta){
                    if(rpta){
                        con.waitMe({ text: 'Eliminando...' });
                        $.post("funciones/admin_evento.php", {"f": "eliminar", id: cod }, function(d){
                            if(!d.success){
                                toastr["error"](d.msg);
                            }else{
                                toastr["success"](d.msg);
                                cargarEventos();
                            }
                            con.waitMe('hide');
                        },"json");
                    }
                });
            }
        }]
    });
});

function cargarEventos(){
    $(".listado").html("");
    $.post("funciones/admin_evento.php", {f:"listar"}, function(d) {
        if (d.length == 0) {
            $(".listado").html("Ningún evento que mostrar.");
        }else {
            for(i=0; i<d.length;i++){
                fila = d[i];
                var pla = $("#plantilla").clone();

                pla.find(".well").attr("cod",fila.id);
                pla.find(".titulo").html(fila.titulo);
                pla.find(".lugar").html(fila.lugar);
                pla.find(".fecha").html(fechaIngAesp(fila.fecha));
                pla.find(".hora").html(hora12(fila.hora));

                $(".listado").append(pla.html());
            }
        }
    },'json');
}