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
}
?>