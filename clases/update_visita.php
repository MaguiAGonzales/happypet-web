<?php 
require 'connection.php';

$sql = "UPDATE visita_adopcion SET estado_notificacion = 1 WHERE id = ".rawurldecode($_GET["id"]);

$result = $db->query($sql);

if (false === $result){ 
	echo mysql_error();
}else{
	print_r(json_encode($_POST));
}