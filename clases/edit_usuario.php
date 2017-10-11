<?php 
require 'connection.php';

$sql = "UPDATE usuario SET nombre = '".utf8_decode(rawurldecode($_GET["nombre"]))."', apellidos = '".utf8_decode(rawurldecode($_GET["apellidos"]))."', ciudad = '".utf8_decode(rawurldecode($_GET["ciudad"]))."', correo = '".utf8_decode(rawurldecode($_GET["correo"]))."', foto = '".utf8_decode(rawurldecode($_POST["imagen"]))."', contrasenia = '".utf8_decode(rawurldecode($_GET["contrasenia"]))."' WHERE id = ".rawurldecode($_GET["id"]);

$result = $db->query($sql);

if (false === $result){ 
	echo mysql_error();
}else{
	print_r(json_encode($_POST));
}