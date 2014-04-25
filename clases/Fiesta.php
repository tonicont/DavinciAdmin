<?php
class Fiesta
{
	private $id;
	private $titulo;
	private $descripcion;
	private $fecha;
	
	
	public function __construct($id, $titulo, $descripcion, $fecha)
	{
		$this->id = $id;
		$this->titulo = $titulo;
		$this->descripcion = $descripcion;
		$this->fecha = $fecha;	
	}
	
	public function getId()
	{
		return $this->id;
	}
	public function getTitulo()
	{
		return $this->titulo;
	}
	public function getDescripcion()
	{
		return $this->descripcion;
	}
	public function getFecha()
	{
		return $this->fecha;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
}

?>