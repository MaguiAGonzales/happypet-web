<?php
require_once("cnx.php");
date_default_timezone_set("America/Lima");
mb_internal_encoding('UTF-8');

session_start();

class Horario {

    private $_misql;

    public function __construct() {
        $this->_misql = new MiSQL;
    }
    
    public function listarHorario($id){
        $this->_misql->sql = "SELECT * FROM horario WHERE id = " . $id;
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();

        $dias = ($data[0]["lunes"] == 1) ? "Lunes, " : "";
        $dias .= ($data[0]["martes"] == 1) ? "Martes, " : "";
        $dias .= ($data[0]["miercoles"] == 1) ? "Miercoles, " : "";
        $dias .= ($data[0]["jueves"] == 1) ? "Jueves, " : "";
        $dias .= ($data[0]["viernes"] == 1) ? "Viernes, " : "";
        $dias = substr($dias, 0, strlen($dias) - 2);

        $horas = "Mañana : " . $data[0]["maniana_ini"] . " a " . $data[0]["maniana_fin"] . " y ";
        $horas .= "Tarde : " . $data[0]["tarde_ini"] . " a " . $data[0]["tarde_fin"];

        return array("dias" => $dias , "horas" => $horas);
    }
}