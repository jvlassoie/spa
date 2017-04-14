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
		parent::view();
		$pagination = new Pagination($this->entityBreed->counter()->Counter,4,$page);

		return $this->render("/admin/breed/breed.php", ['a' => $this->entityBreed->Read($pagination),'pagination' => $pagination]);

	}

	protected function deleteAction($id){
		if (!empty($id)) {
			$this->entityBreed->Delete($id);
		}
		return true;
	}
	

	public function create(){
		$params = $_POST;
		if (!empty($params)) {
			$params = $this->secureForm($params);
			$this->entityBreed->Create($params);
			$this->redirect('http://'.$this->request->getNameServer().'/breed/view/');
		}
		return $this->render("/admin/breed/createBreed.php", ['listeSpecies' => $this->entitySpecie->Read($id)]);

	}
	public function update($id){
		$params = $_POST;
		if (!empty($params)) {
			$params = $this->secureForm($params);
			$this->entityBreed->Update($id,$params);
			$this->redirect('http://'.$this->request->getNameServer().'/breed/view/');
		}	
		return $this->render("/admin/breed/updateBreed.php", ['donnees' => $this->entityBreed->FindById($id), 'listeSpecies' => $this->entitySpecie->Read($id)]);

	}

	public function response($id){
		$res = json_encode($this->entityBreed->findByIdSpecie($id));
		return $this->responseData(['response' => $res ]);
	}
}