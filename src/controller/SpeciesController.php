<?php
/**
* 
*/
class SpeciesController extends Controller
{
	

	protected $entitySpecies; 

	function __construct(){

		parent::__construct();
		$this->entitySpecies = new EntityManager('Species');
	}

	
	public function view(){
		parent::view();
		return $this->render("/admin/species.php", ['a' => $this->entitySpecies->Read()]);

	}

	protected function deleteAction($id){
		if (!empty($id)) {
			$this->entitySpecies->Delete($id);
			return true;
		}else{
			return false;		
		}
	}
	
	public function create($params = []){
		if (!empty($params)) {
			$this->entitySpecies->Create($params);
		}
		return $this->render("/admin/create.php");
	}

}