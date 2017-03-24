<?php
/**
* 
*/
class AnimalController extends Controller
{
	

	protected $entityAnimal; 

	function __construct(){

		parent::__construct();
		$this->entityAnimal = new EntityManager('Animals');
	}

	
	public function view(){
		parent::view();
		return $this->render("/admin/animal/animal.php", ['a' => $this->entityAnimal->Read()]);

	}

	protected function deleteAction($id){
		if (!empty($id)) {
			$this->entityAnimal->Delete($id);
		}
		return true;
	}
	

	public function create(){
		$params = $_POST;
		if (!empty($params)) {
			$this->entityAnimal->Create($params);
			header('Location: http://'.$this->request->getNameServer().'/animal/view/');
		}
		return $this->render("/admin/animal/createAnimal.php");

	}
	public function update($id){
		$params = $_POST;
		if (!empty($params)) {
			$this->entityAnimal->Update($id,$params);
			header('Location: http://'.$this->request->getNameServer().'/animal/view/');
		}
		return $this->render("/admin/animal/updateAnimal.php", ['donnees' => $this->entityAnimal->FindById($id)]);

	}
}