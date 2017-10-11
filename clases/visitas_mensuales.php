<?php
require_once("cnx.php");
date_default_timezone_set("America/Lima");
mb_internal_encoding('UTF-8');

session_start();

include_once("../funciones/fechas.php");

class Visitas_mensuales {

    private $_misql;
    public $usuario;

    public function __construct() {
        $this->_misql = new MiSQL;
    }
    
    public function listarDataTable($postData) {
        global $bd_servidor;
        global $bd_baseDatos;
        global $bd_usuario;
        global $bd_clave;

        extract($postData);

        $aColumns = array('id_mascota', 'imagen', 'nombre', 'usuario', 'fecha', 'estado', 'tipo_mascota', 'sexo', 'ano_nacimiento', 'dni', 'direccion', 'referencia', 'resultado', 'id_test', 'id_visita_adopcion','fecha_adopcion','hora_adopcion','descripcion_adopcion', "telefono", "celular", "ciudad", "ocupacion", "id_horario");
        $sIndexColumn = 'id';
        $sTable = 'v_adopcion';

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
            $sWhere = " WHERE estado = 'TE' AND ".implode(" AND ", $aFilteringRules);
        } else {
            $sWhere = " WHERE estado = 'TE' ";
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

    public function info($id){
        $this->_misql->sql = "SELECT * FROM adopciones WHERE id=" . $id;
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $data[0];
    }

    public function listar($data){
        $filtro = (isset($data["id_usuario"]) ? "WHERE id_usuario =" . $data["id_usuario"] : "");
        $this->_misql->sql = "SELECT * FROM v_adopcion ". $filtro ." ORDER BY id desc";
//        echo $this->_misql->sql;
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $data;
    }

    public function listarVisitas($data){
        $this->_misql->sql = "SELECT * FROM visita_mensual WHERE id_mascota = ". $data["id_mascota"] ." ORDER BY id desc";
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $data;
    }

    public function listarDisponibles($data){
        $filtro = (isset($data["id_usuario"]) ? "WHERE id_usuario =" . $data["id_usuario"] : "");
        $this->_misql->sql = "SELECT id, nombre, ano_nacimiento, imagen, tipo_mascota, sexo, particularidades, salud ".
            "FROM v_mascotas_disponibles ". $filtro ." ORDER BY id desc";
//        echo $this->_misql->sql;
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $data;
    }

    public function visitaAdopcion($data) {
        $fechaActual = date("Y-m-d H:i:s");
        $this->_misql->conectar();
        $this->_misql->sql = "INSERT INTO visita_adopcion(fecha,hora,descripcion,created_at) ".
            "VALUES(" .
            "'" . fechaEspIng($data["fecha"]). "', " .
            "'" . horaMinA24($data["hora"]) . "', " .
            "'" . $data["descripcion"] . "', " .
            "'" . $fechaActual . "') ";
        $this->_misql->ejecutar();
        if($this->_misql->numeroAfectados()) {
            $idInsertado = $this->_misql->ultimoIdInsertado();
            $this->_misql->sql = "UPDATE adopciones SET id_visita_adopcion = ". $idInsertado . ", estado='TE' " . " WHERE id = " . $data["ida"];
            $this->_misql->ejecutar();
        }else
            $idInsertado = 0;
        $this->_misql->cerrar();
        return $idInsertado;
    }

    public function insertar($data) {
        $nombre_voluntario = htmlentities($data["nombre_voluntario"]);
        $nombre_persona_atiende = htmlentities($data["nombre_persona_atiende"]);
        $parentesco = htmlentities($data["parentesco"]);
        $telefono = htmlentities($data["telefono"]);
        $p1 = htmlentities($data["p1"]);
        $r1= htmlentities($data["r1"]);
        $p2 = $data["p2"];
        $r2 = htmlentities($data["r2"]);
        $p3 = htmlentities($data["p3"]);
        $r3 = $data["r3"];
        $p4 = htmlentities($data["p4"]);
        $r4 = htmlentities($data["r4"]);
        $veterinaria = htmlentities($data["veterinaria"]);
        $fecha_esterilizacion = htmlentities($data["fecha_esterilizacion"]);
        $id_mascota = htmlentities($data["id_mascota"]);

        $fechaActual = date("Y-m-d H:i:s");
        $this->_misql->conectar();
        $this->_misql->sql = "INSERT INTO visita_mensual(nombre_voluntario, nombre_persona_atiende, parentesco, telefono, p1, r1, p2,  r2, p3, r3, p4, r4, veterinaria, fecha_esterilizacion, id_mascota, created_at) ".
            "VALUES(" .
            "'" . $nombre_voluntario ."', ".
            "'" . $nombre_persona_atiende ."', ".
            "'" . $parentesco ."', ".
            "'" . $telefono ."', ".
            "'" . $p1 ."', ".
            "'" . $r1 ."', ".
            "'" . $p2 ."', ".
            "'" . $r2 ."', ".
            "'" . $p3 ."', ".
            "'" . $r3 ."', ".
            "'" . $p4 ."', ".
            "'" . $r4 ."', ".
            "'" . $veterinaria ."', ".
            "'" . $fecha_esterilizacion ."', ".
            "'" . $id_mascota ."', ".
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

    public function save_editar($data) {
        $nombre_voluntario = htmlentities($data["nombre_voluntario"]);
        $nombre_persona_atiende = htmlentities($data["nombre_persona_atiende"]);
        $parentesco = htmlentities($data["parentesco"]);
        $telefono = htmlentities($data["telefono"]);
        $p1 = htmlentities($data["p1"]);
        $r1= htmlentities($data["r1"]);
        $p2 = $data["p2"];
        $r2 = htmlentities($data["r2"]);
        $p3 = htmlentities($data["p3"]);
        $r3 = $data["r3"];
        $p4 = htmlentities($data["p4"]);
        $r4 = htmlentities($data["r4"]);
        $veterinaria = htmlentities($data["veterinaria"]);
        $fecha_esterilizacion = htmlentities($data["fecha_esterilizacion"]);
        $id_mascota = htmlentities($data["id_mascota"]);
        $id = htmlentities($data["id"]);
        $fechaActual = date("Y-m-d H:i:s");
        $this->_misql->conectar();

        $this->_misql->sql = "UPDATE visita_mensual SET nombre_voluntario = '" . $nombre_voluntario . "', " .
            "nombre_persona_atiende = '" . $nombre_persona_atiende . "', " .
            "parentesco = '" . $parentesco . "', " .
            "telefono = '" . $telefono . "', " .
            "p1 = '" . $p1 . "', " .
            "r1 = '" . $r1 . "', " .
            "p2 = '" . $p2 . "', " .
            "r2 = '" . $r2 . "', " .
            "p3 = '" . $p3 . "', " .
            "r3 = '" . $r3 . "', " .
            "p4 = '" . $p4 . "', " .
            "r4 = '" . $r4 . "', " .
            "veterinaria = '" . $veterinaria . "', " .
            "fecha_esterilizacion = '" . $fecha_esterilizacion . "', " .
            "id_mascota = '" . $id_mascota . "', " .
            "updated_at = '" . $fechaActual . "' " .
            "WHERE id = " . $id;


        //echo $this->_misql->sql;
        $this->_misql->ejecutar();

        return $id;
    }

    public function eliminar($data) {
        $this->_misql->conectar();
        $this->_misql->sql = "DELETE FROM visita_mensual WHERE id=".$data["id"];
        $rs = $this->_misql->ejecutar();
        $this->_misql->cerrar();
        return $rs;
    }

    public function editar($id){
        $this->_misql->sql = "SELECT * FROM visita_mensual WHERE id=" . $id;
        $this->_misql->conectar();
        $this->_misql->ejecutar();
        $data = $this->_misql->devolverArreglo();
        $this->_misql->liberarYcerrar();
        return $data[0];
    }
}