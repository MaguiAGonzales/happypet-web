<?php 
require 'connection.php';

$sql = "UPDATE mascotas SET nombre = '".utf8_decode(rawurldecode($_GET["nombre"]))."', tipo_mascota = '".utf8_decode(rawurldecode($_GET["tipo"]))."', sexo = '".utf8_decode(rawurldecode($_GET["sexo"]))."', ano_nacimiento = '".utf8_decode(rawurldecode($_GET["anio"]))."', particularidades = '".utf8_decode(rawurldecode($_GET["particularidades"]))."', salud = '".utf8_decode(rawurldecode($_GET["salud"]))."', tamano = '".utf8_decode(rawurldecode($_GET["tamanio"]))."', adoptable = '".utf8_decode(rawurldecode($_GET["adoptable"]))."', es_adoptado = '".utf8_decode(rawurldecode($_GET["adoptado"]))."', esterilizado = '".utf8_decode(rawurldecode($_GET["esterilizado"]))."', imagen = '".utf8_decode(rawurldecode($_POST["imagen"]))."', id_usuario = '".utf8_decode(rawurldecode($_GET["id_usuario"]))."' WHERE id = ".htmlentities($_GET["id"]);
$result = $db->query($sql);

if (false === $result){ 
	echo mysql_error();
}else{
	print_r(json_encode($_POST));
}