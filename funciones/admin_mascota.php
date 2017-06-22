<?php
extract($_POST);
include_once '../clases/mascota.php';
$oMas = new Mascota();

switch ($_REQUEST["f"]) {
    case 1: 
        echo $oMas->listarDataTable($_POST);
        break;
    case "setImage":
        $idInsetado = $oMas->insertar($_POST);
        if ($idInsetado > 0) {
            $ok = true;
            $msg = "Registrado correctamente.";
        } else {
            $ok = false;
            $msg = "Error al insertar el registro. Inténtelo luego";
        }
        echo json_encode(array("success" => $ok, "msg" => $msg));
        break;
    case "listar":
        $data = $oMas->listar($_POST);
        if (sizeof($data) > 0) {
            $ok = true;
            $data = $data;
        } else {
            $ok = false;
            $data = "";
        }
//        echo json_encode(array("success" => $ok, "mascotas" => $data), JSON_PRETTY_PRINT);
        header('Content-Type: application/json;charset=utf-8');        
        echo json_encode($data);      
        
        break;
    case 3:
       $ac = $oMas->actualizar($_POST);
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
        if($oMas->eliminar($id)){
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