<?php
extract($_POST);
include_once '../clases/denuncia.php';
$oDen = new Denuncia();

switch ($_REQUEST["f"]) {
    case "listar":
        $_REQUEST["tipo"] = isset($_REQUEST["tipo"]) ? $_REQUEST["tipo"] : "TODOS";
        $data = $oDen->listar($_REQUEST["tipo"]);        
        header('Content-Type: application/json;charset=utf-8');        
        echo json_encode($data);
        break;
        
    case "detalle":
        $data = $oDen->listarDetalle($_REQUEST["id"]);
        header('Content-Type: application/json;charset=utf-8');        
        echo json_encode($data);
        break;
    
    case 10: 
        $data = $oDen->listarTotales();
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