<?php
/**
* 
*/
class UserManager extends EntityManager
{
	
	function __construct()
	{
		parent::__construct('Users');	
	}

	public function countExists($username,$email){

		$req = $this->db->prepare("SELECT COUNT(*) as CountUser FROM $this->entity WHERE username = ? OR email = ? ");
		$req->execute([$username,$email]);
		return $req->fetch();
	}
	public function logUser($login){
		$entityIndiceStr = null;
		foreach ($this->getProperty(true) as $key => $value) {
			$entityIndiceStr .= $this->entity.'.'.$value.' AS '.$this->entity.ucfirst($value).', ';
		}
		foreach ($this->getProperty(true,'Roles') as $key => $value) {
			$end = ((count($this->getProperty(true,'Roles'))-1) != $key)? ', ': null;
			$entityIndiceStr .= 'Roles.'.$value.' AS '.'Roles'.ucfirst($value).$end;
		}

		$req = $this->db->prepare("SELECT $entityIndiceStr FROM $this->entity inner join Roles on Users.idRole = Roles.id WHERE username = ? OR email = ?");
		$req->execute([$login,$login]);
		return $req->fetch();
	}
}