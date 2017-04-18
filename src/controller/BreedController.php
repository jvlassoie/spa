<?php
/**
* 
*/
class BreedController extends Controller
{
	

	protected $entityBreed; 
	protected $entitySpecie; 

	function __construct(){

		parent::__construct();
		$this->entityBreed = new BreedManager();
		$this->entitySpecie = new EntityManager('Species');

		
	}

	
	public function view($page = 1){
		$this->allow(['ROLE_ADMIN']);
		parent::view();
		$pagination = new Pagination($this->entityBreed->counter()->Counter,4,$page);

		return $this->render("/admin/breed/breed.php", ['a' => $this->entityBreed->Read($pagination),'pagination' => $pagination]);

	}

	public function delete($id){
		$this->allow(['ROLE_ADMIN']);
		if (!empty($id)) {
			$this->entityBreed->Delete($id);
			$this->redirect('http://'.$this->request->getNameServer().'/breed/view/');
			return true;
		}
		return false;
	}
	

	public function create(){
		$this->allow(['ROLE_ADMIN']);
		$params = $_POST;
		if (!empty($params)) {
			$params = $this->secureForm($params);
			$this->entityBreed->Create($params);
			$this->redirect('http://'.$this->request->getNameServer().'/breed/view/');
		}
		return $this->render("/admin/breed/createBreed.php", ['listeSpecies' => $this->entitySpecie->Read()]);

	}
	public function update($id){
		$this->allow(['ROLE_ADMIN']);
		$params = $_POST;
		if (!empty($params)) {
			$params = $this->secureForm($params);
			$this->entityBreed->Update($id,$params);
			$this->redirect('http://'.$this->request->getNameServer().'/breed/view/');
		}	
		return $this->render("/admin/breed/updateBreed.php", ['donnees' => $this->entityBreed->FindById($id), 'listeSpecies' => $this->entitySpecie->Read()]);

	}

	public function response($id){
		$res = json_encode($this->entityBreed->findByIdSpecie($id));
		return $this->responseData(['response' => $res ]);
	}
}