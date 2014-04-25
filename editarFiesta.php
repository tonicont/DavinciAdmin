<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Davinci: Editar Fiesta</title>
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
	require_once("clases/Fiesta.php");
	$fiestaService = new FiestaService();
	$fiesta = $fiestaService->GetById($_GET['id']); 
?>
</head>

<body>
	<div id="contenedor">
        <header>
            <h1>Editar Fiesta</h1>
        </header>
        
        <nav>
        	<a href="admin.php">Volver</a>
        </nav>
        
        <form action="fiestasController.php?action=2" method="post">
        	<table class="tablaForm">
            <tr>
            	<td>Id:</td>
              <td><input type="text" readonly="true" name="id" id="id" class="inputText"></td>
            </tr>
            <tr>
            	<td>Titulo:</td>
              <td><input type="text" name="titulo" id="titulo" class="inputText"></td>
            </tr>
            <tr>
            	<td>Descripci&oacute;n:</td>
               <td><textarea cols="30" rows="5" name="descripcion" id="descripcion" class="inputText"></textarea></td>
            </tr>
            <tr>
            	<td>Fecha:</td>
               <td><input type="date" name="fecha" id="fecha" class="inputText"></td>
            </tr>
            <tr>
            	<td><input type="submit" value="Guardar" class="btnGuardar"></td>
               <td><input type="button" value="Eliminar" class="btnEliminar" onClick="borrar()">
            </tr>
           </table>
        </form>
    </div>
    
    <script type="text/javascript" language="javascript">
		document.getElementById("id").value = "<?php echo $fiesta->getId();?>";
		document.getElementById("titulo").value = "<?php echo $fiesta->getTitulo();?>";
		document.getElementById("descripcion").value = "<?php echo $fiesta->getDescripcion();?>";
		document.getElementById("fecha").value = "<?php echo $fiesta->getFecha();?>";
		
		function borrar()
		{
			var aceptar = confirm("Desea eliminar esta fiesta?");
			if(!aceptar)
			{
				self.close();
			}
			else
			{
				location.href = "fiestasController.php?action=3&id=<?php echo $fiesta->getId();?>";
			}
		}
	</script>
</body>
</html>