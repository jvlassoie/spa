<?php
/**
* 
*/
class RoleController extends Controller
{
	

	protected $entityRole; 

	function __construct(){

		parent::__construct();
		$this->entityRole = new EntityManager('Role');
	}

	
	public function view(){
		parent::view();
		return $this->render("/admin/role.php", ['a' => $this->entityRole->Read()]);

	}

	protected function deleteAction($id){
		if (!empty($id)) {
			$this->entityRole->Delete($id);
		}
		return true;
	}
	

	public function create(){
		$params = $_POST;
		if (!empty($params)) {
			$this->entityRole->Create($params);
			header('Location: http://'.$this->request->getNameServer().'/role/view/');
		}
		return $this->render("/admin/createRole.php");

	}
	public function update($id){
		$params = $_POST;
		if (!empty($params)) {
			$this->entityRole->Update($id,$params);
			header('Location: http://'.$this->request->getNameServer().'/role/view/');
		}
		return $this->render("/admin/updateRole.php", ['donnees' => $this->entityRole->FindById($id)]);

	}
}