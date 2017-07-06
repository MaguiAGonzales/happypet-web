<?php

require_once("cnx.php");
date_default_timezone_set("America/Lima");
mb_internal_encoding('UTF-8');

session_start();

class Usuario {

    private $_misql;
    public $usuario;

    public function __construct() {
        $this->_misql = new MiSQL;
    }

    public function validar($reg) {
        $usuario = htmlentities($reg['usuario']);
        $clave = md5(htmlentities($reg['clave']));
        $this->_misql->sql = "SELECT * FROM usuario ";
        $this->_misql->sql.="WHERE correo='$usuario' AND contrasenia='$clave' ";
        //echo $this->_misql->sql;
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        if ($this->_misql->numeroRegistros() > 0) {
            $datos = $this->_misql->devolverArreglo();
            $this->_misql->liberarYcerrar();

            if($datos[0]["admin"] == 1){
                $_SESSION = $datos[0];
                return 1;
            }else{
                return -1;
            }    
        }
        else
            return 0;
    }
    
    public function validarAcceso($reg){
        $usuario = htmlentities($reg['usuario']);
        $clave = md5(htmlentities($reg['clave']));
        $this->_misql->sql = "SELECT * FROM usuario ";
        $this->_misql->sql.="WHERE correo='$usuario' AND contrasenia='$clave' ";
        //echo $this->_misql->sql;
        $this->_misql->conectar();
        $this->_misql->ejecutar();
//        if ($this->_misql->numeroRegistros() > 0) {
//            $datos = $this->_misql->devolverArreglo();
//            $this->_misql->liberarYcerrar();
//
//            return $datos[0];
//        }
//        else
//            return array();
        $datos = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $datos;
    }

    public function listar($data){
        $filtro = isset($data["id"])? " WHERE id=" . $data["id"] : "";
        $this->_misql->sql = "SELECT id, nombre, apellidos, dni, fecha_nacimiento, telefono, direccion, referencia FROM usuario $filtro ORDER BY id desc";
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $datos = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $datos;
    }
    
}