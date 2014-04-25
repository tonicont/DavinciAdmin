<?php
require_once("Pagina.php");
class Paginacion
{
	private $paginas;
	private $elementosPagina;
	private $totalElementos;
	
	public function __construct($totalElementos)
	{
		$this->paginas = array();
		$this->totalElementos = $totalElementos;
		$this->elementosPagina = 3;
		$this->crearPaginas();
	}
	
	public function addPagina($inicio, $fin)
	{
		$pagina = new Pagina($inicio, $fin);
		$this->paginas[] = $pagina;
	}
	
	public function crearPaginas()
	{
		$numPaginas = (float)$this->totalElementos / $this->elementosPagina;
		$numPagins = ceil($numPaginas); //Redondeo hacia el siguiente numero superior
		$indice = 0;
		for($i=0;$i<$numPaginas;$i++)
		{
			$this->addPagina($indice,$indice+$this->elementosPagina);
			$indice += $this->elementosPagina;
		}
	}
	
	public function getNumPaginas()
	{
		return count($this->paginas);
	}
	
	public function getPaginas()
	{
		return $this->paginas;
	}
}
?>