$(function () {
    var con = $("section.content");
    con.waitMe({ text : 'Cargando' });
    $.post("funciones/admin_extraviado.php", {f:"listar_encontrado"}, function(d) {
        if (!d) {
            $(".listadoEx").html("Ninguna denuncia que mostrar.");
        }else {
            for(i=0; i<d.length;i++){
                fila = d[i];
                var item = $("#plantilla").clone();
                if(fila.img == null)
                    item.find(".foto").attr("src", 'data:image/jpeg;base64,' + fila.imagen).attr("cod", fila.id);
                else
                    item.find(".foto").attr("src", 'data:image/jpeg;base64,' + fila.img).attr("cod", fila.id);
                item.find(".titulo").html(fila.titulo);
                item.find(".fecha").html(fechaIngAesp(sumarDias(fila.fecha, 1)));
                $(".listadoEx").append(item.html());
            }            
        }
        con.waitMe("hide");
    },'json');
    // $(".listado").on("click",".foto",function(){
    //     document.location = "extraviado_detalle.php?id="  + $(this).attr("cod");
    // })
});

function sumarDias(fecha, dias){
    var d = new Date(fecha);
    d.setDate(d.getDate() + dias);
    return d;
}