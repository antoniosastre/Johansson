<?php

date_default_timezone_set('Europe/Madrid');

$conexion = mysqli_connect("localhost", "root", "tesla1856", "johansson");
//echo "<div id=\"dbstatus\">DB: ";

  if (!$conexion->set_charset("utf8")) {
    printf(" Error cargando el conjunto de caracteres utf8: %s\n", $conexion->error);
}
// echo "</div>";

function dbstatus(){
	if (mysqli_connect_errno($conexion)){
  		echo "ERR." . mysqli_connect_error();
  	}else{
  		echo "<img src=\"img/green.png\" width=\"18\" height=\"18\" style=\"position: relative; top: 0px; \">";
  	}
}

function userShowNameById($id){
	global $conexion;
	$que = "SELECT showname FROM users WHERE id='".$id."'";
	$res = mysqli_query($conexion,$que);
	$linea = mysqli_fetch_array($res);
	return $linea['showname'];
}

function userShowNameByUser($user){
	global $conexion;
	$que = "SELECT showname FROM users WHERE user='".$user."'";
	$res = mysqli_query($conexion,$que);
	$linea = mysqli_fetch_array($res);
	return $linea['showname'];
}

function userDataByUser($user){
	global $conexion;
	$que = "SELECT * FROM users WHERE user='".$user."'";
	$res = mysqli_query($conexion,$que);
	$linea = mysqli_fetch_array($res);
	return $linea;
}

function userIdByUser($user){
	global $conexion;
	$que = "SELECT id FROM users WHERE user='".$user."'";
	$res = mysqli_query($conexion,$que);
	$linea = mysqli_fetch_array($res);
	return $linea['id'];
}

function logincredentials($user, $password){

	global $conexion;
	$que = "SELECT * FROM users WHERE user='".$user."'";
	$res = mysqli_query($conexion,$que);

	if(empty($res)){
		return false;
	}else{
		$linea = mysqli_fetch_array($res);
		
		if(password_verify($password , $linea['password'])){
			return true;
		}
		return false;
	}


}

function lastgivencookie($user){

	require_once 'functions.php';

	global $conexion;

	$random = generateRandomString();

	$que = "UPDATE users SET lastcookiegiven=\"".$random."\" WHERE user=\"".$user."\"";
	mysqli_query($conexion,$que);

	return $random;
}


function isValidCookie($cookie){

	if(!isset($_COOKIE[$cookie])) return false;

	$exploded = explode("-and-", $_COOKIE[$cookie]);

	$user = $exploded[0];
	$code = $exploded[1];

	global $conexion;
	$que = "SELECT lastcookiegiven FROM users WHERE user='".$user."'";
	$res = mysqli_query($conexion,$que);
	$linea = mysqli_fetch_array($res);
	
	if($linea['lastcookiegiven'] == $code && strlen($linea['lastcookiegiven']) == 8){
		return true;
	}else{
		return false;
	}

}

function tableOfNews($status, $date=0){

	require_once 'functions.php';

	global $conexion;

	if($date==0){
			$que = "SELECT * FROM news WHERE showdate=\"".date("Y-m-d")."\" AND status=\"".$status."\" ORDER BY position ASC";
	}else{
			$que = "SELECT * FROM news WHERE showdate=\"".$date."\" AND status=\"".$status."\" ORDER BY position ASC";	
	}

	$res = mysqli_query($conexion,$que);

	if($status == 0){
			printQueuedNewsTable($res);
	}else if($status == 1){
			printAcceptedNewsTable($res);	
	}
	
}

function getNewsById($newsId){

	global $conexion;

	$que = "SELECT * FROM news WHERE id='".$newsId."'";

	$res = mysqli_query($conexion,$que);

	return mysqli_fetch_array($res);

}

function deleteNewsByID($newsId){

	global $conexion;

	$que = "DELETE FROM news WHERE id='".$newsId."'";

	$res = mysqli_query($conexion,$que);

}

function setNewsStatus($newsId, $status){

	global $conexion;

	$que = "UPDATE news SET status='".$status."' WHERE id='".$newsId."'";

	$res = mysqli_query($conexion,$que);
	
}

function setNewsPosition($newsId, $position){

	if($position == "last"){

		$last_position = getLastPositionOfAccepted($newsId);
		setNewsPosition($newsId, $last_position);

	}else if($position == "clear"){

		global $conexion;
		$que = "UPDATE news SET position='0' WHERE id='".$newsId."'";
		$res = mysqli_query($conexion,$que);
	
	}else{
		global $conexion;
		$que = "UPDATE news SET position='".$position."' WHERE id='".$newsId."'";
		$res = mysqli_query($conexion,$que);
	}

}

