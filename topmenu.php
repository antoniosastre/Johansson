<nav class="navbar navbar-inverse navbar-static-top">
	    <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Scalet Johansson</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if (strpos($_SERVER['SCRIPT_NAME'], "index.php")) echo "class=\"active\""; ?>><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Inicio</a></li>
        <li <?php if (strpos($_SERVER['SCRIPT_NAME'], "today.php")) echo "class=\"active\""; ?>><a href="today.php"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Hoy 
        <?php 
        require_once 'functions.php'; 

        if(newsInQueueToday()>0){
          echo "<span class=\"badge\">".newsInQueueToday()."</span>";
        }
        ?>
        </a></li>
        <li <?php if (strpos($_SERVER['SCRIPT_NAME'], "gotoaday.php")) echo "class=\"active\""; ?>><a href="gotoaday.php"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Ir al día</a></li>
        <li <?php if (strpos($_SERVER['SCRIPT_NAME'], "new-news.php")) echo "class=\"active\""; ?>><a href="new-news.php"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Nueva Noticia</a></li>

      </ul>
      
      <ul class="nav navbar-nav navbar-right">

      <li <?php if (strpos($_SERVER['SCRIPT_NAME'], "get-broadcast.php")) echo "class=\"active\""; ?>><a href="get-broadcast.php"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Descargar Emisión</a></li>

<?php

	echo "<li class=\"dropdown";
  if (strpos($_SERVER['SCRIPT_NAME'], "user.php")) echo " active";
  echo "\"><a href=\"user.php\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\">".userShowNameByUser(explode("-and-", $_COOKIE['johansson'])[0])."<span class=\"caret\"></span></a>
          <ul class=\"dropdown-menu\" role=\"menu\">
          	<li><a href=\"user.php\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span>  Página de usuario</a></li>
          	<li class=\"divider\"></li>
            <li><a href=\"user.php?a=close\"><span class=\"glyphicon glyphicon-off\" aria-hidden=\"true\"></span> Cerrar Sesión</a></li>
          </ul>
        </li>";

?>
   
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
	</nav>