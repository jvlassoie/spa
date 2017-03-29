<?php
/**
* 
*/
class EntityManager
{

	private $entity;
	private $dataBaseObject;
	private $db;
	private $propertiesDBObject = [];
	private $fk = [];
	
	function __construct($entity)
	{
		$this->entity = $entity;
		$this->dataBaseObject = new Database('127.0.0.1','spa','root','');
		$this->db = $this->dataBaseObject->getDB();
		$this->propertiesDBObject = $this->getProperty();
		$this->fk = $this->getFK();
	}
	/**
	* getProperty
	* Fonction qui sert récupère les noms des champs de la entity
	* @param $id = est un boolean pour savoir si on veut le champ id par default nom car il est auto-incrémenté 
	* donc par nécessaire de faire de modification dessus.
	* @return un boolean pour savoir si l'action est bien effectuée
	*/
	public function getProperty($id = false, $entity = "" ){
		$entity = (empty($entity))? $this->entity : $entity;
		$req = $this->db->prepare(" SHOW FULL COLUMNS FROM $entity ");
		$req->execute();
		$tab = [];
		foreach ($req->fetchAll() as $key => $value) {	
			if ($id == true) {
				array_push($tab, $value->Field);
			}else{

				($value->Field != "id")? array_push($tab, $value->Field):null;
			}
		}
		return $tab;
	}
	/**
	* getFK
	* Fonction qui sert à savoir si on a une table liée
	* @return un boolean pour savoir si l'action est bien effectuée
	*/
	public function getFK($entity = ""){
		$entity = (empty($entity))? $this->entity : $entity;
		$req = $this->db->prepare(" SHOW FULL COLUMNS FROM $entity ");
		$req->execute();
		$tab = [];
		foreach ($req->fetchAll() as $key => $value) {	

			($value->Key == "MUL")? $tab[$value->Field]=$value->Key:null;
			
		}
		return $tab;
	}

	/**
	* Create
	* Fonction qui sert a créer un enregistrements
	* @param $params = un tableau de paramètre
	* @return un boolean pour savoir si l'action est bien effectuée
	*/
	public function Create($params = []){
		if (!empty($params)) {	
			$columnsName = implode(",", $this->propertiesDBObject);
			$params = implode(',',$params);
			$req = $this->db->prepare(" INSERT INTO $this->entity ($columnsName) VALUES (?)");
			$req->execute([$params]);
			return true;
		}else{
			
			return false;
		}
		
	}
	
	/**
	* Read
	* Fonction qui sert a lire les enregistrements
	* @return un tableau des enregistrements;
	*/
	// public function Read(){
	// 	if (!empty($this->fk)) {
	// 		$columnFK = key($this->fk);
	// 		$entityFK = substr($columnFK.'s', 2);
	// 		$entityOBJFK = $this->getProperty(true,$entityFK);
	// 		$entityOBJOIN = array_merge($entityOBJFK,$this->propertiesDBObject);
	// 		$entityIndiceStr = null;
	// 		$entityIndiceStrp = null;
	// 		$addJoinStr = null;
	// 		foreach ($this->getProperty(true) as $key => $value) {
	// 			$entityIndiceStr .= $this->entity.'.'.$value.' AS '.$this->entity.ucfirst($value).', ';
	// 		}
	// 		foreach ($entityOBJFK as $key => $value) {
	// 			$end = ($key == count($entityOBJFK)-1)? null:', ';
	// 			$entityIndiceStr .= $entityFK.'.'.$value.' AS '.$entityFK.ucfirst($value).$end;
	// 		}
	// 		if (!empty($this->getFK($entityFK))) {
	// 			$fkid = key($this->getFK($entityFK));
	// 			$entityFKFK = substr(key($this->getFK($entityFK)).'s', 2);
	// 			foreach ($this->getProperty(true,$entityFKFK) as $key => $value) {
	// 				$entityIndiceStrp .= $entityFKFK.'.'.$value.' AS '.$entityFKFK.ucfirst($value).', ';
	// 			}
	// 			// SELECT * FROM Animals INNER JOIN Breeds ON Animals.idBreed = Breeds.id INNER JOIN Species ON Breeds.idSpecie = Species.id

