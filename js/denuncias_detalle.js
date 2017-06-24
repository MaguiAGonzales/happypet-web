$(function () {
    var con = $("section.content");
    con.waitMe({ text : 'Cargando' });
    $.post("funciones/admin_denuncia.php", {f:"detalle", id: $("#tbId").val()}, function(d) {
        if (d) {
            $("#imgFoto").attr("src", "data:image/jpeg;base64," +  d.foto);
            $("#tbTitulo").val(d.titulo);
            $("#tbFecha").val(d.fecha);
            $("#cbTipo").val(d.tipo);
            $("#tbDescripcion").val(d.descripcion);
            
            $("#tbNombres").val(d.nombres);
            $("#tbDni").val(d.dni);
            $("#tbDireccion").val(d.direccion);
            $("#tbReferencia").val(d.referencia);
            $("#tbTelefono").val(d.telefono);
            $("#tbCorreo").val(d.correo);
        }
        con.waitMe("hide");
    },'json');
    
});