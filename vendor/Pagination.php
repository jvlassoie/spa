<?php
/**
* 
*/
class Pagination
{
	// nombre d'éléments dans la table
	public $elements;
	// nombre total de page
	public $pages;
	// nombre d'elements par page
	public $elementsPages;
	// page courante
	public $currentPage;
	// chaine de caractère contenant la limite
	public $limit;


	function __construct($elements, $elementsPages, $currentPage)
	{
		$this->elements = $elements;
		$this->elementsPages = $elementsPages;
		$this->pages = ceil( $this->elements / $this->elementsPages);
		$this->currentPage = $currentPage;
	}


	public function getElements(){
		return $this->elements;
	}
	public function getPages(){
		return $this->pages;
	}
	public function getElementsPages(){
		return $this->elementsPages;
	}
	public function getCurrentPage(){
		return $this->currentPage;
	}	
	public function getLimit(){
		return 'LIMIT '.(($this->currentPage - 1)* $this->elementsPages ).','.$this->elementsPages;
	}

	public function setElements($elements){
		$this->elements = $elements;
		return $this;
	}
	public function setElementsPages($elementsPages){
		$this->elementsPages = $elementsPages;
		return $this;
	}
	public function setCurrentPage($currentPage){
		$this->currentPage = $currentPage;
		return $this;
	}



}