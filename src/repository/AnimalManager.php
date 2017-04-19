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

	public function countByIdSpecie($id){

		$req = $this->db->query("SELECT COUNT(*) as countAnimals FROM $this->entity 
			inner join Breeds on $this->entity.idBreed = Breeds.id WHERE idSpecie = $id");
		return $req->fetch();
	}
}