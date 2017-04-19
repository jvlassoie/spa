<?php
/**
* 
*/
class BreedManager extends EntityManager
{
	
	function __construct()
	{
		parent::__construct('Breeds');	
	}



public function findByIdSpecie($id){

	$req = $this->db->query("SELECT * FROM $this->entity WHERE idSpecie = $id");
	return $req->fetchAll();
}
public function countByIdSpecie($id){

	$req = $this->db->query("SELECT COUNT(*) as countAnimals FROM $this->entity WHERE idSpecie = $id");
	return $req->fetch();
}


}