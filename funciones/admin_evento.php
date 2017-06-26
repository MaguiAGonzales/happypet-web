<?php
extract($_POST);
include_once '../clases/evento.php';
$oEve = new Evento();

switch ($_REQUEST["f"]) {
    case "listar":
        $data = $oEve->listar();
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($data);
        break;
        
    case "detalle":
        $data = $oEve->listarDetalle($_REQUEST["id"]);
//        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($data);
        break;

    case "insertar":
        $idInsetado = $oEve->insertar($_POST);
        if ($idInsetado > 0) {
            $ok = true;
            $msg = "Registrado correctamente.";
        } else {
            $ok = false;
            $msg = "Error al insertar el registro. Inténtelo luego";
        }
        echo json_encode(array("success" => $ok, "msg" => $msg));
        break;
    case "actualizar":
        $ac = $oEve->actualizar($_REQUEST);
        if ($ac > 0) {
            $ok = true;
            $msg = "Actualizado correctamente.";
        } else{
            $ok = false;
            $msg = "Error al actualizar el registro. Inténtelo luego";
        }
        echo json_encode(array("success" => $ok, "msg" => $msg));
        break;
    case "eliminar":
        if($oEve->eliminar($_REQUEST["id"])){
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