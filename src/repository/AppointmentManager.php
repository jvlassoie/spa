<?php
/**
* 
*/
class AppointmentManager extends EntityManager
{
	
	function __construct()
	{
		parent::__construct('Appointments_Animals');	
	}

	public function CreateAppAnimals($idApp,$idAnimal){
		$req = $this->db->prepare("INSERT INTO $this->entity (idAppointments,idAnimals) VALUES (?,?)");
		$req->execute([$idApp,$idAnimal]);
	}
	public function ReadApp(){

		foreach ($this->getProperty(true, "Appointments_Animals") as $key => $value) {
			$entityIndiceStr .= 'Appointments_Animals.'.$value.' AS '.' Appointments_Animals'.ucfirst($value).', ';
		}
		foreach ($this->getProperty(true, "Users") as $key => $value) {
			$entityIndiceStr .= 'Users.'.$value.' AS '.' Users'.ucfirst($value).', ';
		}
		foreach ($this->getProperty(true, "Appointments") as $key => $value) {
			$entityIndiceStr .= 'Appointments.'.$value.' AS '.' Appointments'.ucfirst($value).', ';
		}
		foreach ($this->getProperty(true, "Animals") as $key => $value) {
			$entityIndiceStr .= 'Animals.'.$value.' AS '.' Animals'.ucfirst($value).', ';
		}
		$entityIndiceStr = rtrim($entityIndiceStr,', ');

		$req = $this->db->prepare("SELECT DISTINCT $entityIndiceStr FROM $this->entity 
			inner join Appointments on Appointments_Animals.idAppointments = Appointments.id
			inner join Animals on Appointments_Animals.idAnimals = Animals.id
			inner join Users on idUser = Users.id
			");
		$req->execute();
		
		return $req->fetchAll();
	}

	public function DeleteApp($idApp,$idAni){
		if (!empty($idApp)&& !empty($idAni)) {
			$req = $this->db->prepare("DELETE FROM $this->entity WHERE idAppointments = ? AND idAnimals = ?");
			$req->execute([$idApp,$idAni]);
			return true;
		}else{
			return false;
		}

	}


	public function countById($id){
		$req = $this->db->prepare("SELECT COUNT(*) FROM $this->entity WHERE idAppointments = ?");
		$req->execute([$id]);
		return $req->fetch();

	}
}