function getLastPositionOfAccepted($newsId){

	global $conexion;
	$que = "SELECT showdate FROM news WHERE id='".$newsId."'";
	$res = mysqli_query($conexion,$que);

	$showdate = mysqli_fetch_array($res)['showdate'];

	$que = "SELECT MAX(position) AS max FROM news WHERE showdate='".$showdate."' AND status='1'";
	$res = mysqli_query($conexion,$que);

	return mysqli_fetch_array($res)['max']+1;

}

function newsInQueueToday(){

	global $conexion;
	$que = "SELECT COUNT(*) AS total FROM news WHERE showdate='".date("Y-m-d")."' AND status='0'";
	$res = mysqli_query($conexion,$que);

	return mysqli_fetch_array($res)['total'];

}


function trimNewsPositions(){

	global $conexion;
	$position = 1;

	$que = "SELECT id, position FROM news WHERE showdate='".date("Y-m-d")."' AND trimmed='0' AND status='1' ORDER BY position ASC";

	$res = mysqli_query($conexion,$que);

	while($min = mysqli_fetch_array($res)){

		$que = "UPDATE news SET position='".$position."', trimmed='1' WHERE id='".$min['id']."'";
		mysqli_query($conexion,$que);

		$position++;

		$que = "SELECT id, position FROM news WHERE showdate='".date("Y-m-d")."' AND trimmed='0' AND status='1' ORDER BY position ASC";

		$res = mysqli_query($conexion,$que);

	}	

	$que = "UPDATE news SET trimmed='0'";

	mysqli_query($conexion,$que);

}

function insertNewNews($header, $prompter, $related_media, $showdate, $userId){

	global $conexion;

	$que = "INSERT INTO news (header, prompter, related_media, showdate, user) VALUES ('".$header."', '".$prompter."', '".$related_media."', '".$showdate."', '".$userId."')";
	mysqli_query($conexion,$que);

}

function updateNews($newsId, $header, $prompter, $related_media, $showdate, $userId){

	global $conexion;

	$que = "UPDATE news SET header='".$header."', prompter='".$prompter."', related_media='".$related_media."', showdate'".$showdate."') WHERE id='".$newsId."'";
	mysqli_query($conexion,$que);

}


/*
----------------------------------------------------------------------
*/


function videoById($id){
	global $conexion;
	$que = "SELECT *
	FROM video
	WHERE video.id='".$id."'";
	$res = mysqli_query($conexion,$que);
	$linea = mysqli_fetch_array($res);
	return $linea;
}



function insertVideoInfo($title, $recorded_when, $recorded_who, $length, $pathtofile, $size, $type, $resolutionx, $resolutiony, $framerate){

if(!empty($title) && !empty($recorded_when) && !empty($recorded_who) && !empty($type)  && !empty($pathtofile)){

		global $conexion;

		$length = round($length,1);
		$framerate = round($framerate,2);

		$que = "INSERT INTO video (title, recorded_when, recorded_who, length, pathtofile, size, type, resolutionx, resolutiony, framerate) VALUES (\"".$title."\",\"".$recorded_when."\",\"".$recorded_who."\",\"".$length."\",\"".$pathtofile."\",\"".$size."\",\"".$type."\",\"".$resolutionx."\",\"".$resolutiony."\",\"".$framerate."\")";
		if(mysqli_query($conexion,$que)){
			echo "Los datos del vídeo se han registrado correctamente.<br>";
			return mysqli_insert_id($conexion);
		}else{
			echo "No se han podido introducir los datos en la base de datos.<br>";
			return -1;
		}
		
	}else{
		echo "No se han intentado introducir los datos en la base de datos.<br>";
		//echo "Title: ".$title."<br>";
		//echo "Recorded_when: ".$recorded_when."<br>";
		//echo "Type: ".$type."<br>";
		//echo "Path: ".$pathtofile."<br>";
		return -1;

	}

}

function processPeople($media, $allpeople, $isclipgroup=0){
	$peoplearray = explode(',', $allpeople);
	$iter=0;
	global $conexion;

	foreach($peoplearray as $person){

	if(isset($person)){

		$exists = existThisPerson($person);

		if(empty($exists)){ //El nombre no existía
			$que = "INSERT INTO people (name) VALUES (\"".$person."\")";
			mysqli_query($conexion,$que);

			$que = "INSERT INTO peopleinmedia (person, isclipgroup, media) VALUES (\"".mysqli_insert_id($conexion)."\",".$isclipgroup.",\"".$media."\")";
			mysqli_query($conexion,$que);
		}else{ //El nombre ya existía
			$que = "INSERT INTO peopleinmedia (person, isclipgroup, media) VALUES (\"".$exists."\",".$isclipgroup.",\"".$media."\")";
			mysqli_query($conexion,$que);
		}
		$iter++;

	}
	}
}
				
