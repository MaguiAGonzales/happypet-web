<?php 
require 'connection.php';
$f = explode('/', urldecode($_GET["fecha"]));
$sql = "INSERT INTO extraviado (fecha, detalle, encontrado, id_mascota, telefono, titulo, imagen) VALUES ('".$f[2]."-".$f[1]."-".$f[0]."', '".urldecode($_GET["detalle"])."', ".urldecode($_GET["encontrado"]).", ".urldecode($_GET["id_mascota"]).", '".urldecode($_GET["telefono"])."', '".urldecode($_GET["titulo"])."', '".utf8_decode(rawurldecode($_POST["imagen"]))."')";

$result = $db->query($sql);

if (false === $result){ 
	echo mysql_error();
}else{
	echo(json_encode($_POST));
}