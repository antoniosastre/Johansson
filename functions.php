<?php 

function bytesToSizeString($bytes){

	$fileSize = $bytes;
			$fileUnit = 0;

			while ($fileSize >= 1000){
				$fileSize = $fileSize/1000;
				$fileUnit++;
			}

			$fileSize = round($fileSize, 2);

			$fileSize = number_format($fileSize, 2, ",",".");

			switch ($fileUnit) {
				case '0':
					$fileUnit = "B";
					break;

				case '1':
					$fileUnit = "KB";
					break;

				case '2':
					$fileUnit = "MB";
					break;

				case '3':
					$fileUnit = "GB";
					break;
				
				case '4':
					$fileUnit = "TB";
					break;

				case '5':
					$fileUnit = "PB";
					break;
				
				default:
					$fileUnit = "--";
					break;
			}

			$fileSize = $fileSize." ".$fileUnit;
			return $fileSize;

}

function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function fechaNormal($fecha){
	if ($fecha){
	preg_match( "#([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})#", $fecha, $mifecha); 
	$lafecha=$mifecha[3]." / ".$mifecha[2]." / ".$mifecha[1];
	return $lafecha;
	}
	return null;
}

function fechaSQL($fecha){
	if ($fecha){
	preg_match( "#([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})#", $fecha, $mifecha);
	$lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
	return $lafecha;
	}
	return null;
}

function secondsToTimeString($init){



	$hours = floor($init / 3600);
	$minutes = floor(($init / 60) % 60);
	$seconds = round(fmod($init, 60));

	if(!empty($hours)){

		return $hours."h ".$minutes."m ".$seconds."s";

	}else if(!empty($minutes)){

		return $minutes."m ".$seconds."s";

	}else{

		return $seconds." sec.";

	}


}

function resolutionString($resx, $resy){

if(!empty($resx) && !empty($resy)){
	$g = gcd($resx, $resy);
	$ratio = round(($resx/$resy),3).":1";
	return $resx." x ".$resy." (".$ratio.")";
}

return "n/d";

}

function newsInQueueToday(){

	return 2;

}

function printQueuedNewsTable($res){

	echo "<table class=\"table table-striped table-bordered table-condensed\">";
	echo "<thead><tr>";
	echo "<th>Nº</th><th>Títular</th><th>Prompter</th><th>Vídeo</th><th>Acciones</th>";
	echo "</tr></thead><tbody>";

	while($noticia = mysqli_fetch_array($res)){

		echo "<tr>";
			echo "<td class=\"text-right\">".$noticia['order']."</td>"."<td>".$noticia['header']."</td>"."<td>".$noticia['prompter']."</td>"."<td>".$noticia['related_media']."</td>"."<td>";
		
				echo "<span class=\"glyphicon glyphicon-log-in\" aria-hidden=\"true\"></span>";
				echo "<span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span>";
				echo "<span class=\"glyphicon glyphicon-new-window\" aria-hidden=\"true\"></span>";
				echo "<span class=\"glyphicon glyphicon-share\" aria-hidden=\"true\"></span>";
				echo "<span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span>";

			echo "</td>";
		echo "</tr>";
	}

	echo "</tbody></table>";

}

function printAcceptedNewsTable($res){

	echo "<table class=\"table table-striped table-bordered table-condensed\">";
	echo "<thead><tr>";
	echo "<th>Nº</th><th>Títular</th><th>Prompter</th><th>Vídeo</th><th>Acciones</th>";
	echo "</tr></thead><tbody>";

	while($noticia = mysqli_fetch_array($res)){

		echo "<tr>";
			echo "<td class=\"text-right\">".$noticia['order']."</td>"."<td>".$noticia['header']."</td>"."<td>".$noticia['prompter']."</td>"."<td>".$noticia['related_media']."</td>"."<td>";

				echo "<span class=\"glyphicon glyphicon-collapse-up\" aria-hidden=\"true\"></span>";
				echo "<span class=\"glyphicon glyphicon-collapse-down\" aria-hidden=\"true\"></span>";
				echo "<span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span>";
				echo "<span class=\"glyphicon glyphicon-log-out\" aria-hidden=\"true\"></span>";
				echo "<span class=\"glyphicon glyphicon-new-window\" aria-hidden=\"true\"></span>";
				echo "<span class=\"glyphicon glyphicon-share\" aria-hidden=\"true\"></span>";
				echo "<span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span>";

			echo "</td>";
		echo "</tr>";
	}

	echo "</tbody></table>";

}

?>