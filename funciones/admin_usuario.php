<?php
extract($_POST);
include_once '../clases/usuario.php';
$oUsu = new Usuario();

switch ($_REQUEST["f"]) {
    case 1:
        try {
            if (!$oUsu->validar($_POST)) {
                echo 'Error: Usuario o Clave Incorrectos';
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        break;
    case 10:
        try {
            if (!$oUsu->validar($_POST)) {
                header("HTTP/1.1 420 Usuario o Contraseña Incorrecto");
            }else{
                http_response_code(200);
            }
        } catch (Exception $e) {
            header("HTTP/1.1 420 Usuario o Contraseña Incorrecto.");
        }

}
?>