<?php
require_once("cnx.php");
date_default_timezone_set("America/Lima");
mb_internal_encoding('UTF-8');

session_start();

class Extraviado {

    private $_misql;
    public $usuario;

    public function __construct() {
        $this->_misql = new MiSQL;
    }

	public function listar(){
        $this->_misql->sql = "SELECT * FROM v_extraviado WHERE extraviado_encontrado = 0 ORDER BY fecha desc";
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $data;
    }
    
	public function listar_extraviado(){
        $this->_misql->sql = "SELECT * FROM v_extraviado WHERE encontrado=0 AND extraviado_encontrado = 0 ORDER BY fecha desc";
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $data;
    }

    public function listar_encontrado(){
        $this->_misql->sql = "SELECT * FROM v_extraviado WHERE encontrado=1 AND extraviado_encontrado = 0 ORDER BY fecha desc";
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $data;
    }
	
	public function mi_lista($id){
        $this->_misql->sql = "SELECT * FROM v_extraviado WHERE id_mascota IN (SELECT id FROM mascotas WHERE id_usuario = " . $id . ") AND extraviado_encontrado = 0 ORDER BY fecha desc";
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $data;
    }
    
	public function mi_lista_extraviado($id){
        $this->_misql->sql = "SELECT * FROM v_extraviado WHERE encontrado=0 AND id_mascota IN (SELECT id FROM mascotas WHERE id_usuario = " . $id . ") AND extraviado_encontrado = 0 ORDER BY fecha desc";
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $data;
    }

    public function mi_listar_encontrado($id){
        $this->_misql->sql = "SELECT * FROM v_extraviado WHERE encontrado=1 AND id_mascota IN (SELECT id FROM mascotas WHERE id_usuario = " . $id . ") AND extraviado_encontrado = 0 ORDER BY fecha desc";
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $data;
    }
    
    public function listarDetalle($id){
        $this->_misql->sql = "SELECT de.*, CONCAT(usu.nombre,' ',usu.apellidos) as nombres, usu.dni, usu.direccion, usu.referencia, usu.telefono, usu.correo " . 
            "FROM denuncia AS de inner JOIN usuario as usu ON de.id_usuario = usu.id WHERE de.id=$id";
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $data[0];
    }

//    public function insertar($data) {
//        $nombre = htmlentities($data["nombre"]);
//        $tipo = htmlentities($data["tipo"]);
//        $sexo = htmlentities($data["sexo"]);
//        $anio = htmlentities($data["anio"]);
//        $particilaridades = htmlentities($data["particularidades"]);
//        $salud = htmlentities($data["salud"]);
//        $adoptado = htmlentities($data["adoptado"]);
//        $imagen = htmlentities($data["imagen"]);
//        
//        $fechaActual = date("Y-m-d H:i:s");
//        $this->_misql->conectar();
//        $this->_misql->sql = "INSERT INTO mascotas(nombre, tipo_mascota, sexo, particularidades, salud, ano_nacimiento,  es_adoptado, imagen,id_usuario) ".
//            "VALUES(" .
//            "'" . $nombre ."', ".
//            "'" . $tipo ."', ".
//            "'" . $sexo ."', ".
//            "'" . $particilaridades ."', ".
//            "'" . $salud ."', ".
//            $anio . ", " .
//            "'" . $adoptado ."', ".
//            "'" . $imagen ."', ".
//            "1)";
//        //echo $this->_misql->sql;
//        $this->_misql->ejecutar();
//        if($this->_misql->numeroAfectados())
//            $idInsertado = $this->_misql->ultimoIdInsertado();
//        else
//            $idInsertado = 0;
//        $this->_misql->cerrar();
//        return $idInsertado;
//    }
    
    
/*
    public function actualizar($data) {
        $dni = isset($data["dni"]) ? $data["dni"] : "";
        $nombres = isset($data["nombres"]) ? $data["nombres"] : "";
        $paterno = isset($data["paterno"]) ? $data["paterno"] : "";
        $materno = isset($data["materno"]) ? $data["materno"] : "";
        $sexo = isset($data["sexo"]) ? $data["sexo"] : "";
        if(isset($data["ruc"])){
            $ruc = $data["ruc"];
            $sexo = "";
        }
        $razon_social = isset($data["razon_social"]) ? $data["razon_social"] : "";

        $fechaActual = date("Y-m-d H:i:s");
        $this->_misql->conectar();
        $this->_misql->sql = "UPDATE cliente SET " .
            "dni='". $dni ."', " .
            "nombres='". $nombres ."', " .
            "paterno='". $paterno ."', " .
            "materno='". $materno ."', " .
            "sexo='". $sexo ."', " .
            "ruc='". $ruc ."', " .
            "razon_social='". $razon_social ."', " .
            "telefono='". $data["telefono"] ."', " .
            "direccion='". $data["direccion"] ."', " .
            "correo='". $data["correo"] ."', " .
            "editor=". $_SESSION["id"] .", " .
            "edicion_fecha='". $fechaActual ."' ";
        $this->_misql->sql .="WHERE id=". $data["id"];
        $this->_misql->ejecutar();
        $nro = $this->_misql->numeroAfectados();
        $this->_misql->cerrar();
        return $nro;
    }

*/
    public function eliminar($id) {
        $this->_misql->conectar();
        $this->_misql->sql = "DELETE FROM denuncia WHERE id=$id";
        $rs = $this->_misql->ejecutar();
        $this->_misql->cerrar();
        return $rs;
    }
    
    public function ceros($texto, $cantidad=2){
        return str_pad($texto, 2, "0", STR_PAD_LEFT);
    }

}