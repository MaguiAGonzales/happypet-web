<?php
require_once("cnx.php");
require_once("fechas.php");
date_default_timezone_set("America/Lima");
mb_internal_encoding('UTF-8');

session_start();

class Evento {

    private $_misql;
    public $usuario;

    public function __construct() {
        $this->_misql = new MiSQL;
    }
    
    public function listar(){
        $this->_misql->sql = "SELECT * FROM eventos ORDER BY fecha desc, hora desc";
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $data;
    }

    public function listarDetalle($id){
        $this->_misql->sql = "SELECT * FROM eventos WHERE id=$id";
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $data[0];
    }

    public function insertar($data) {
//        $titulo = htmlentities($data["titulo"]);
//        $descripcion = htmlentities($data["descripcion"]);
//        $fecha = htmlentities(fechaEspIng($data["fecha"]));
//        $hora = htmlentities(hora($data["hora"]));
//        $lugar = htmlentities($data["lugar"]);
//        $referencia = htmlentities($data["referencia"]);

        $fechaActual = date("Y-m-d H:i:s");
        $this->_misql->conectar();
        $this->_misql->sql = "INSERT INTO eventos(titulo, descripcion, fecha, hora, lugar, referencia, created_at) ".
            "VALUES(" .
            "'" . $data["titulo"] ."', ".
            "'" . $data["descripcion"] ."', ".
            "'" . fechaEspIng($data["fecha"]) ."', ".
            "'" . horaMinA24($data["hora"]) ."', ".
            "'" . $data["lugar"] ."', ".
            "'" . $data["referencia"] ."', ".
            "'" . $fechaActual ."') ";
        //echo $this->_misql->sql;
        $this->_misql->ejecutar();
        if($this->_misql->numeroAfectados())
            $idInsertado = $this->_misql->ultimoIdInsertado();
        else
            $idInsertado = 0;
        $this->_misql->cerrar();
        return $idInsertado;
    }

    public function actualizar($data) {
//        $titulo = htmlentities($data["titulo"]);
//        $descripcion = htmlentities($data["descripcion"]);
//        $fecha = htmlentities(fechaEspIng($data["fecha"]));
//        $hora = htmlentities(hora($data["hora"]));
//        $lugar = htmlentities($data["lugar"]);
//        $referencia = htmlentities($data["referencia"]);

        $fechaActual = date("Y-m-d H:i:s");
        $this->_misql->conectar();
        $this->_misql->sql = "UPDATE eventos SET " .
            "titulo='". $data["titulo"] ."', " .
            "descripcion='". $data["descripcion"] ."', " .
            "fecha='". fechaEspIng($data["fecha"]) ."', " .
            "hora='". horaMinA24($data["hora"]) ."', " .
            "lugar='". $data["lugar"] ."', " .
            "referencia='". $data["referencia"] ."', " .
            "updated_at='". $fechaActual ."' ";
        $this->_misql->sql .="WHERE id=". $data["id"];
//        echo $this->_misql->sql;
        $this->_misql->ejecutar();
        $nro = $this->_misql->numeroAfectados();
        $this->_misql->cerrar();
        return $nro;
    }

    public function eliminar($id) {
        $this->_misql->conectar();
        $this->_misql->sql = "DELETE FROM eventos WHERE id=$id";
        $rs = $this->_misql->ejecutar();
        $this->_misql->cerrar();
        return $rs;
    }

}