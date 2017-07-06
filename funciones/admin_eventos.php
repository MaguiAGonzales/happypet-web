<?php
extract($_POST);
include_once '../clases/evento.php';
$oMas = new Evento();

switch ($_REQUEST["f"]) {
    case 1: 
        echo $oMas->listarDataTable($_POST);
        break;

   
    case "listar":
        $data = $oMas->listar($_REQUEST);
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

    
}

?>