<?php
/**
* 
*/
class EntityManager
{

	protected $entity;
	protected $dataBaseObject;
	protected $db;
	protected $propertiesDBObject = [];
	protected $fk = [];
	
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
	* paramsIndiceStr
	* Fonction qui construit une chaine de caractère
	* @param $params = un tableau de paramètre
	* @return $paramIndiceStr  = la chaine
	*/
	public function paramsIndiceStr($params = []){
		$paramsIndice = array_keys($params);
		$paramsIndiceStr = null;
		foreach ($paramsIndice as $key => $value) {
			$end = ($key == count($paramsIndice)-1)? null:', ';
			$paramsIndiceStr .= ':'.$value.$end;
		}
		return $paramsIndiceStr;
	}	

	/**
	* paramsIndiceStrEquals
	* Fonction qui construit une chaine de caractère
	* @param $params = un tableau de paramètre
	* @return $paramIndiceStr  = la chaine
	*/
	public function paramsIndiceStrEquals($params = []){
		$paramsIndice = array_keys($params);
		$paramsIndiceStr = null;
		foreach ($paramsIndice as $key => $value) {
			$end = ($key == count($paramsIndice)-1)? null:', ';
			$paramsIndiceStr .= $value.' = :'.$value.$end;
		}
		return $paramsIndiceStr;
	}
	
	/**
	* paramsIndiceExe
	* Fonction qui construit un tableau associatif
	* @param $params = un tableau de paramètre
	* @return $paramIndiceExe  = le tableau
	*/
	public function paramsIndiceExe($params = [], $id = null){
		$paramsIndiceExe = [];
		foreach ($params as $key => $value) {
			$paramsIndiceExe[':'.$key] = $value;
		}
		if ($id != null) {
			$paramsIndiceExe[':id'] = $id;
			
		}

		return $paramsIndiceExe;
	}

	/**
	* Create
	* Fonction qui sert a créer un enregistrements
	* @param $params = un tableau de paramètre
	* @return un boolean pour savoir si l'action est bien effectuée
	*/
	public function Create($params = []){
		if (!empty($params)) {	
			$paramsIndiceStr = $this->paramsIndiceStr($params);
			$paramsIndiceExe = $this->paramsIndiceExe($params);
			
			$columnsName = implode(",", $this->propertiesDBObject);
			$params = implode(',',$params);

			$req = $this->db->prepare("INSERT INTO $this->entity ($columnsName) VALUES ($paramsIndiceStr)");
			$req->execute($paramsIndiceExe);
			return true;
		}else{
			
			return false;
		}
		
	}

	/**
	* Read
	* Fonction qui sert a lire les enregistrements et trouve automatiquement les FKs 
	* @return un tableau des enregistrements;
	*/
	public function Read(Pagination $pagination = null, $order = 'DESC'){
		if ($pagination != null) {

			if (!empty($this->fk)) {
				$entityIndiceStr = null;
				$addJoinStr = null;
				$end = true;
				if($end == true) {
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
					$req = $this->db->prepare('SELECT '.$entityIndiceStr.' FROM '.$this->entity.' '.$addJoinStr.' ORDER BY '. $this->entity.'.id '.$order.' '.$pagination->getLimit());
					$end = false;
				}
			}else{	
				$req = $this->db->prepare('SELECT * FROM '.$this->entity.' ORDER BY '.$this->entity.'.id '.$order.' '.$pagination->getLimit());
			}
			$req->execute();
			return $req->fetchAll();

		}else{

			if (!empty($this->fk)) {
				$entityIndiceStr = null;
				$addJoinStr = null;
				$end = true;
				if($end == true) {
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
					$req = $this->db->prepare("SELECT $entityIndiceStr FROM $this->entity $addJoinStr ORDER BY $this->entity.id $order");
					$end = false;
				}
			}else{	
				
				$req = $this->db->prepare("SELECT * FROM $this->entity ORDER BY $this->entity.id $order");
			}
			$req->execute();
			return $req->fetchAll();
		}
	}

	/**
	* FindById
	* Fonction qui sert a lire les enregistrements selon id
	* @return un tableau des enregistrements;
	*/
	public function FindById($id){
		if (!empty($this->fk)) {
			$entityIndiceStr = null;
			$addJoinStr = null;
			$end = true;
			if($end == true) {
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
				$req = $this->db->prepare("SELECT $entityIndiceStr FROM $this->entity $addJoinStr WHERE $this->entity.id = :id");
				$end = false;
			}
		}else{	
			$req = $this->db->prepare(" SELECT * FROM $this->entity where id = :id");
		}
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
			
			$paramsIndiceStr = $this->paramsIndiceStrEquals($params);
			$paramsIndiceExe = $this->paramsIndiceExe($params,$id);
			

			$req = $this->db->prepare("UPDATE $this->entity SET $paramsIndiceStr  WHERE id = :id");
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
			$req = $this->db->prepare("DELETE FROM $this->entity WHERE id = ? ");
			$req->execute([$id]);
			return true;
		}else{
			return false;
		}

	} 


	public function lastId(){
		return $this->db->lastInsertId();
	}
	

	public function counter(){
		$req = $this->db->prepare("SELECT COUNT(*) as Counter FROM $this->entity");
		$req->execute();
		return $req->fetch();

	}

}