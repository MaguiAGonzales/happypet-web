<?php 
require 'connection.php';

$sql = "SELECT * FROM usuario WHERE id = ".$_GET["id"];

$result = $db->query($sql);

if (false === $result){ 
	echo mysql_error();
}

$salida = array();

for($i = 0; $array[$i] = $result->fetch_assoc(); $i++){
	$row = array(
			'id' => utf8_encode($array[$i]['id']),
			'nombre' => utf8_encode($array[$i]['nombre']),
			'apellidos' => utf8_encode($array[$i]['apellidos']),
			'ciudad' => utf8_encode($array[$i]['ciudad']),
			'correo' => utf8_encode($array[$i]['correo']),
			'contrasenia' => utf8_encode($array[$i]['contrasenia']),
			);
	$salida[$i]=$row;
}

echo json_encode(array('contenido'=>$salida));