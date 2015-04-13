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

<h1>Hoy</h1>

<h2>Escaleta</h2>

<h2>Cola de Noticias</h2>


</div>

</body>
</html>


<?
}
?>