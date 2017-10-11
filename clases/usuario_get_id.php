<?php 
require 'connection.php';
$sqlId = "SELECT id FROM usuario WHERE correo = '".urldecode($_GET["correo"])."'";
$ultimoId = $db->query($sqlId);
if (false === $ultimoId) {
    echo mysql_error();
}
$salida = array();
for($i = 0; $array[$i] = $ultimoId->fetch_assoc(); $i++) {
    $row = array(
        'id' => $array[$i]['id'],
    );
    $salida[$i]=$row;
}


echo json_encode(array('contenido'=>$salida));