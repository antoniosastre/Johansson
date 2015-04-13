<!DOCTYPE HTML>
<?php

if($_GET['a']=="close"){
	setcookie('johansson', $_POST['user'], time() - 86400, "/"); // 86400 = 1 day

	echo "<html>
	<head>
	<meta http-equiv=\"refresh\" content=\"1;url=index.php\">
        <script type=\"text/javascript\">
            window.location.href = \"index.php\"
        </script>
	</head>
</html>";

}else{

?>


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
	<?php include 'head.php' ?>
	</head>
	<body>
		<?php include 'topmenu.php'; ?>
		
<div class="container">

<?php 

	echo "<h1>Usuario ".userShowNameByUser(explode("-and-", $_COOKIE['johansson'])[0])."</h1>";	

?>

</div>
		
	</body>
</html>

<?
} }
?>