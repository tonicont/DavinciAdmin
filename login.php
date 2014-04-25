<?php
	$usuario = $_POST['usuario'];
	$pass = $_POST['password'];
	
	$dbserver = "SERVIDOR MYSQL";
	$dbuser = "USUARIO MYSQL";
	$dbpass = "PASS MYSQL";
	$dbname = "NOMBRE BASE DE DATOS";
	
	try
	{
		$conex = new PDO("mysql:host=$dbserver;dbname=$dbname", $dbuser, $dbpass);
		
		$sql = $conex->prepare("SELECT * FROM Admin a WHERE a.usuario = :usuario");
		$sql->bindParam('usuario',$usuario);
		if($sql->execute())
		{
			$fila = $sql->fetch();
			if($pass === $fila['password'])
			{
				session_start();
				$_SESSION['usuario'] = $usuario;
				header("Location: admin.php");
			}
			else
			{
				echo "Usuario o Contrase&ntilde;a incorrecta<br>";
				echo "<a href='index.html'>Volver</a>";
			}
		}
		else
		{
			echo "No se encuentra el usuario en la base de datos<br>";
			echo "<a href='index.html'>Volver</a>";
		}
	}
	catch(PDOException $e)
	{
		echo "Error al conectar a la base de datos<br>";
		echo "<a href='index.html'>Volver</a>";
	}
	
?>