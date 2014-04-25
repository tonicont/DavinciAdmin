<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Davinci: Administraci&oacute;n</title>
<link rel="stylesheet"" type="text/css" href="css/style.css">
<?php
	session_start();
	if(!isset($_SESSION['usuario']))
	{	
		echo "No ha iniciado sesion<br>";
		echo "<a href='index.html'>Volver</a>";
		exit;
	}
	require_once("clases/FiestaService.php");
	$fiestaService = new FiestaService();
	require_once("clases/Paginacion.php");
	if(!isset($_GET['pagina']))
	{
		$_GET['pagina'] = 1;
	}
?>
</head>

<body>
<div id="contenedor">
	<header>
    	<h1>Administraci&oacute;n</h1>
    </header>
	<nav>
       <a href="nuevaFiesta.php">Nueva Fiesta</a>
       <a href="logout.php">Salir</a>
    </nav>
    
    <table class="tableList">
    	<tr>
        	<th>ID</th><th>TITULO</th><th>DESCRIPCI&Oacute;N</th><th>FECHA</th>
       </tr>
       <?php
	   	$fiestas = $fiestaService->GetAll();
		$paginacion = new Paginacion(count($fiestas));
		foreach(array_slice($fiestas,($_GET['pagina']-1)*3,3) as $fiesta)
		{
			echo "<tr>";
				echo "<td>".$fiesta['id']."</td>";
				echo "<td>".$fiesta['titulo']."</td>";
				echo "<td>".$fiesta['descripcion']."</td>";
				echo "<td>".$fiesta['fecha']."</td>";
				echo "<td><a href='editarFiesta.php?id=".$fiesta['id']."'>Editar</a>";
			echo "</tr>";
		}
	   ?>
    </table>
    <?php
		for($i=0;$i<$paginacion->getNumPaginas();$i++)
		{
			echo "<a href='admin.php?pagina=".($i+1)."' class='paginacion'>".($i+1)." </a>";
		}
	?>    
</div>
</body>
</html>
