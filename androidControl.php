<?php
	$accion = $_GET['accion'];
	
	
	switch($accion)
	{
		case 1:
		{
			registrarDispositivo($_POST['id']);
			break;
		}
		case 2:
		{
			getFiestas();
			break;
		}
		case 3:
		{
			getCamareros();
			break;
		}
	}

	function registrarDispositivo($id){
		$sql = "INSERT INTO usuarios VALUES ('$id', null)";
		if(!mysqli_query($conexion,$sql)){
		echo "Error";
		}
	}
	
	function getFiestas()
	{
		
		$conexion = conexion();
		$array = array();
		$result = mysql_query('SELECT * FROM Fiesta f WHERE DATE_SUB(CURDATE(),INTERVAL 3 DAY) <= f.fecha ');
	
		$num_lineas = mysql_num_rows($result);
		
		while($row = mysql_fetch_assoc($result))
		{
			$array[] = $row;
		}
	
		print (json_encode($array));
		mysql_close($conexion);
	}
	
	function getCamareros()
	{
		$conexion = conexion();
		$array = array();
		$result = mysql_query('SELECT * FROM Gente');
	
		$num_lineas = mysql_num_rows($result);
		
		while($row = mysql_fetch_assoc($result))
		{
			$array[] = $row;
		}
	
		print (json_encode($array));
		mysql_close($conexion);
	}
	
	function conexion()
	{
		$server = "SERVIDOR BASE DE DATOS";
		$user = "USUARIO BASE DE DATOS";
		$pass = "CONTRASEÑA BASE DE DATOS";
		$bd = "NOMBRE BASE DE DATOS";
	
		$conexion = mysql_connect($server, $user, $pass);
		
		if($conexion){
			$db = mysql_select_db($bd);
		}else{
			echo 'Error al conectarse a la base de datos';
			die();
		}
		return $conexion;
	}

?>