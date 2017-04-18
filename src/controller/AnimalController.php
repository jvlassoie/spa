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
		$this->entityAnimal = new AnimalManager();
		$this->entityBreed = new BreedManager();
		$this->entitySpecie = new EntityManager('Species');
	}

	
	public function view($page = 1){
		parent::view();
		$pagination = new Pagination($this->entityAnimal->counter()->Counter,4,$page);
		$role = (!empty(Session::getAuth()->RolesName))?Session::getAuth()->RolesName:null;
		if ($role == 'ROLE_ADMIN') {
			return $this->render("/admin/animal/animal.php", ['a' => $this->entityAnimal->Read($pagination),'pagination' => $pagination]);
		}else{
			return $this->render("/user/animal/animal.php", ['a' => $this->entityAnimal->Read($pagination),'pagination' => $pagination]);

		}

	}

	public function delete($id){
		$this->allow(['ROLE_ADMIN']);
		if (!empty($id)) {
			$this->entityAnimal->Delete($id);
			$this->redirect('http://'.$this->request->getNameServer().'/animal/view/');
			return true;
		}
		return false;
	}
	

	public function create(){
		$this->allow(['ROLE_ADMIN']);
		$params = $_POST;
		if (!empty($params)) {
			unset($params["idSpecie"]);
			$params = $this->secureForm($params);
			$this->entityAnimal->Create($params);
			$this->redirect('http://'.$this->request->getNameServer().'/animal/view/');
		}
		return $this->render("/admin/animal/createAnimal.php", ['listeSpecies' => $this->entitySpecie->Read()]);

	}
	public function update($id){
		$this->allow(['ROLE_ADMIN']);
		$params = $_POST;
		if (!empty($params)) {
			unset($params["idSpecie"]);
			$params = $this->secureForm($params);
			$this->entityAnimal->Update($id,$params);
			$this->redirect('http://'.$this->request->getNameServer().'/animal/view/');
		}
		return $this->render("/admin/animal/updateAnimal.php", ['donnees' => $this->entityAnimal->FindById($id), 'listeSpecies' => $this->entitySpecie->Read(), 'listeBreeds' => $this->entityBreed->findByIdSpecie($this->entityAnimal->FindById($id)[0]->SpeciesId)]);

	}

	public function response($id){
		$res = json_encode($this->entityAnimal->FindByIdBreed($id));
		return $this->responseData(['response' => $res ]);
	}

	
	public function responseAnimal($id){
		$res = json_encode($this->entityAnimal->FindById($id));
		return $this->responseData(['response' => $res ]);
	}
}