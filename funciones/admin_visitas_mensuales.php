<?php
extract($_POST);
include_once '../clases/visitas_mensuales.php';
$oAdo = new Visitas_mensuales();

switch ($_REQUEST["f"]) {
    case 1: 
        echo $oAdo->listarDataTable($_POST);
        break;

    case "listar":
        $data = $oAdo->listar($_REQUEST);
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($data);

        break;

    case "listarVisitas":
        $data = $oAdo->listarVisitas($_REQUEST);
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($data);

        break;

    case "fInsertar":
        $idInsetado = $oAdo->insertar($_POST);
        if ($idInsetado > 0) {
            $ok = true;
            $msg = "Registrado correctamente.";
        } else {
            $ok = false;
            $msg = "Error al insertar el registro. Inténtelo luego";
        }
        echo json_encode(array("success" => $ok, "msg" => $msg));
        break;

    case "fEditar":
        $idActualizado = $oAdo->save_editar($_POST);
        if ($idActualizado > 0) {
            $ok = true;
            $msg = "Editado correctamente.";
        } else {
            $ok = false;
            $msg = "Error al editar el registro. Inténtelo luego";
        }
        echo json_encode(array("success" => $ok, "msg" => $msg));
        break;

    case "disponibles":
        $data = $oAdo->listarDisponibles($_REQUEST);
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($data);

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
        if($oAdo->eliminar($_REQUEST)){
            $ok = true;
            $msg = "Registro eliminado correctamente.";
        }else{
            $ok = false;
            $msg = "Error al Eliminar el registro. Inténtelo luego";
        }
        echo json_encode(array("success" => $ok, "msg" => $msg));
        break;
    case 5:
        $data = $oAdo->editar($_REQUEST["id"]);
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($data);
        break;
}

?>