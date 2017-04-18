<?php
/**
* 
*/
class SuperGlobal
{
	
	private $glob;


	function __construct(){
		$this->glob = $GLOBALS;
	}


	public function addGlob($name,$value){
		$this->glob[$name] = $value;
		return $this;
	}

	public function getGlob($name){
		if (!empty($this->glob[$name])) {
			return $this->glob[$name];
		}
		return false;
	}

	public function getAllGlob(){
		return $this->glob;
	}
}