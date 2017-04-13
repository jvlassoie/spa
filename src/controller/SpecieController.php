<?php
/**
* 
*/
class SpecieController extends Controller
{
	

	protected $entitySpecie; 

	function __construct(){

		parent::__construct();
		$this->entitySpecie = new EntityManager('Species');
	}

	
	public function view(){
		parent::view();
		return $this->render("/admin/specie/specie.php", ['a' => $this->entitySpecie->Read()]);

	}

	protected function deleteAction($id){
		if (!empty($id)) {
			$this->entitySpecie->Delete($id);
		}
		return true;
	}
	

	public function create(){
		$params = $_POST;
		if (!empty($params)) {
			$params = $this->secureForm($params);
			$this->entitySpecie->Create($params);
			$this->redirect('http://'.$this->request->getNameServer().'/specie/view/');
		}
		return $this->render("/admin/specie/createSpecie.php");

	}
	public function update($id){
		$params = $_POST;
		if (!empty($params)) {
			$params = $this->secureForm($params);
			$this->entitySpecie->Update($id,$params);
			$this->redirect('http://'.$this->request->getNameServer().'/specie/view/');
		}
		return $this->render("/admin/specie/updateSpecie.php", ['donnees' => $this->entitySpecie->FindById($id)]);

	}
}