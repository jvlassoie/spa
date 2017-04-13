<?php
/**
* 
*/
class AnimalManager extends EntityManager
{
	
	function __construct()
	{
		parent::__construct('Animals');	
	}

	public function findByIdBreed($id){

		$req = $this->db->query("SELECT * FROM $this->entity WHERE idBreed = $id");
		return $req->fetchAll();
	}


}