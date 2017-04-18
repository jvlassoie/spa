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
	public function ReadApp(Pagination $pagination = null, $userID = null){
		$entityIndiceStr = null;
		if ($pagination != null) {

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
			if ($userID != null) {
				$req = $this->db->prepare('SELECT '.$entityIndiceStr.' FROM '.$this->entity.' 
					inner join Appointments on Appointments_Animals.idAppointments = Appointments.id
					inner join Animals on Appointments_Animals.idAnimals = Animals.id
					inner join Users on idUser = Users.id WHERE Users.id = ? '.$pagination->getLimit()
					);
				$req->execute([$userID]);
			}else{

				$req = $this->db->prepare('SELECT '.$entityIndiceStr.' FROM '.$this->entity.' 
					inner join Appointments on Appointments_Animals.idAppointments = Appointments.id
					inner join Animals on Appointments_Animals.idAnimals = Animals.id
					inner join Users on idUser = Users.id '.$pagination->getLimit()
					);
				$req->execute();
			}

		}else{

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

			if ($userID != null) {
				$req = $this->db->prepare("SELECT $entityIndiceStr FROM $this->entity 
					inner join Appointments on Appointments_Animals.idAppointments = Appointments.id
					inner join Animals on Appointments_Animals.idAnimals = Animals.id
					inner join Users on idUser = Users.id WHERE Users.id = ?
					");
				$req->execute([$userID]);
			}else{
				$req = $this->db->prepare("SELECT $entityIndiceStr FROM $this->entity 
					inner join Appointments on Appointments_Animals.idAppointments = Appointments.id
					inner join Animals on Appointments_Animals.idAnimals = Animals.id
					inner join Users on idUser = Users.id
					");
				$req->execute();

			}
		}
		
		return $req->fetchAll();
	}

	public function FindByIdApp($id = null){
		$entityIndiceStr = null;

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

		$req = $this->db->prepare("SELECT $entityIndiceStr FROM $this->entity 
			inner join Appointments on Appointments_Animals.idAppointments = Appointments.id
			inner join Animals on Appointments_Animals.idAnimals = Animals.id
			inner join Users on idUser = Users.id
			WHERE $this->entity.idAppointments = ?
			");
		$req->execute([$id]);
		
		return $req->fetchAll();
	}

	public function DeleteApp($idApp,$idAni = null){
		if (!empty($idApp) && !empty($idAni)){
			$req = $this->db->prepare("DELETE FROM $this->entity WHERE idAppointments = ? AND idAnimals = ?");
			$req->execute([$idApp,$idAni]);
			return true;

		}elseif(!empty($idApp) && empty($idAni)){
			$req = $this->db->prepare("DELETE FROM $this->entity WHERE idAppointments = ?");
			$req->execute([$idApp]);
			return true;
		}else{
			return false;
		}

	}


	public function countById($id){
		$req = $this->db->prepare("SELECT COUNT(*) as nbCount FROM $this->entity WHERE idAppointments = ?");
		$req->execute([$id]);
		return $req->fetch();

	}


	public function countMyApp($id){
		$req = $this->db->prepare("SELECT COUNT(*)as nbCount from $this->entity inner join Appointments on Appointments_Animals.idAppointments = Appointments.id where Appointments.idUser = ?");
		$req->execute([$id]);
		return $req->fetch();

	}
}