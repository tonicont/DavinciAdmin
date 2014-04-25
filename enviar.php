<?php
	require_once('GCMPush.php');

	function obtenerDispositivos(){
		$server = "TU SERVIDOR MYSQL";
		$user = "USUARIO DE MYSQL";
		$pass = "PASSWORD DE MYSQL";
		$bd = "NOMBRE BASE DE DATOS";

		$conexion = mysql_connect($server, $user, $pass);
		if($conexion){
		
		}else{
			echo 'Error al conectarse a la base de datos';
			die();
		}
		$db = mysql_select_db($bd);
		$dispositivos = array();
		$result = mysql_query('SELECT * FROM usuarios');
		while($row = mysql_fetch_array($result)){
			$dispositivos[] = $row[0];
		}

		mysql_close($conexion);
		return $dispositivos;
	}

	function enviarNotificacion($mensaje){
		$gcm = GCMPush::getInstance();
		$dispositivos = obtenerDispositivos();
		$gcm->set_dispositivos($dispositivos);
		echo $gcm->enviar($mensaje);
	}
	


?>