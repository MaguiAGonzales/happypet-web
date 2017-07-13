<?php
extract($_POST);
include_once '../clases/test.php';
$oTes = new Test();

switch ($_REQUEST["f"]) {
    case "info":
        $data = $oTes->info($_REQUEST["id"]);
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($data);

        break;
}

?>