<?php
extract($_POST);
include_once '../clases/usuario.php';
$oUsu = new Usuario();

switch ($_REQUEST["f"]) {
    case 1:
        try {
            switch ($oUsu->validar($_POST)) {
                case 0:
                    echo 'Error: Usuario o Clave Incorrectos';                    
                    break;
                case -1:
                    echo 'Error: Solo se permite el acceso a usuarios Administradores';
                    break;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        break;
    case 2:
        $data = $oUsu->validarAcceso($_GET);
        if(sizeof($data) > 0) {
            $ok = true;
            $msg = "Acceso Autorizado";
            $data = $data[0];
        } else {
            $ok = false;
            $msg = "Usuario o Contraseña Incorrectos";
            $data = "";
        }
//        header('Content-Type: application/json;charset=utf-8');
        echo json_encode(array("success" => $ok, "msg" => $msg, "data" => $data));
//        echo json_encode($data);
        break;
    case 3:
//        echo $oMas->listarDataTable($_POST);
        echo $oUsu->listarDataTable($_REQUEST);
        break;

    case 4:
        if($oUsu->eliminar($id)){
            $ok = true;
            $msg = "Registro eliminado correctamente.";
        }else{
            $ok = false;
            $msg = "Error al Eliminar el registro. Inténtelo luego";
        }
        echo json_encode(array("success" => $ok, "msg" => $msg));
        break;

    case 5:
        $data = $oUsu->editar($_REQUEST["id"]);
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($data);
        break;

    case 6:
        $idActualizado = $oUsu->save_editar($_POST);
        if ($idActualizado > 0) {
            $ok = true;
            $msg = "Registrado correctamente.";
        } else {
            $ok = false;
            $msg = "Error al insertar el registro. Inténtelo luego";
        }
        echo json_encode(array("success" => $ok, "msg" => $msg));
        break;

    case "listar":
        $data = $oUsu->listar($_REQUEST);
//        print_r(sizeof($data));
//        header('Content-Type: application/json;charset=utf-8');
        if (isset($_REQUEST["id"]))
            echo json_encode($data[0]);
        else
            echo json_encode($data);

        break;

    case "setImage":
        $idInsetado = $oUsu->insertar($_POST);
        if ($idInsetado > 0) {
            $ok = true;
            $msg = "Registrado correctamente.";
        } else {
            $ok = false;
            $msg = "Error al insertar el registro. Inténtelo luego";
        }
        echo json_encode(array("success" => $ok, "msg" => $msg));
        break;
}
?>