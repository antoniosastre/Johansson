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

}else if($_GET['a']!="new" && $_GET['a']!="edit"){

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

}else{

?>

<html>
	<head>
	<?php require_once 'head.php' ?>
	</head>
	<body>

<?php require_once 'topmenu.php'; ?>
		
<div class="container">

<h1>Editar noticia</h1>


<?php

if($_GET['a']=="new"){

?>

<h3>Estamos haciendo una nueva</h3>

<form action="news-editor-engine.php" method="post" enctype="multipart/form-data">

<input type="hidden" name="a" value="new">

<div class="form-group">
    <label for="header">Títular</label>
	<input type"text" name="header" id="header" class="form-control" required>
</div>

<div class="form-group">
    <label for="prompter">Prompter</label>
	<textarea name="prompter" id="prompter" class="form-control" rows="5"></textarea>
</div>

	<div class="row">

	<div class="col-md-2">

		<div class="form-group">
		<label for="related_media">ID del Vídeo</label>
		<input type"text" name="related_media" id="related_media" class="form-control">
		</div>

		</div>
	<div class="col-md-2">

		<div class="form-group">
		<label for="showdate">Fecha de emisión</label>
		<input type="date" name="showdate" id="showdate" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
		</div>

	</div>

	<div class="col-md-2">
		<button type="submit" class="btn btn-primary" name="submit" style="position:relative; top:25px;">Insertar noticia</button>
	</div>

	<div class="col-md-6"></div>

	</div>

    

</form>

<br><br>

<?

}else if($_GET['a']=="edit"){

?>

<h3>Estamos editando una anterior</h3>

<form action="news-editor-engine.php" method="post" enctype="multipart/form-data">

<input type="hidden" name="a" value="edit">
<input type="hidden" name="n" value="<?php echo $_GET['n']; ?>">

<div class="form-group">
    <label for="header">Títular</label>
	<input type"text" name="header" id="header" class="form-control" value="<?php echo date('Y-m-d'); ?>"required>
</div>

<div class="form-group">
    <label for="prompter">Prompter</label>
	<textarea name="prompter" id="prompter" class="form-control" value="<?php echo date('Y-m-d'); ?>" rows="5"></textarea>
</div>

	<div class="row">

	<div class="col-md-2">

		<div class="form-group">
		<label for="related_media">ID del Vídeo</label>
		<input type"text" name="related_media" id="related_media" class="form-control" value="<?php echo date('Y-m-d'); ?>">
		</div>

		</div>
	<div class="col-md-2">

		<div class="form-group">
		<label for="showdate">Fecha de emisión</label>
		<input type="date" name="showdate" id="showdate" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
		</div>

	</div>

	<div class="col-md-2">
		<button type="submit" class="btn btn-primary" name="submit" style="position:relative; top:25px;">Actualizar noticia</button>
	</div>

	<div class="col-md-6"></div>

	</div>

    

</form>

<br><br>

<?

}

?>

</div>

</body>
</html>


<?
}
?>