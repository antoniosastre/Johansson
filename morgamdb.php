<?php


// echo "</div>";

function urlOfVideo($id){

	date_default_timezone_set('Europe/Madrid');

	$conexion2 = mysqli_connect("localhost", "root", "tesla1856", "morgam");
//echo "<div id=\"dbstatus\">DB: ";

  	if (!$conexion2->set_charset("utf8")) {
    		printf(" Error cargando el conjunto de caracteres utf8: %s\n", $conexion2->error);
	}
	$que = "SELECT pathtofile FROM video WHERE video.id='".$id."'";
	$res = mysqli_query($conexion2,$que);
	$linea = mysqli_fetch_array($res);
	return $linea['pathtofile'];
}


















?>