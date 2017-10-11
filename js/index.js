$(function () {
    var ADO = $(".listado-adopciones");
    ADO.waitMe({ text : 'Cargando' });
    $.post("funciones/admin_adopcion.php", {f:"disponibles"}, function(d) {
        if (!d) {
            ADO.html("<div class='col-xs-12'>Ninguna mascota disponible para adopción.</div>");
        }else {
            for(i=0; i<d.length;i++){
                fila = d[i];
                var item = $("#plantilla").clone();
                item.find(".foto").attr("src", 'data:image/jpeg;base64,' + fila.imagen).attr("cod", fila.id);
                item.find(".nombre").html(fila.nombre);
                item.find(".anio").html("<i>fec nac : </i>" + fila.ano_nacimiento);
                ADO.append(item.html());
            }            
        }
        ADO.waitMe("hide");
    },'json');

    var EXT = $(".listado-extraviados");
    EXT.waitMe({ text : 'Cargando' });
    $.post("funciones/admin_extraviado.php", {f:"listar_extraviado"}, function(d) {
        if (!d) {
            EXT.html("<div class='col-xs-12'>Ninguna mascota extraviada.</div>");
        }else {
            for(i=0; i<d.length;i++){
                fila = d[i];
                var item = $("#plantilla").clone();
                if(fila.img == null)
                    item.find(".foto").attr("src", 'data:image/jpeg;base64,' + fila.imagen).attr("cod", fila.id);
                else
                    item.find(".foto").attr("src", 'data:image/jpeg;base64,' + fila.imagen).attr("cod", fila.id);
                item.find(".nombre").html(fila.nombre);
                item.find(".anio").html(fechaIngAesp(fila.fecha));
                EXT.append(item.html());
            }
        }
        EXT.waitMe("hide");
    },'json');

    var ENC = $(".listado-encontrados");
    ENC.waitMe({ text : 'Cargando' });
    $.post("funciones/admin_extraviado.php", {f:"listar_encontrado"}, function(d) {
        if (!d) {
            EXT.html("<div class='col-xs-12'>Ninguna mascota extraviada.</div>");
        }else {
            for(i=0; i<d.length;i++){
                fila = d[i];
                var item = $("#plantilla").clone();
                if(fila.img == null)
                    item.find(".foto").attr("src", 'data:image/jpeg;base64,' + fila.imagen).attr("cod", fila.id);
                else
                    item.find(".foto").attr("src", 'data:image/jpeg;base64,' + fila.img).attr("cod", fila.id);
                item.find(".nombre").html(fila.titulo);
                item.find(".anio").html(fechaIngAesp(fila.fecha));
                ENC.append(item.html());
            }
        }
        ENC.waitMe("hide");
    },'json');








    /*
    $(".listado").on("click",".foto",function(){
        document.location = "denuncias_detalle.php?t=" + $("#tbhTipo").val() + "&id="  + $(this).attr("cod");
    })
    */
});