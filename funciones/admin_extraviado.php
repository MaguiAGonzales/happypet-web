<?php
extract($_POST);
include_once '../clases/extraviado.php';
$oExt = new Extraviado();

switch ($_REQUEST["f"]) {
    case "listar":
        $data = $oExt->listar();
        header('Content-Type: application/json;charset=utf-8');        
        echo json_encode($data);
        break;
        
    case "detalle":
        $data = $oExt->listarDetalle($_REQUEST["id"]);
        header('Content-Type: application/json;charset=utf-8');        
        echo json_encode($data);
        break;
    
    case 10: 
        $data = $oExt->listarTotales();
        if (sizeof($data) > 0) {
            $ok = true;
            $data = $data;
        } else {
            $ok = false;
            $data = "";
        }
        header('Content-Type: application/json;charset=utf-8');        
        echo json_encode(array("success" => $ok, "data" => $data));
        break;
}

?>