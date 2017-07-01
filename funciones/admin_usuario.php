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
        $data = $oUsu->validarAcceso($_POST);
        if(sizeof($data) > 0) {
            $ok = true;
            $msg = "Acceso Autorizado";
            $data = "";
        } else {
            $ok = false;
            $msg = "Usuario o Contraseña Incorrectos";
            $data = "";
        }
        echo json_encode(array("success" => $ok, "msg" => $msg, "data" => $data));
        break;
}
?>