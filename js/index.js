$(function () {
    var con = $(".listadoAdopciones");
    con.waitMe({ text : 'Cargando' });
    $.post("funciones/admin_mascota.php", {f:"disponibles"}, function(d) {
        if (!d) {
            $(".listadoAdopciones").html("<div class='col-xs-12'>Ninguna mascota disponible para adopción.</div>");
        }else {
            for(i=0; i<d.length;i++){
                fila = d[i];
                var item = $("#plantillaAdopciones").clone();
                item.find(".foto").attr("src", 'data:image/jpeg;base64,' + fila.imagen).attr("cod", fila.id);
                item.find(".nombre").html(fila.nombre);
                item.find(".anio").html(fila.ano_nacimiento);
                $(".listadoAdopciones").append(item.html());
            }            
        }
        con.waitMe("hide");
    },'json'); 
    /*
    $(".listado").on("click",".foto",function(){
        document.location = "denuncias_detalle.php?t=" + $("#tbhTipo").val() + "&id="  + $(this).attr("cod");
    })
    */
});