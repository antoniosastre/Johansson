<!DOCTYPE HTML>
<?php 

require_once 'db.php';

if(!isValidCookie("johansson")){

?>

<html>
	<head>
	<meta http-equiv="refresh" content="1;url=login.php">
        <script type="text/javascript">
            window.location.href = "login.php"
        </script>
	</head>
</html>

<?

}else if(!isset($_GET['r'])){

?>

<html>
	<head>
	<meta http-equiv="refresh" content="1;url=index.php">
        <script type="text/javascript">
            window.location.href = "index.php"
        </script>
	</head>
</html>

<?

}else if(!isset($_GET['a']) || !isset($_GET['n'])){

echo "<html><head><meta http-equiv=\"refresh\" content=\"1;url=".$_GET['r']."\">
        <script type=\"text/javascript\">
            window.location.href = ".$_GET['r']."</script></head></html>";
}else{

	//require_once 'functions.php';
	//require_once 'db.php';

	if($_GET['a']=="delete" && $_GET['c']=="true"){

		deleteNewsByID($_GET['n']);

		echo "<html><head><meta http-equiv=\"refresh\" content=\"1;url=".$_GET['r']."\">
        <script type=\"text/javascript\">
            window.location.href = ".$_GET['r']."</script></head></html>";

	}else if($_GET['a']=="delete"){
		echo "<html>
	<head>";
	require_once 'head.php';
	
	echo "</head>
	<body>";

	require_once 'topmenu.php';
		
	echo "<div class=\"container\">


<h3 class=\"text-center\">¿Confirma la eliminación de la noticia? Esta acción no se puede deshacer.</h3>";

echo printSingleNew($_GET['n']);

echo "<p class=\"text-center\"><a href=\"".$_GET['r']."\"><button type=\"button\" class=\"btn btn-primary\">Volver</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"news-engine.php?r=".$_GET['r']."&a=delete&n=".$_GET['n']."&c=true\"><button type=\"button\" class=\"btn btn-danger\">Eliminar</button></a></p>";

echo "</div>


</body>
</html>";
	
	}else if($_GET['a']=="edit"){

		echo "<html><head><meta http-equiv=\"refresh\" content=\"1;url=news-editor.php?r=".$_GET['r']."&n=".$_GET['n']."\">
        <script type=\"text/javascript\">
            window.location.href = news-editor.php?r=".$_GET['r']."&n=".$_GET['n']."</script></head></html>";

	}else if($_GET['a']=="extract"){

		setNewsPosition($_GET['n'], "clear");
		setNewsStatus($_GET['n'], 0);

		trimNewsPositions();

		echo "<html><head><meta http-equiv=\"refresh\" content=\"1;url=".$_GET['r']."\">
        <script type=\"text/javascript\">
            window.location.href = ".$_GET['r']."</script></head></html>";

	}else if($_GET['a']=="insert"){

		setNewsPosition($_GET['n'], "last");
		setNewsStatus($_GET['n'], 1);

		echo "<html><head><meta http-equiv=\"refresh\" content=\"1;url=".$_GET['r']."\">
        <script type=\"text/javascript\">
            window.location.href = ".$_GET['r']."</script></head></html>";

	}else if($_GET['a']=="tomorrow"){

	}else if($_GET['a']=="up"){

	}else if($_GET['a']=="down"){

	}

}
?>


<!--
<html>
	<head>
	<?php //require_once 'head.php' ?>
	</head>
	<body>

<?php //require_once 'topmenu.php'; ?>
		
<div class="container">

<h1>Inicio</h1>


</div>

</body>
</html>

-->