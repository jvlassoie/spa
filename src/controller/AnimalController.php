<?php
/**
* 
*/
class AnimalController extends Controller
{
	

	protected $entityAnimal; 
	protected $entityBreed; 
	protected $entitySpecie; 

	function __construct(){

		parent::__construct();
		$this->entityAnimal = new EntityManager('Animals');
		$this->entityBreed = new BreedManager();
		$this->entitySpecie = new EntityManager('Species');
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
		unset($params["idSpecie"]);
		if (!empty($params)) {
			$this->entityAnimal->Create($params);
			$this->redirect('http://'.$this->request->getNameServer().'/animal/view/');
		}
		return $this->render("/admin/animal/createAnimal.php", ['listeSpecies' => $this->entitySpecie->Read()]);

	}
	public function update($id){
		$params = $_POST;
		unset($params["idSpecie"]);
		if (!empty($params)) {
			$this->entityAnimal->Update($id,$params);
			$this->redirect('http://'.$this->request->getNameServer().'/animal/view/');
		}
		return $this->render("/admin/animal/updateAnimal.php", ['donnees' => $this->entityAnimal->FindById($id), 'listeSpecies' => $this->entitySpecie->Read(), 'listeBreeds' => $this->entityBreed->findByIdSpecie($this->entityAnimal->FindById($id)[0]->SpeciesId)]);

	}
}