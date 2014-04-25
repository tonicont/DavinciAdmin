<?php
require_once("Fiesta.php");
class FiestaService
{
	private $conex; // propiedad que hará referencia a la conexión a la base de datos
	
	/**
	*	Constructor de la clase FiestasService
	*/
	public function __construct()
	{
		try
		{
			$this->conex = new PDO("mysql:host=localhost;dbname=davinci", "toni", "100582");
		}
		catch(PDOException $e)
		{
			echo "Error en la conexion a la base de datos";
		}
	}
	
	/**
	* @brief	Método que obtiene todos los registros de la tabla Fiesta
	* @return	Devuelve un array con los registros obtenidos
	*/
	public function GetAll()
	{
		$fiestas = array();
		try
		{
			$sql = $this->conex->prepare("SELECT * FROM Fiesta f ORDER BY f.fecha");
			$sql->execute();
			while($row = $sql->fetch())
			{
				$fiestas[] = $row;
			}
			return $fiestas;
		}
		catch(PDOException $e)
		{
			echo "Error ".$e->getMessage();
		}
	}
	
	/**
	* @brief	Método que obtine una Fiesta de la base de datos identificada
	*			por unid
	* @param	$id Identificador de la Fiesta a obtener
	* @return	Una entidad de Fiesta con el id indicado o null si no existe en la
	*			base de datos
	*/
	public function GetById($id)
	{
		$sql = $this->conex->prepare("SELECT * FROM Fiesta f WHERE f.id = :id");
		$sql->bindParam('id', $id);
		$sql->execute();
		if($sql->rowCount() == 1)
		{
			$row = $sql->fetch();
			$fiesta = new Fiesta($row['id'], $row['titulo'], $row['descripcion'], $row['fecha']);
			return $fiesta;
		}
		else
		{
			return null;
		}
	}
	
	/**
	* @brief	Método que inserta un registro en la base de datos
	* @param	$fiesta Registro que se insertará en la base de datos
	* @return	Retorna 1 si se inserta correctamente o 0 si ocurre un error
	*/
	public function Insert($fiesta)
	{
		try
		{
			$sql = $this->conex->prepare("INSERT INTO Fiesta VALUES (null, :titulo, :descripcion, :fecha)");
			$sql->bindParam('titulo', $fiesta->getTitulo());
			$sql->bindParam('descripcion', $fiesta->getDescripcion());
			$sql->bindParam('fecha', $fiesta->getFecha());
			$sql->execute();
			return 1;
		}
		catch(PDOException $e)
		{
			return 0;
		}
	}
	
	/**
	* @brief	Método que actualiza un registro en la base de datos
	* @param	$fiesta Registro con los nuevos datos
	* @return	Retorna 1 si se actualiza correctamente o 0 si ocurre un error.
	*/
	public function Update($fiesta)
	{
		try
		{
			$sql = $this->conex->prepare("UPDATE Fiesta SET titulo = $fiesta->getTitulo(), descripcion = $fiesta->getDescripcion,
											fecha = $fiesta.getFecha() WHERE id = $fiesta->getId()");
			$sql->execute();
			return 1;
		}
		catch(PDOException $e)
		{
			return 0;
		}
	}
}
?>
