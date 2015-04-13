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

}else{

?>

<html>
	<head>
	<?php require_once 'head.php' ?>
	</head>
	<body>

<?php require_once 'topmenu.php'; ?>
		
<div class="container">

<h1>Descargar recursos para la emisión</h1>

<h2>Textos prompter</h2>

<h2>Vídeos de noticias</h2>


</div>

</body>
</html>


<?
}
?>