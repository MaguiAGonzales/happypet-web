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
    case "listar_extraviado":
        $data = $oExt->listar_extraviado();
        header('Content-Type: application/json;charset=utf-8');        
        echo json_encode($data);
        break;
    case "listar_encontrado":
        $data = $oExt->listar_encontrado();
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($data);
        break;
	case "mi_lista":
        $data = $oExt->mi_lista($_REQUEST["id"]);
        header('Content-Type: application/json;charset=utf-8');        
        echo json_encode($data);
        break;
    case "mi_lista_extraviado":
        $data = $oExt->mi_lista_extraviado($_REQUEST["id"]);
        header('Content-Type: application/json;charset=utf-8');        
        echo json_encode($data);
        break;

    case "mi_lista_encontrado":
        $data = $oExt->mi_listar_encontrado($_REQUEST["id"]);
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