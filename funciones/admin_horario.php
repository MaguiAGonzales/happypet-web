<?php
extract($_POST);
include_once '../clases/horario.php';
$oHor = new Horario();

switch ($_REQUEST["f"]) {
    case "horario":
        $data = $oHor->listarHorario($_REQUEST["id"]);
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($data);

        break;
}

?>