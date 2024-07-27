<?php

/*Configuracion de la BD*/
/*

$host_mysql = "localhost";
$user_mysql = "root";
$pass_mysql = "1234";
$db_mysql = "barberiabd";
$mysqli = mysqli_connect($host_mysql,$user_mysql,$pass_mysql,$db_mysql);

if ($mysqli->connect_error) {
    die("La conexión falló: " . $mysqli->connect_error);
}*/

/*Funcion para rediccionar a los modulos*/
function redir($var){
	
	if(file_exists("modulos/".$var.".php")){
				include "modulos/".$var.".php";
			}else{
				echo "<i>No se ha encontrado el modulo <b>".$p."</b> <a href='./'>Regresar</a></i>";
			}
	
	die();
}

/*
function connect(){
	$host_mysql = "localhost";
	$user_mysql = "root";
	$pass_mysql = "1234";
	$db_mysql = "barberiabd";


 	$mysqli = mysqli_connect($host_mysql,$user_mysql,$pass_mysql,$db_mysql);

	return $mysqli;
}*/

function clear($var){
	htmlspecialchars($var);

	return $var;
}

function alert($txt, $type, $url, $rol) {
    // Definir el tipo de alerta ("error", "success", "info")
    if ($type == 0) {
        $t = "error";
    } elseif ($type == 1) {
        $t = "success";
    } else {
        $t = "info";
    }
    
    if ($rol==1){
        echo '<script>';
        echo 'swal({';
        echo '    title: "Alerta",';
        echo '    text: "'.$txt.'",';
        echo '    icon: "'.$t.'",';
        echo '}).then(function() {';
        echo '    window.location.href = "'.$url.'";';
        echo '});';
        echo '</script>';  
    }else{
    // Imprimir el script de alerta con SweetAlert2
    echo '<script>';
    echo 'swal({';
    echo '    title: "Alerta",';
    echo '    text: "'.$txt.'",';
    echo '    icon: "'.$t.'",';
    echo '}).then(function() {';
    echo '    window.location.href = "?p='.$url.'";';
    echo '});';
    echo '</script>';
}
}
/*
function alert($txt,$type,$url){

	//"error", "success" and "info".

	if($type==0){
		$t = "error";
	}elseif($type==1){
		$t = "success";
	}elseif($type==2){
		$t = "info";
	}else{
		$t = "info";
	}

	echo '<script>swal({ title: "Alerta", text: "'.$txt.'", icon: "'.$t.'"});';
	echo '$(".swal-button").click(function(){ window.location="?p='.$url.'"; });';
	echo '</script>';
}
*/
function get_value($variable) {

       if (isset($variable)) {
        // Retornar el valor de la variable
        return $variable;
    } else {
        // En caso de que la variable no esté definida, retornar una cadena vacía
        return '';
    }
}



function formatearFecha($fecha) {
    // Crear un objeto DateTime a partir de la fecha
    $dateTime = new DateTime($fecha);
    
    // Formato deseado
    $diaSemana = $dateTime->format('l'); // Día de la semana
    $dia = $dateTime->format('d'); // Día del mes
    $mes = $dateTime->format('F'); // Nombre completo del mes
    $anio = $dateTime->format('Y'); // Año

    // Convertir el día de la semana y el mes a español
    $diasSemana = [
        'Monday' => 'Lunes',
        'Tuesday' => 'Martes',
        'Wednesday' => 'Miércoles',
        'Thursday' => 'Jueves',
        'Friday' => 'Viernes',
        'Saturday' => 'Sábado',
        'Sunday' => 'Domingo'
    ];

    $meses = [
        'January' => 'Enero',
        'February' => 'Febrero',
        'March' => 'Marzo',
        'April' => 'Abril',
        'May' => 'Mayo',
        'June' => 'Junio',
        'July' => 'Julio',
        'August' => 'Agosto',
        'September' => 'Septiembre',
        'October' => 'Octubre',
        'November' => 'Noviembre',
        'December' => 'Diciembre'
    ];

    $diaSemanaEsp = $diasSemana[$diaSemana];
    $mesEsp = $meses[$mes];

    // Comprobar si la fecha es hoy
    $hoy = new DateTime();
    if ($dateTime->format('Y-m-d') == $hoy->format('Y-m-d')) {
        return "Hoy, $diaSemanaEsp $dia $mesEsp $anio";
    } else {
        return "$diaSemanaEsp, $dia $mesEsp $anio";
    }
}



?>