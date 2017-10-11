<?php 
require 'connection.php';

$sql = "SELECT mascotas.id, mascotas.nombre, mascotas.imagen FROM adopciones JOIN mascotas on mascotas.id = adopciones.id_mascota WHERE estado = 'TE' AND adopciones.id_usuario = ".$_GET["id"]." AND adopciones.id_mascota NOT IN(SELECT id_mascota FROM extraviado WHERE encontrado = 0  AND extraviado_encontrado = 0)".
" UNION SELECT id, nombre, imagen FROM mascotas WHERE id_usuario = ".$_GET["id"]." AND id NOT IN(SELECT id_mascota FROM extraviado WHERE encontrado = 0 AND extraviado_encontrado = 0)";

$result = $db->query($sql);

if (false === $result) {
	echo mysql_error();
}

$salida = array();

for($i = 0; $array[$i] = $result->fetch_assoc(); $i++){
	$row = array(
		'id' => $array[$i]['id'],
		'nombre' => $array[$i]['nombre'],
		'imagen' => $array[$i]['imagen'],
		);
	$salida[$i]=$row;
}

echo json_encode(array('agenda'=>$salida));