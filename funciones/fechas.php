<?php
/**
 * @autor Farly Minchan Lezcano
 */

//$Date = date('Y-m-d', strtotime($Date));
//recibe formato 2006-10-25
//y lo pasa a 25-10-2006
function fechaIngEsp($fechaIng,$hora=0,$full=1,$sep='/'){
    if (trim($fechaIng)=="")
        return "";
   $anyo=substr($fechaIng,0,4);
   $mes=substr($fechaIng,5,2);
   $dia=substr($fechaIng,8,2);
   if ($hora<>0){
        $hora=substr($fechaIng,11);
        return($full==1)?"$dia$sep$mes$sep$anyo $hora":"$dia$sep$mes$sep".substr($anyo,2)." $hora";
   }else
        return($full==1)?"$dia$sep$mes$sep$anyo":"$dia$sep$mes$sep".substr($anyo,2);
}

//recibe formato 25-10-2006
//y lo pasa a 2006-10-25
function fechaEspIng($fechaEsp,$hora=0,$sep='/'){
   $anyo=substr($fechaEsp,6,4);
   $mes=substr($fechaEsp,3,2);
   $dia=substr($fechaEsp,0,2);
   if ($hora<>0){
        $hora=substr($fechaEsp,11);
        return "$anyo$sep$mes$sep$dia $hora";
   }else
        return "$anyo$sep$mes$sep$dia";
}

//Recibe 02 parametros: El primero es para la fecha en formato
//10:55:20 ó 2006-10-25 10:55:20
//el 2º parámetro es si se quiere visulizar en formato de 12 ó 24 horas.
//el valor por defecto del 2º parámetro es cero (24 horas).
function hora($fechaSql,$de12horas=0,$conSegundos=0){
$largo=strlen($fechaSql);
   if($largo>8){
      $ini=11;
      //$ini=8;
   }else{
      $ini=0;
   }
   if($de12horas==0){
       $hora=substr($fechaSql,$ini,8);
    }else{
       $hora1=substr($fechaSql,$ini,2);
       
       $digitos = $conSegundos==1 ? 3:6;
       //$hora2=substr($fechaSql,$ini+2,6);
       $hora2=substr($fechaSql,$ini+2,$digitos);
       if ($hora1>12){
          $hora1=$hora1-12;
          if ($hora1<10){
             $hora='0'.$hora1.$hora2." p.m.";
          }else{
             $hora=$hora1.$hora2." p.m.";
          }
       }else{
          $hora=$hora1.$hora2." a.m.";
       }
    }
    return $hora;
}

//Recibe la fecha en formato: 10:55 am
//y lo devuelve en formatto 24 horas
function horaMinA24($horaMin){
    $hora24 = "";
//    list($hora, $minutos, $meridiano) = split("[: ]",$horaMin);
    $hora = substr($horaMin, 0, 2);
    $minutos = substr($horaMin, 3, 4);
    $meridiano = substr($horaMin, -2);
    $meridiano = trim(strtolower(substr($meridiano,0,1)));

    if($meridiano=="p"){
        $hora += 12;
    }
    $hora24 = zerofill($hora) . ":" . zerofill($minutos) . ":00";

    return $hora24;
}

//me devuelve la fecha actual en formato: Lunes, 12 Octubre del 2006
//la coma(,) que aparece es cuando el parametro pasado es esa coma
function fecha($separador="",$fecha=""){
        if ($fecha=="")
            $hoy=getdate(time()); 
        else
            $hoy=getdate(strtotime($fecha));
        
        $dia=$hoy["wday"];
        switch ($dia){
                case 1:
                     $dia = "Lunes";
                     break;
                case 2:
                     $dia = "Martes";
                     break;
                case 3:
                     $dia = "Miércoles";
                     break;
                case 4:
                     $dia = "Jueves";
                     break;
                case 5:
                     $dia = "Viernes";
                     break;
                case 6:
                     $dia = "Sábado";
                     break;
                case 0:
                     $dia = "Domingo";
                     break;
        }
        $mes=$hoy["mon"];
        switch ($mes){
                case 1:
                     $mes = "Enero";
                     break;
                case 2:
                     $mes = "Febrero";
                     break;
                case 3:
                     $mes = "Marzo";
                     break;
                case 4:
                     $mes = "Abril";
                     break;
                case 5:
                     $mes = "Mayo";
                     break;
                case 6:
                     $mes = "Junio";
                     break;
                case 7:
                     $mes = "Julio";
                     break;
                case 8:
                     $mes = "Agosto";
                     break;
                case 9:
                     $mes = "Septiembre";
                     break;
                case 10:
                     $mes = "Octubre";
                     break;
                case 11:
                     $mes = "Noviembre";
                     break;
                case 12:
                     $mes = "Diciembre";
                     break;
        }
        if ($separador ==""){
                $fecha=$hoy["mday"]." de ".$mes." del ".$hoy["year"];
        }else{
                $fecha= $dia."$separador ".$hoy["mday"]." de ".$mes." del ".$hoy["year"];
        }
        return $fecha;  //Ejm. Lunes, 12 Octubre del 2006
}

function zerofill($valor, $longitud=2){
    $res = str_pad($valor, $longitud, '0', STR_PAD_LEFT);
    return $res;
}


?>