	// 			$req = $this->db->prepare("SELECT $entityIndiceStrp $entityIndiceStr FROM $this->entity INNER JOIN $entityFK ON $this->entity.$columnFK = $entityFK.id INNER JOIN $entityFKFK ON $entityFK.$fkid = $entityFKFK.id");			
	// 			var_dump("SELECT $entityIndiceStrp $entityIndiceStr FROM $this->entity INNER JOIN $entityFK ON $this->entity.$columnFK = $entityFK.id INNER JOIN $entityFKFK ON $entityFK.$fkid = $entityFKFK.id");
	// 		}else{

	// 			$req = $this->db->prepare("SELECT $entityIndiceStr FROM $this->entity INNER JOIN $entityFK ON $this->entity.$columnFK = $entityFK.id");			
	// 		}
	// 		// var_dump("SELECT $entityIndiceStr FROM $this->entity INNER JOIN $entityFK ON $this->entity.$columnFK = $entityFK.id");
	// 	}else{	
	// 		$req = $this->db->prepare("SELECT * FROM $this->entity");
	// 	}
	// 	$req->execute();
	// 	return $req->fetchAll();
	// }

	/**
	* Read
	* Fonction qui sert a lire les enregistrements
	* @return un tableau des enregistrements;
	*/
	public function Read(){
		if (!empty($this->fk)) {
			$entityIndiceStr = null;
			$addJoinStr = null;
			$end = true;
			while ($end == true) {
				$entityNow = $this->entity;
				do{
					$bent = $entityNow;
					foreach ($this->getProperty(true, $entityNow) as $key => $value) {
						$entityIndiceStr .= $entityNow.'.'.$value.' AS '.$entityNow.ucfirst($value).', ';
					}

					$columnFK = key($this->getFK($entityNow));
					$entityNow = substr($columnFK.'s', 2);
					$aent = $entityNow;
					if (!empty($columnFK)) {
						$addJoinStr .= " INNER JOIN $aent ON $bent.$columnFK = $aent.id ";	
					}
					
				}while(!empty($columnFK));
					
				$entityIndiceStr = rtrim($entityIndiceStr,', ');
				$req = $this->db->prepare("SELECT $entityIndiceStr FROM $this->entity $addJoinStr");
				$end = false;
			}
			
			echo "</pre>";

			
		}else{	
			$req = $this->db->prepare("SELECT * FROM $this->entity");
		}
		$req->execute();
		return $req->fetchAll();
	}

	/**
	* FindById
	* Fonction qui sert a lire les enregistrements selon id
	* @return un tableau des enregistrements;
	*/
	public function FindById($id){
		$req = $this->db->prepare(" SELECT * FROM $this->entity where id = :id");
		$req->execute([':id'=> $id]);
		return $req->fetchAll();
	}

	/**
	* Update
	* Fonction qui sert a mettre à jour les enregistrements
	* @return 
	*/
	public function Update($id = null, $params = []){
		if (!empty($id)) {
			$paramsIndice = array_keys($params);
			$paramsIndiceStr = null;
			$paramsIndiceExe = [];
			foreach ($paramsIndice as $key => $value) {
				$end = ($key == count($paramsIndice)-1)? null:', ';
				$paramsIndiceStr .= $value.' = :'.$value.$end;
			}
			foreach ($params as $key => $value) {
				$paramsIndiceExe[':'.$key] = $value;
			}
			$paramsIndiceExe[':id'] = $id;

			$req = $this->db->prepare(" UPDATE $this->entity SET $paramsIndiceStr  WHERE id = :id ");
			$req->execute($paramsIndiceExe);
			
			return true;
		}else{
			return false;
		}
		
	} 

	/**
	* Delete
	* Fonction qui sert a effacer les enregistrements
	* @param $id = identifiant de l'enregistrement qui doit être effacé
	* @return un boolean pour savoir si l'action est bien effectuée
	*/
	public function Delete($id = null){
		if (!empty($id)) {
			$req = $this->db->prepare(" DELETE FROM $this->entity WHERE id = ? ");
			$req->execute([$id]);
			return true;
		}else{
			return false;
		}

	} 

}