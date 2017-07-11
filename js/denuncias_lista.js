$(function () {
    var con = $("section.content");
    con.waitMe({ text : 'Cargando' });
    $.post("funciones/admin_denuncia.php", {f:"listar", tipo:$("#tbhTipo").val()}, function(d) {
        if (!d) {
            $(".listado").html("Ninguna denuncia que mostrar.");
        }else {
            for(i=0; i<d.length;i++){
                fila = d[i];
                var reg = $("#plantillaD").clone();
                reg.find(".foto").attr("src", 'data:image/jpeg;base64,' + fila.foto).attr("cod", fila.id);
                reg.find(".titulo").html(fila.titulo);
                if(fila.estado=="0"){
                    reg.find(".estado").html("Nuevo").addClass("label label-danger");
                }else{
                    reg.find(".estado").html("Atendido").removeClass("label label-danger");
                }
                
                reg.find(".fecha").html(fechaIngAesp(fila.fecha));
                $(".listado").append(reg.html());
            }            
        }
        con.waitMe("hide");
    },'json'); 
    
    $(".listado").on("click",".foto",function(){
        document.location = "denuncias_detalle.php?t=" + $("#tbhTipo").val() + "&id="  + $(this).attr("cod");
    })
});