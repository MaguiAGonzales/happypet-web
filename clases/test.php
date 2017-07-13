<?php
require_once("cnx.php");
date_default_timezone_set("America/Lima");
mb_internal_encoding('UTF-8');

session_start();

class Test {

    private $_misql;

    public function __construct() {
        $this->_misql = new MiSQL;
    }
    
    public function info($id){
        $this->_misql->sql = "SELECT * FROM test WHERE id = " . $id;
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();

        return $data[0];
    }
}