<?php 
require 'connection.php';
$insertado = '';
$sqlTot = "SELECT COUNT(id) AS existe FROM usuario WHERE correo = '".urldecode($_GET["correo"])."'";
$tot = $db->query($sqlTot);
if (false === $tot) {
    echo mysql_error();
}
$salida = array();
if($tot->fetch_row()[0]=='0'){
    $f = explode('/', urldecode($_GET["fecha_nacimiento"]));
    $sql = "INSERT INTO usuario (nombre, apellidos, correo, fecha_nacimiento, foto) VALUES ('".utf8_decode(rawurldecode($_GET["nombre"]))."', '".utf8_decode(rawurldecode($_GET["apellidos"]))."', '".utf8_decode(rawurldecode($_GET["correo"]))."', '".$f[2]."-".$f[0]."-".$f[1]."', '".utf8_decode(rawurldecode($_POST["imagen"]))."')";
    $result = $db->query($sql);
    $insertado = $db->insert_id;
    if (false === $result) {
        echo mysql_error();
    }
    $row = array(
        'imagen' => '',
        'titulo' => $insertado,
        'texto' => '',
    );
    $salida[0]=$row;
}else{
    $f = explode('/', urldecode($_GET["fecha_nacimiento"]));
    $sql = "UPDATE usuario SET nombre = '".utf8_decode(rawurldecode($_GET["nombre"]))."', apellidos = '".utf8_decode(rawurldecode($_GET["apellidos"]))."', correo = '".utf8_decode(rawurldecode($_GET["correo"]))."', fecha_nacimiento = '".$f[2]."-".$f[0]."-".$f[1]."', foto = '".utf8_decode(rawurldecode($_POST["imagen"]))."' WHERE correo = '".utf8_decode(rawurldecode($_GET["correo"]))."'";
    $result = $db->query($sql);
    if (false === $result){
        echo mysql_error();
    }
    $sqlId = "SELECT id FROM usuario WHERE correo = '".urldecode($_GET["correo"])."'";
    $ultimoId = $db->query($sqlId);

    for($i = 0; $array[$i] = $ultimoId->fetch_assoc(); $i++) {
        $row = array(
            'imagen' => '',
            'titulo' => $array[$i]['id'],
            'texto' => '',
        );
        $salida[$i]=$row;
    }
}

echo json_encode(array('contenido'=>$salida));