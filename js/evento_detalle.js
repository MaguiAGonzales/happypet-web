$(function () {
    if($("#tbId").val()==""){
        $("#btnGuardar").html("Guardar");
        document.getElementById("fEvento").reset();
    }else{
        $("#btnGuardar").html("Actualizar");

        var con = $("section.content");
        con.waitMe({ text : 'Cargando' });
        $.post("funciones/admin_evento.php", {f:"detalle", id: $("#tbId").val()}, function(d) {
            if (d) {
                $("#tbTitulo").val(d.titulo);
                $("#tbDescripcion").val(d.descripcion);
                $("#tbFecha").val(fechaIngAesp(d.fecha));
                $("#tbHora").val(hora12(d.hora));
                $("#tbLugar").val(d.lugar);
                $("#tbReferncia").val(d.referencia);

                $("#tbNombres").val(d.nombres);
                $("#tbDni").val(d.dni);
                $("#tbDireccion").val(d.direccion);
                $("#tbReferencia").val(d.referencia);
                $("#tbTelefono").val(d.telefono);
                $("#tbCorreo").val(d.correo);
            }
            con.waitMe("hide");
        },'json');
    }

    $("#btnGuardar").on("click",function(){
        fEve = $("#fEvento");
        fEve.waitMe({ text : 'Guardando Evento...' });

        var data = fEve.serializeArray();
        data.push({name: 'f', value: $("#tbId").val()==0 ? "insertar" : "actualizar" });

        $.post("funciones/admin_evento.php", data, function(d) {
            if (!d.success) {
                toastr["error"](d.msg);
            }
            else {
                toastr["success"](d.msg);
                document.location = "eventos.php";
            }
            fEve.waitMe('hide');
        },'json');

    });

    
});