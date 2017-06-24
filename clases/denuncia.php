<?php
require_once("cnx.php");
date_default_timezone_set("America/Lima");

session_start();

class Denuncia {

    private $_misql;
    public $usuario;

    public function __construct() {
        $this->_misql = new MiSQL;
    }
    
    public function listarTotales(){
        $this->_misql->sql = "SELECT tipo, COUNT(id) AS total FROM denuncia GROUP BY tipo";
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();  
        return array(
            $data[0]["tipo"] => $this->ceros($data[0]["total"]) ,
            $data[1]["tipo"] => $this->ceros($data[1]["total"]) ,
            $data[2]["tipo"] => $this->ceros($data[2]["total"]));
    }
    
    public function listar($tipo){
        $this->_misql->sql = "SELECT * FROM denuncia WHERE tipo='". $tipo ."' ORDER BY id desc";
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