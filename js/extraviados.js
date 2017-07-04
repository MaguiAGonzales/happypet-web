$(function () {
    var con = $("section.content");
    con.waitMe({ text : 'Cargando' });
    $.post("funciones/admin_extraviado.php", {f:"listar"}, function(d) {
        if (!d) {
            $(".listadoEx").html("Ninguna denuncia que mostrar.");
        }else {
            for(i=0; i<d.length;i++){
                fila = d[i];
                var item = $("#plantilla").clone();
                item.find(".foto").attr("src", 'data:image/jpeg;base64,' + fila.imagen).attr("cod", fila.id);
                item.find(".titulo").html(fila.nombre);
                item.find(".fecha").html(fechaIngAesp(fila.fecha));
                $(".listadoEx").append(item.html());
            }            
        }
        con.waitMe("hide");
    },'json'); 
    
    // $(".listado").on("click",".foto",function(){
    //     document.location = "extraviado_detalle.php?id="  + $(this).attr("cod");
    // })
});