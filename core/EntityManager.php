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
	* Create
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
	* Update
	* Fonction qui sert a mettre à jour les enregistrements
	* @return 
	*/
	public function Update($id = null, $params = []){
		// $params = implode(',',$params);
		// $columnsName = implode(",", $this->propertyDBObject);
		// // $req = $this->db->prepare(" UPDATE $this->entity SET   WHERE id = :id ");
		// // $req->execute([':id', $id]);
		// var_dump($columnsName);
		// var_dump($params);
		return true;
		
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