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
        $clave = htmlentities($reg['clave']);
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
        $clave = htmlentities($reg['clave']);
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
    public function listarDataTable($postData) {
        global $bd_servidor;
        global $bd_baseDatos;
        global $bd_usuario;
        global $bd_clave;

        extract($postData);

        $aColumns = array('id', 'foto', 'nombre', 'apellidos', 'correo', 'celular', 'direccion', 'admin');
        $sIndexColumn = 'id';
        $sTable = 'usuario';

        $gaSql['user']     = $bd_usuario;
        $gaSql['password'] = $bd_clave;
        $gaSql['db']       = $bd_baseDatos;
        $gaSql['server']   = $bd_servidor;
        $gaSql['port']     = 3306;

        $input =& $_POST;

        $gaSql['charset']  = 'utf8';

        $db = new mysqli($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db'], $gaSql['port']);
        if (mysqli_connect_error()) {
            die( 'Error conectando al servidor MySQL (' . mysqli_connect_errno() .') '. mysqli_connect_error() );
        }

        if (!$db->set_charset($gaSql['charset'])) {
            die( 'Error abriendo el juego de caracteres "'.$gaSql['charset'].'": '.$db->error );
        }


        /**
         * Paginado
         */
        $sLimit = "";
        if ( isset( $input['start'] ) && $input['length'] != '-1' ) {
            $sLimit = " LIMIT ".intval( $input['start'] ).", ".intval( $input['length'] );
        }


        /**
         * Orden
         */
        $aOrderingRules = array();
        if ( isset( $input["order"][0]["column"] ) ) {
            $iSortingCols =  sizeof($input["order"]);
            for ( $i=0 ; $i<$iSortingCols ; $i++ ) {
                if ( $input["columns"][$i]["orderable"] == 'true' ) {
                    $aOrderingRules[] =
                        "`".$aColumns[ intval( $input["order"][$i]["column"] ) ]."` "
                        .($input["order"][0]["dir"]==='asc' ? 'asc' : 'desc');
                }
            }
        }

        if (!empty($aOrderingRules)) {
            $sOrder = " ORDER BY ".implode(", ", $aOrderingRules);
        } else {
            $sOrder = "";
        }

        $iColumnCount = count($aColumns);

        if ( isset($input['search']['value']) && $input['search']['value'] != "" ) {
            $aFilteringRules = array();
            for ( $i=0 ; $i<$iColumnCount ; $i++ ) {
                if ( isset($input["columns"][$i]["searchable"]) && $input["columns"][$i]["searchable"] == 'true' ) {
                    $aFilteringRules[] = "`".$aColumns[$i]."` LIKE '%".$db->real_escape_string( $input['search']['value'] )."%'";
                }
            }
            if (!empty($aFilteringRules)) {
                $aFilteringRules = array('('.implode(" OR ", $aFilteringRules).')');
            }
        }

        // Individual column filtering
        for ( $i=0 ; $i<$iColumnCount ; $i++ ) {
            if ( isset($input["columns"][$i]["searchable"]) && $input["columns"][$i]["searchable"] == 'true' && $input["columns"][$i]["search"]["value"] != '' ) {
                $aFilteringRules[] = "`".$aColumns[$i]."` LIKE '%".$db->real_escape_string($input["columns"][$i]["search"]["value"])."%'";
            }
        }

        if (!empty($aFilteringRules)) {
            $sWhere = " WHERE ".implode(" AND ", $aFilteringRules);
        } else {
            $sWhere = "";
        }

        $aQueryColumns = array();
        foreach ($aColumns as $col) {
            if ($col != ' ') {
                $aQueryColumns[] = $col;
            }
        }

        $sQuery = "
            SELECT SQL_CALC_FOUND_ROWS `".implode("`, `", $aQueryColumns)."`
            FROM `".$sTable."`".$sWhere.$sOrder.$sLimit;

        $rResult = $db->query( $sQuery ) or die($db->error);

        // Data set length after filtering
        $sQuery = "SELECT FOUND_ROWS()";
        $rResultFilterTotal = $db->query( $sQuery ) or die($db->error);
        list($iFilteredTotal) = $rResultFilterTotal->fetch_row();

        // Total data set length
        $sQuery = "SELECT COUNT(`".$sIndexColumn."`) FROM `".$sTable."`";
        $rResultTotal = $db->query( $sQuery ) or die($db->error);
        list($iTotal) = $rResultTotal->fetch_row();


        /**
         * Output
         */
        $output = array(
            "draw"                => intval($input['draw']),
            "recordsTotal"        => $iTotal,
            "recordsFiltered" => $iFilteredTotal,
            "data"               => array(),
        );

        while ( $aRow = $rResult->fetch_assoc() ) {
            $output['data'][] = $aRow;
        }

        return json_encode( $output );
    }
    public function insertar($data) {
        $nombre = htmlentities($data["nombre"]);
        $apellidos = htmlentities($data["apellidos"]);
        $ciudad = htmlentities($data["ciudad"]);
        $correo = htmlentities($data["correo"]);
        $dni = htmlentities($data["dni"]);
        $direccion= htmlentities($data["direccion"]);
        $referencia = $data["referencia"];
        $contrasenia = htmlentities($data["contrasenia"]);
        $celular = htmlentities($data["celular"]);
        $ocupacion = $data["ocupacion"];
        $fecha_nacimiento = htmlentities($data["fecha_nacimiento"]);
        $telefono = htmlentities($data["telefono"]);
        $imagen = htmlentities($data["foto"]);
        $admin = htmlentities($data["administrador"]);

        $fechaActual = date("Y-m-d H:i:s");
        $this->_misql->conectar();
        $this->_misql->sql = "INSERT INTO usuario(nombre, apellidos, ciudad, correo, celular, foto, dni,  ocupacion, fecha_nacimiento, telefono, direccion, referencia, contrasenia, admin, created_at) ".
            "VALUES(" .
            "'" . $nombre ."', ".
            "'" . $apellidos ."', ".
            "'" . $ciudad ."', ".
            "'" . $correo ."', ".
            "'" . $celular ."', ".
            "'" . $imagen ."', ".
            "'" . $dni ."', ".
            "'" . $ocupacion ."', ".
            "'" . $fecha_nacimiento ."', ".
            "'" . $telefono ."', ".
            "'" . $direccion ."', ".
            "'" . $referencia ."', ".
            "'" . $contrasenia ."', ".
            "'" . $admin ."', ".
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

    public function save_editar($data) {
        $nombre = htmlentities($data["nombre"]);
        $apellidos = htmlentities($data["apellidos"]);
        $ciudad = htmlentities($data["ciudad"]);
        $correo = htmlentities($data["correo"]);
        $dni = htmlentities($data["dni"]);
        $direccion= htmlentities($data["direccion"]);
        $referencia = $data["referencia"];
        $contrasenia = htmlentities($data["contrasenia"]);
        $celular = htmlentities($data["celular"]);
        $ocupacion = $data["ocupacion"];
        $fecha_nacimiento = htmlentities($data["fecha_nacimiento"]);
        $telefono = htmlentities($data["telefono"]);
        if(!empty($data["foto"]))
            $imagen = htmlentities($data["foto"]);
        $id = htmlentities($data["id"]);
        $admin = htmlentities($data["administrador"]);

        $fechaActual = date("Y-m-d H:i:s");
        $this->_misql->conectar();
        if(!empty($data["foto"])) {
            $this->_misql->sql = "UPDATE usuario SET nombre = '" . $nombre . "', " .
                "apellidos = '" . $apellidos . "', " .
                "ciudad = '" . $ciudad . "', " .
                "correo = '" . $correo . "', " .
                "celular = '" . $celular . "', " .
                "foto = '" . $imagen . "', " .
                "dni = '" . $dni . "', " .
                "ocupacion = '" . $ocupacion . "', " .
                "fecha_nacimiento = '" . $fecha_nacimiento . "', " .
                "telefono = '" . $telefono . "', " .
                "direccion = '" . $direccion . "', " .
                "referencia = '" . $referencia . "', " .
                "contrasenia = '" . $contrasenia . "', " .
                "admin = '" . $admin . "', " .
                "updated_at = '" . $fechaActual . "'" .
                "WHERE id = " . $id;
        }else{
            $this->_misql->sql = "UPDATE usuario SET nombre = '" . $nombre . "', " .
                "apellidos = '" . $apellidos . "', " .
                "ciudad = '" . $ciudad . "', " .
                "correo = '" . $correo . "', " .
                "celular = '" . $celular . "', " .
                "dni = '" . $dni . "', " .
                "ocupacion = '" . $ocupacion . "', " .
                "fecha_nacimiento = '" . $fecha_nacimiento . "', " .
                "telefono = '" . $telefono . "', " .
                "direccion = '" . $direccion . "', " .
                "referencia = '" . $referencia . "', " .
                "contrasenia = '" . $contrasenia . "', " .
                "admin = '" . $admin . "', " .
                "updated_at = '" . $fechaActual . "'" .
                "WHERE id = " . $id;
        }

        //echo $this->_misql->sql;
        $this->_misql->ejecutar();

        return $id;
    }

    public function eliminar($id) {
        $this->_misql->conectar();
        $this->_misql->sql = "DELETE FROM usuario WHERE id=$id";
        $rs = $this->_misql->ejecutar();
        $this->_misql->cerrar();
        return $rs;
    }

    public function editar($id){
        $this->_misql->sql = "SELECT * FROM usuario WHERE id=" . $id;
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $data[0];
    }
}