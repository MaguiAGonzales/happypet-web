<?php
extract($_POST);
include_once '../clases/adopcion.php';
$oAdo = new Adopcion();

switch ($_REQUEST["f"]) {
    case 1: 
        echo $oAdo->listarDataTable($_POST);
        break;

    case 3:
       $ac = $oAdo->actualizar($_POST);
        if ($ac > 0) {
            $ok = true;
            $msg = "Actualizado correctamente.";
        } else{
            $ok = false;
            $msg = "Error al actualizar el registro. Inténtelo luego";
        }
        echo json_encode(array("success" => $ok, "msg" => $msg));
        break;
    case 4:
        if($oAdo->eliminar($id)){
            $ok = true;
            $msg = "Registro eliminado correctamente.";
        }else{
            $ok = false;
            $msg = "Error al Eliminar el registro. Inténtelo luego";
        }
        echo json_encode(array("success" => $ok, "msg" => $msg));
        break;
}

?>