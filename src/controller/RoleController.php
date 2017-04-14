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

	
	public function view($page = 1){
		parent::view();
		$pagination = new Pagination($this->entityRole->counter()->Counter,4,$page);

		return $this->render("/admin/role/role.php", ['a' => $this->entityRole->Read($pagination),'pagination' => $pagination]);

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
			$params = $this->secureForm($params);
			$this->entityRole->Create($params);
			$this->redirect('http://'.$this->request->getNameServer().'/role/view/');
		}
		return $this->render("/admin/role/createRole.php");

	}
	public function update($id){
		$params = $_POST;
		if (!empty($params)) {
			$params = $this->secureForm($params);
			$this->entityRole->Update($id,$params);
			$this->redirect('http://'.$this->request->getNameServer().'/role/view/');
		}
		return $this->render("/admin/role/updateRole.php", ['donnees' => $this->entityRole->FindById($id)]);

	}
}