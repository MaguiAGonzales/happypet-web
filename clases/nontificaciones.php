<?php 

require 'connection.php';
$sqlTot = "SELECT notificaciones.idnotificacion, notificaciones.titulo, notificaciones.texto FROM notificaciones LEFT JOIN notificaciones_enviadas ON notificaciones_enviadas.idnotificacion = notificaciones.idnotificacion WHERE notificaciones.idnotificacion NOT IN(SELECT idnotificacion FROM notificaciones_enviadas WHERE imei = '".$_GET["imei"]."') LIMIT 1";
$tot = $db->query($sqlTot);
if (false === $tot) {
	echo mysql_error();
}
$salida = array();
for($i = 0; $array[$i] = $tot->fetch_assoc(); $i++){	
	$sql = "INSERT INTO notificaciones_enviadas (idnotificacion, imei) VALUES (".$array[$i]['idnotificacion'].", '".$_GET["imei"]."')";
	$result = $db->query($sql);

	if (false === $result){ 
		echo mysql_error();
	}
	$row = array(		
		'imagen' => '',
		'titulo' => utf8_encode($array[$i]['titulo']),
		'texto' => utf8_encode($array[$i]['texto']),
		);
	$salida[$i]=$row;
}

echo json_encode(array('contenido'=>$salida));