function processPlaces($media, $allplaces, $isclipgroup=0){
	$placesarray = explode(',', $allplaces);
	$iter=0;
	global $conexion;

	foreach($placesarray as $place){

		if(isset($place)){

		$exists = existThisPlace($place);

		if(empty($exists)){ //El nombre no existía
			$que = "INSERT INTO places (name) VALUES (\"".$place."\")";
			mysqli_query($conexion,$que);

			$que = "INSERT INTO placesinmedia (place, isclipgroup, media) VALUES (\"".mysqli_insert_id($conexion)."\",".$isclipgroup.",\"".$media."\")";
			mysqli_query($conexion,$que);
		}else{ //El nombre ya existía
			$que = "INSERT INTO placesinmedia (place, isclipgroup, media) VALUES (\"".$exists."\",".$isclipgroup.",\"".$media."\")";
			mysqli_query($conexion,$que);
		}
		$iter++;

	}
	}
}

function processTags($media, $alltags, $isclipgroup=0){
	$tagsarray = explode(',', $alltags);
	$iter=0;
	global $conexion;

	foreach($tagsarray as $tag){

		if(isset($tag)){

		$exists = existThisTag($tag);

		if(empty($exists)){ //El nombre no existía
			$que = "INSERT INTO tags (name) VALUES (\"".$tag."\")";
			mysqli_query($conexion,$que);

			$que = "INSERT INTO tagsinmedia (tag, isclipgroup, media) VALUES (\"".mysqli_insert_id($conexion)."\",".$isclipgroup.",\"".$media."\")";
			mysqli_query($conexion,$que);
		}else{ //El nombre ya existía
			$que = "INSERT INTO tagsinmedia (tag, isclipgroup, media) VALUES (\"".$exists."\",".$isclipgroup.",\"".$media."\")";
			mysqli_query($conexion,$que);
		}
		$iter++;

	}
	}
}

function existThisPerson($person){

	global $conexion;
	$que = "SELECT id FROM people WHERE name='".$person."'";
	$res = mysqli_query($conexion,$que);

	if(empty($res)){
		return 0;
	}else{
		$linea = mysqli_fetch_array($res);
	return $linea['id'];
	}
}

function existThisPlace($place){

	global $conexion;
	$que = "SELECT id FROM places WHERE name='".$place."'";
	$res = mysqli_query($conexion,$que);

	if(empty($res)){
		return 0;
	}else{
		$linea = mysqli_fetch_array($res);
	return $linea['id'];
	}
}

function existThisTag($tag){

	global $conexion;
	$que = "SELECT id FROM tags WHERE name='".$tag."'";
	$res = mysqli_query($conexion,$que);

	if(empty($res)){
		return 0;
	}else{
		$linea = mysqli_fetch_array($res);
	return $linea['id'];
	}
}


function peopleArray(){

		global $conexion;
		$que = "SELECT name FROM people";
		$res = mysqli_query($conexion,$que);

		while ($row = mysqli_fetch_array($res)){
		$people[] = $row['name'];
		}

		return $people;

}

function placesArray(){

		global $conexion;
		$que = "SELECT name FROM places";
		$res = mysqli_query($conexion,$que);

		while ($row = mysqli_fetch_array($res)){
		$places[] = $row['name'];
		}

		return $places;

}

function tagsArray(){

		global $conexion;
		$que = "SELECT name FROM tags";
		$res = mysqli_query($conexion,$que);

		while ($row = mysqli_fetch_array($res)){
		$tags[] = $row['name'];
		}

		return $tags;

}



function videoYears(){

	global $conexion;
	$que = "SELECT DISTINCT YEAR(recorded_when) as year FROM video ORDER BY year DESC";
	$res = mysqli_query($conexion,$que);

	while($years[] = mysqli_fetch_array($res)['year']){

	}

	return $years;

}

function tableOfInterval($from, $to, $user = 0, $person = 0, $place = 0, $tag = 0, $title = 0){

	require_once 'functions.php';

	$from = implode('-', array($from, '01'));
	$to = implode('-', array($to, '31'));

	global $conexion;
	$que = "SELECT * FROM video WHERE recorded_when BETWEEN \"".$from."\" AND \"".$to."\" ORDER BY recorded_when DESC, id DESC";
	$res = mysqli_query($conexion,$que);

	printVideoRows($res);

}


function tableOfLast($days, $user = 0, $person = 0, $place = 0, $tag = 0, $title = 0){

	require_once 'functions.php';

	$today = date("Y-m-d");

	global $conexion;
	$que = "SELECT * FROM video WHERE recorded_when >= DATE_SUB(\"".$today."\",INTERVAL ".($days-1)." DAY) ORDER BY recorded_when DESC, id DESC";
	$res = mysqli_query($conexion,$que);

	printVideoRows($res);

}

function updateFilenameInDB($idinsertedmedia, $def_target_file){

	global $conexion;
	$que = "UPDATE video SET pathtofile=\"".$def_target_file."\" WHERE id=\"".$idinsertedmedia."\"";
	$res = mysqli_query($conexion,$que);
	
}


?>