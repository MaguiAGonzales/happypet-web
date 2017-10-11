<?php 

require 'connection.php';
$sqlTot = "SELECT id_visita_adopcion, CONCAT('Adopcion de: ', mascotas.nombre) AS titulo, CONCAT('Se programo una visita para el ', fecha , ' a las ', hora) AS texto, usuario.id, usuario.foto, CONCAT(usuario.apellidos, ' ', usuario.nombre) AS nombre, adopciones.id AS adopcion_id, usuario.correo, mascotas.id AS id_mascota, mascotas.imagen AS foto_mascota, mascotas.nombre AS nombre_mascota, mascotas.tipo_mascota, mascotas.sexo AS sexo_mascota, mascotas.particularidades, mascotas.salud, mascotas.ano_nacimiento, adopciones.estado, visita_adopcion.fecha, visita_adopcion.hora, visita_adopcion.descripcion FROM adopciones JOIN visita_adopcion ON visita_adopcion.id = adopciones.id_visita_adopcion JOIN mascotas on mascotas.id = adopciones.id_mascota JOIN usuario ON usuario.id = adopciones.id_usuario WHERE adopciones.id_usuario = ".$_GET["id_usuario"]." AND estado_notificacion = 0 LIMIT 1";

$tot = $db->query($sqlTot);
if (false === $tot) {
	echo mysql_error();
}
$n = 0;
$salida = array();
for($i = 0; $array[$i] = $tot->fetch_assoc(); $i++){
	$row = array(
	    'id_notificacion' => $n,
		'imagen' => $array[$i]['foto'],
		'id_visita_adopcion' => utf8_encode($array[$i]['id_visita_adopcion']),
		'titulo' => $array[$i]['titulo'],
		'texto' => $array[$i]['texto'],
        'id' => $array[$i]['id'],
        'nombre' => $array[$i]['nombre'],
        'correo' => $array[$i]['correo'],
        'desde' => 'visita',
        'data' => $array[$i]['adopcion_id'].'#'.$array[$i]['id_mascota'].'#'.$array[$i]['foto_mascota'].'#'.$array[$i]['nombre_mascota'].'#'.$array[$i]['tipo_mascota'].'#'.$array[$i]['sexo_mascota'].'#'.$array[$i]['particularidades'].'#'.$array[$i]['salud'].'#'.$array[$i]['ano_nacimiento'].'#'.$array[$i]['estado'].'#'.$array[$i]['fecha'].'#'.$array[$i]['hora'].'#'.$array[$i]['descripcion']
		);
	$salida[$n]=$row;
    $n++;
}

$sqlEvento = "SELECT eventos.id, eventos.titulo, CONCAT(eventos.descripcion, ' fecha ', eventos.fecha , ' hora', eventos.hora, ' lugar ', eventos.lugar) AS texto FROM eventos LEFT JOIN notificacion_evento ON notificacion_evento.id_evento = eventos.id WHERE eventos.id NOT IN(SELECT id_evento FROM notificacion_evento WHERE id_usuario = ".$_GET["id_usuario"].")";
$eve = $db->query($sqlEvento);
if (false === $eve) {
	echo mysql_error();
}
for($j = 0; $array[$j] = $eve->fetch_assoc(); $j++){
    if($_GET["id_usuario"] !== "0") {
        $sqlInsEvento = "INSERT INTO notificacion_evento (id_evento, id_usuario) VALUES (" . $array[$j]['id'] . ", '" . $_GET["id_usuario"] . "')";
        $result = $db->query($sqlInsEvento);
    }

	if (false === $result){
		echo mysql_error();
	}
	$row = array(
        'id_notificacion' => $n,
		'imagen' => '',
		'id_visita_adopcion' => '',
		'titulo' => $array[$j]['titulo'],
		'texto' => $array[$j]['texto'],
        'id' => '',
        'nombre' => '',
        'correo' => '',
        'desde' => 'evento',
        'data' => ''
		);
	$salida[$n]=$row;
    $n++;
}

$usuario_is = "";
$nombre_usuario = "";
$foto_usuario = "";
$correo_usuario = "";
$sqlUsuario = "SELECT id, foto, CONCAT(apellidos, ' ', nombre) AS nombre, correo  FROM usuario WHERE id = ".$_GET["id_usuario"];

$adoUs = $db->query($sqlUsuario);
if (false === $adoUs) {
    echo mysql_error();
}
for($l = 0; $array[$l] = $adoUs->fetch_assoc(); $l++){
    $usuario_is = $array[$l]['id'];
    $nombre_usuario = $array[$l]['nombre'];
    $foto_usuario = $array[$l]['foto'];
    $correo_usuario = $array[$l]['correo'];
}


$sqlAdopcion = "SELECT mascotas.id, CONCAT ('Soy ', mascotas.nombre, ' soy un ', mascotas.tipo_mascota, ' ', mascotas.sexo, ' de tamaño ', mascotas.tamano) AS texto FROM mascotas JOIN adopciones ON adopciones.id_mascota = mascotas.id LEFT JOIN notificacion_adopcion ON notificacion_adopcion.id_adopcion = mascotas.id WHERE mascotas.id NOT IN(SELECT id_adopcion FROM notificacion_adopcion WHERE id_usuario = ".$_GET["id_usuario"].") AND adoptable = 1 AND adopciones.estado = 'F1'";
$ado = $db->query($sqlAdopcion);
if (false === $ado) {
	echo mysql_error();
}
for($k = 0; $array[$k] = $ado->fetch_assoc(); $k++){
    if($_GET["id_usuario"] !== "0") {
        $sql = "INSERT INTO notificacion_adopcion (id_adopcion, id_usuario) VALUES (" . $array[$k]['id'] . ", '" . $_GET["id_usuario"] . "')";
        $result = $db->query($sql);
    }

	if (false === $result){
		echo mysql_error();
	}
	$row = array(
        'id_notificacion' => $n,
		'imagen' => $foto_usuario,
		'id_visita_adopcion' => '',
		'titulo' => 'Adoptame',
		'texto' => $array[$k]['texto'],
        'id' => $usuario_is,
        'nombre' => $nombre_usuario,
        'correo' => $correo_usuario,
        'desde' => 'login',
        'data' => ''
		);
	$salida[$n]=$row;
    $n++;
}

echo json_encode(array('contenido'=>$salida), JSON_UNESCAPED_UNICODE);