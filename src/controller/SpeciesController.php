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
		}
		return $this->view();
	}
	

	public function create(){
		$params = $_POST;
		if (!empty($params)) {
			$this->entitySpecies->Create($params);
			header('Location: http://'.$this->request->getNameServer().'/species/view/');
		}
		return $this->render("/admin/create.php");

	}
	public function update($id,$name){
		$params = $_POST;
		if (!empty($params)) {
			$this->entitySpecies->Update($id,$params);
			header('Location: http://'.$this->request->getNameServer().'/species/view/');
		}
		return $this->render("/admin/update.php", ['name' => $name]);

	}
}