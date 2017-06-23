$(function () {
    $.post("funciones/admin_denuncia.php", {f:10}, function(d) {
        if (!d.success) {
            toastr["error"](d.msg);
        }else {
            console.log(d.data);
            $("#totalAccidentes").html(d.data.ACCIDENTES);
            $("#totalMaltratos").html(d.data.MALTRATOS);
            $("#totalOtros").html(d.data.OTROS);
        }
    },'json');
    
    $(".tipo-denuncias img").on("click", function(){
        document.location = "denuncias_lista.php?t="  + $(this).attr("tipo");
    })
});