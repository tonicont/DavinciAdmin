<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Davinci: Nueva Fiesta</title>
<link rel="stylesheet"" type="text/css" href="css/style.css">

<?php
	session_start();
	if(!isset($_SESSION['usuario']))
	{	
		echo "No ha iniciado sesion<br>";
		echo "<a href='index.html'>Volver</a>";
		exit;
	}
?>
</head>

<body>
	<div id="contenedor">
        <header>
            <h1>Nueva Fiesta</h1>
        </header>
        
        <nav>
        	<a href="admin.php">Volver</a>
        </nav>
        
        <form action="fiestasController.php?action=1" method="post">
        	<table class="tablaForm">
            <tr>
            	<td>Titulo:</td>
              <td><input type="text" name="titulo" id="titulo" class="inputText"></td>
            </tr>
            <tr>
            	<td>Descripci&oacute;n:</td>
               <td><textarea cols="30" rows="5" name="descripcion" class="inputText"></textarea></td>
            </tr>
            <tr>
            	<td>Fecha:</td>
               <td><input type="date" name="fecha" class="inputText"></td>
            </tr>
            <tr>
            	<td><input type="submit" value="Guardar" class="btnGuardar"></td>
            </tr>
           </table>
        </form>
    </div>
</body>
</html>