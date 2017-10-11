<?php 
require 'connection.php';

$sql = "UPDATE extraviado SET extraviado_encontrado = 1 WHERE id = ".htmlentities($_GET["id"]);
$result = $db->query($sql);

if (false === $result){ 
	echo mysql_error();
}else{
	print_r(json_encode($_POST));
}