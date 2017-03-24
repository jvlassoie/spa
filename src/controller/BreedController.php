<?php
/**
* 
*/
class BreedController extends Controller
{
	

	protected $entityBreed; 

	function __construct(){

		parent::__construct();
		$this->entityBreed = new EntityManager('Breeds');
	}

	
	public function view(){
		parent::view();
		return $this->render("/admin/breed/breed.php", ['a' => $this->entityBreed->Read()]);

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
			$this->entityBreed->Create($params);
			header('Location: http://'.$this->request->getNameServer().'/breed/view/');
		}
		return $this->render("/admin/breed/createBreed.php");

	}
	public function update($id){
		$params = $_POST;
		if (!empty($params)) {
			$this->entityBreed->Update($id,$params);
			header('Location: http://'.$this->request->getNameServer().'/breed/view/');
		}
		return $this->render("/admin/breed/updateBreed.php", ['donnees' => $this->entityBreed->FindById($id)]);

	}
}