<?php
	require_once("clases/FiestaService.php");
	require_once("clases/Fiesta.php");
	$fiestaServicio = new FiestaService();
	$action = $_GET['action'];
	
	
	
	switch($action)
	{
		case 1: // Insertar nueva Fiesta
		{
			$fiesta = new Fiesta(0, $_POST['titulo'], $_POST['descripcion'], $_POST['fecha']);
			$fiestaServicio->Insert($fiesta);
			require_once("enviar.php");
			enviarNotificacion($fiesta->getTitulo());
			header("Location: admin.php");
			break;
		}
		case 2: // Actualizar Fiesta
		{
			$fiesta = new Fiesta($_POST['id'], $_POST['titulo'], $_POST['descripcion'], $_POST['fecha']);
			$fiestaServicio->Update($fiesta);
			header("Location: admin.php");
			break;
		}
		case 3: //Elimina una Fiesta identificada por el id
		{
			$fiestaServicio->Delete($_GET['id']);
			header("Location: admin.php");
			break;
		}
	}

	

?>