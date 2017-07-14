<?php
require_once("cnx.php");
date_default_timezone_set("America/Lima");
mb_internal_encoding('UTF-8');

include_once("../funciones/fechas.php");

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
    
    public function listar($data){
        $tipo = isset($data["tipo"]) ? $data["tipo"] : "TODAS";
        $filtro = $tipo == "TODAS" ? "" : " AND tipo='". $tipo ."' ";
        $filtro .= isset($data["id"]) ? " AND id_usuario=" . $data["id"] : "";

        $this->_misql->sql = "SELECT * FROM denuncia WHERE 1=1  $filtro ORDER BY id desc";
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $data;
    }
    
    public function listarDetalle($id){
        $this->_misql->sql = "SELECT * FROM v_denuncia WHERE id=$id";
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $data[0];
    }

    public function insertar($data) {
        $fechaActual = date("Y-m-d H:i:s");
        $this->_misql->conectar();
        $this->_misql->sql = "INSERT INTO denuncia(tipo, fecha, titulo, descripcion, foto, telefono,  estado, id_usuario, created_at) ".
            "VALUES(" .
            "'" . $data["tipo"] ."', ".
            "'" . fechaEspIng($data["fecha"]) ."', ".
            "'" . $data["titulo"] ."', ".
            "'" . $data["descripcion"] ."', ".
            "'" . $data["foto"] ."', ".
            "'" . $data["telefono"] ."', ".
            "'" . $data["estado"] ."', ".
            $data["id_usuario"] . ", " .
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