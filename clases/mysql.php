<?php


class MiSQL{
    public $cn;     public $rs;		public $sql;    public $sqlError;

    public function __construct(){
        //$this->conectar();
    }

    public function conectar(){
        global $bd_servidor;
        global $bd_baseDatos;
        global $bd_usuario;
        global $bd_clave;

        $this->cn  = mysqli_connect($bd_servidor, $bd_usuario, $bd_clave, $bd_baseDatos);

        if (!$this->cn ) {
            $msjeError = "Error: No se puede conectar a MYSQL" . PHP_EOL . "<br>";
            $msjeError .= "Error Nro: " . mysqli_connect_errno() . PHP_EOL . "<br>";
            $msjeError .= "Error Msje: " . mysqli_connect_error() . PHP_EOL;
            
            die($msjeError);
        }
        
        mysqli_query($this->cn, "SET NAMES 'utf8'");
        return $this->cn;
    }

    public function ejecutar($sql=""){
        if ($sql!="") {
            $this->sql=$sql;
        }
        $this->rs = mysqli_query($this->cn, $this->sql) or die ("Error al ejecutar SQL : ". mysqli_error($this->cn));
        //$this->sqlError = mysqli_error($this->cn);
        return $this->rs;
    }

    public function ejecutar_multi($sql=""){
        if ($sql!="") {
            $this->sql=$sql;
        }
        $this->rs = mysqli_multi_query($this->cn, $this->sql) or die ("Error al ejecutar SQL MULTI : ". mysqli_error($this->cn));
        return $this->rs;
    }

    public function numeroRegistros(){
        return mysqli_num_rows($this->rs);
    }

    public function numeroAfectados(){
        return mysqli_affected_rows($this->cn);
    }

    public function devolverArreglo($sql=""){
        if ($sql != "") $this->sql = $sql;
        $this->conectar();
        $this->rs = $this->ejecutar();
        $datos = Array();
        while ($reg = mysqli_fetch_assoc($this->rs)) {
            $datos[] = $reg;
        }
        return $datos;
    }

    public function devolverArregloNumero($sql=""){
        if ($sql != "") $this->sql = $sql;
        $this->conectar();
        $this->rs = $this->ejecutar();

        while ($reg = mysqli_fetch_row($this->rs)) {
            $datos[] = $reg;
        }
        return $datos;
    }

    public function devolverJSON($sql = ""){
        if ($sql != "") $this->sql = $sql;
        $datos = $this->devolverArreglo();
        return json_encode($datos);
    }

    public function liberar($rs=""){
        if ($rs!="")
            mysqli_free_result($rs);
        else
            mysqli_free_result($this->rs);
    }

    public function cerrar($cn=""){
        mysqli_close($this->cn);
    }

    public function liberarYcerrar(){
        mysqli_free_result($this->rs);
        mysqli_close($this->cn);
    }


    public function ultimoIdInsertado(){
        return mysqli_insert_id($this->cn);
    }

    public function begin(){
        mysqli_autocommit($this->cn, FALSE) or die ("Error al ejecutar SQL BEGIN: ". mysqli_error($this->cn));
        //mysqli_query($this->cn, "BEGIN") or die ("Error al ejecutar SQL BEGIN: ". mysqli_error($this->cn));
    }

    public function commit(){
        //mysqli_query($this->cn, "COMMIT") or die ("Error al ejecutar SQL COMMIT: ". mysqli_error($this->cn));
        mysqli_commit($this->cn) or die ("Error al ejecutar SQL COMMIT : ". mysqli_error($this->cn));
    }

    public function rollback(){
        //mysqli_query($this->cn, "ROLLBACK") or die ("Error al ejecutar SQL ROLLBACK: ". mysqli_error($this->cn));
        mysqli_rollback($this->cn) or die ("Error al ejecutar SQL ROLLBACK: ". mysqli_error($this->cn));
    }

}