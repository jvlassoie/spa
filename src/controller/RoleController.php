<?php
/**
* 
*/
class RoleController extends Controller
{
	

	protected $entityRole; 

	function __construct(){

		parent::__construct();
		$this->entityRole = new EntityManager('Roles');
	}

	
	public function view(){
		parent::view();
		return $this->render("/admin/role/role.php", ['a' => $this->entityRole->Read()]);

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
			redirect('Location: http://'.$this->request->getNameServer().'/role/view/');
		}
		return $this->render("/admin/role/createRole.php");

	}
	public function update($id){
		$params = $_POST;
		if (!empty($params)) {
			$this->entityRole->Update($id,$params);
			redirect('Location: http://'.$this->request->getNameServer().'/role/view/');
		}
		return $this->render("/admin/role/updateRole.php", ['donnees' => $this->entityRole->FindById($id)]);

	}
}