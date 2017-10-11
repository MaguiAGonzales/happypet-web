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

            if(d.estado === '1'){
                $("#dbSi").prop("checked", true);
                $("#dbNo").prop("checked", false);
            }else{
                $("#dbSi").prop("checked", false);
                $("#dbNo").prop("checked", true);
            }
        }
        con.waitMe("hide");
    },'json');
});
$(document).ready(function() {
    $('input[type=radio][name=visible]').change(function() {
        if (this.value == '1') {
            $.post("funciones/admin_denuncia.php", {f:"actualizar", id: $("#tbId").val(), estado: 1}, function(d) {

            },'json');
        }
        else if (this.value == '0') {
            $.post("funciones/admin_denuncia.php", {f:"actualizar", id: $("#tbId").val(), estado: 0}, function(d) {

            },'json');
        }
    });
});
