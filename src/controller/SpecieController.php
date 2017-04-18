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

	
	public function view($page = 1){
		$this->allow(['ROLE_ADMIN']);
		parent::view();
		$pagination = new Pagination($this->entitySpecie->counter()->Counter,4,$page);
		return $this->render("/admin/specie/specie.php", ['a' => $this->entitySpecie->Read($pagination),'pagination' => $pagination]);

	}

	public function delete($id){
		$this->allow(['ROLE_ADMIN']);
		if (!empty($id)) {
			$this->entitySpecie->Delete($id);
			$this->redirect('http://'.$this->request->getNameServer().'/specie/view/');
			return true;
		}
		return false;
	}
	

	public function create(){
		$this->allow(['ROLE_ADMIN']);
		$params = $_POST;
		if (!empty($params)) {
			$params = $this->secureForm($params);
			$this->entitySpecie->Create($params);
			$this->redirect('http://'.$this->request->getNameServer().'/specie/view/');
		}
		return $this->render("/admin/specie/createSpecie.php");

	}
	public function update($id){
		$this->allow(['ROLE_ADMIN']);
		$params = $_POST;
		if (!empty($params)) {
			$params = $this->secureForm($params);
			$this->entitySpecie->Update($id,$params);
			$this->redirect('http://'.$this->request->getNameServer().'/specie/view/');
		}
		return $this->render("/admin/specie/updateSpecie.php", ['donnees' => $this->entitySpecie->FindById($id)]);

	}
}