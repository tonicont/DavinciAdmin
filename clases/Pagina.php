<?php
class Pagina
{
	private $inicio;
	private $fin;
	
	public function __construt($inicio, $fin)
	{
		$this->inicio = $inicio;
		$this->fin = $fin;
	}
	
	public function getInicio()
	{
		return $this->inicio;
	}
	
	public function getFin()
	{
		return $this->fin;
	}
}
?>