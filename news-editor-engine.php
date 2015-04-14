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

<?php

	if($_POST['a']=="new"){

		insertNewNews($_POST['header'], $_POST['prompter'], $_POST['related_media'], $_POST['showdate'], userIdByUser(explode("-and-", $_COOKIE['johansson'])[0]));

	}else if($_POST['a']=="edit"){

		updateNews($_POST['n'], $_POST['header'], $_POST['prompter'], $_POST['related_media'], $_POST['showdate'], userIdByUser(explode("-and-", $_COOKIE['johansson'])[0]));

	}


?>

</div>

</body>
</html>


<?
}
?>