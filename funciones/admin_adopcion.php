<?php
extract($_POST);
include_once '../clases/adopcion.php';
$oAdo = new Adopcion();

switch ($_REQUEST["f"]) {
    case 1: 
        echo $oAdo->listarDataTable($_POST);
        break;
    case "listar":
        $data = $oAdo->listar($_REQUEST);
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($data);

        break;

    case "disponibles":
        $data = $oAdo->listarDisponibles($_REQUEST);
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($data);

        break;

    case "f1":
        $idInsetado = $oAdo->insertarFase1($_REQUEST);
        if ($idInsetado > 0) {
            $ok = true;
            $msg = "La FASE 1 ha sido registrada correctamente.";
        } else {
            $ok = false;
            $msg = "Error al registrar la FASE 1. Inténtelo luego";
        }
        echo json_encode(array("success" => $ok, "msg" => $msg, "id" => $idInsetado));
        break;

    case "f2":
        $idInsetado = $oAdo->insertarFase2($_REQUEST);
        if ($idInsetado > 0) {
            $ok = true;
            $msg = "La FASE 2 ha sido registrada correctamente.";
        } else {
            $ok = false;
            $msg = "Error al registrar la FASE 2. Inténtelo luego";
        }
        echo json_encode(array("success" => $ok, "msg" => $msg));
        break;

    case "f3":
        $idInsetado = $oAdo->insertarFase3($_REQUEST);
        if ($idInsetado > 0) {
            $ok = true;
            $msg = "Calificación del TEST registrado correctamente.";
        } else {
            $ok = false;
            $msg = "Error al registrar la calificación del TEST. Inténtelo luego";
        }
        echo json_encode(array("success" => $ok, "msg" => $msg));
        break;
    case "visita":
        $idInsetado = $oAdo->visitaAdopcion($_REQUEST);
        if ($idInsetado > 0) {
            $ok = true;
            $msg = "Fecha de Visita de Adopción registrada correctamente.";
        } else {
            $ok = false;
            $msg = "Error al registrar Visita de Adopción. Inténtelo luego";
        }
        echo json_encode(array("success" => $ok, "msg" => $msg));
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