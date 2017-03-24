<?php
/**
* 
*/
class EntityManager
{

	private $entity;
	private $dataBaseObject;
	private $db;
	private $propertyDBObject = [];
	
	function __construct($entity)
	{
		$this->entity = $entity;
		$this->dataBaseObject = new Database('127.0.0.1','spa','root','');
		$this->db = $this->dataBaseObject->getDB();
		$this->propertyDBObject = $this->getProperty();

	}
	/**
	* getProperty
	* Fonction qui sert récupère les noms des champs de la entity
	* @param $id = est un boolean pour savoir si on veut le champ id par default nom car il est auto-incrémenté 
	* donc par nécessaire de faire de modification dessus.
	* @return un boolean pour savoir si l'action est bien effectuée
	*/
	public function getProperty($id = false){
		$req = $this->db->prepare(" SHOW FULL COLUMNS FROM $this->entity ");
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
	* Create
	* Fonction qui sert a créer un enregistrements
	* @param $params = un tableau de paramètre
	* @return un boolean pour savoir si l'action est bien effectuée
	*/
	public function Create($params = []){
		if (!empty($params)) {	
			$columnsName = implode(",", $this->propertyDBObject);
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
	public function Read(){
		$req = $this->db->prepare(" SELECT * FROM $this->entity");
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