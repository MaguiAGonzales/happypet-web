<?php
extract($_POST);
include_once '../clases/denuncia.php';
$oDen = new Denuncia();

switch ($_REQUEST["f"]) {
    case "listar":
        $data = $oDen->listar($_REQUEST);
        header('Content-Type: application/json;charset=utf-8');        
        echo json_encode($data);
        break;

    case "insertar":
        $idInsetado = $oDen->insertar($_POST);
        if ($idInsetado > 0) {
            $ok = true;
            $msg = "Denuncia registrada correctamente.";
        } else {
            $ok = false;
            $msg = "Error al insertar el registro. Inténtelo luego";
        }
        echo json_encode(array("success" => $ok, "msg" => $msg));
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