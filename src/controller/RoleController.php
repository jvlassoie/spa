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
		$this->allow(['ROLE_ADMIN']);
		parent::view();
		$pagination = new Pagination($this->entityRole->counter()->Counter,4,$page);

		return $this->render("/admin/role/role.php", ['a' => $this->entityRole->Read($pagination),'pagination' => $pagination]);

	}

	public function delete($id){
		$this->allow(['ROLE_ADMIN']);
		if (!empty($id)) {
			$this->entityRole->Delete($id);
			$this->redirect('http://'.$this->request->getNameServer().'/role/view/');
			return true;

		}
		return false;
	}
	

	public function create(){
		$this->allow(['ROLE_ADMIN']);
		$params = $_POST;
		if (!empty($params)) {
			$params = $this->secureForm($params);
			$this->entityRole->Create($params);
			$this->redirect('http://'.$this->request->getNameServer().'/role/view/');
		}
		return $this->render("/admin/role/createRole.php");

	}
	public function update($id){
		$this->allow(['ROLE_ADMIN']);
		$params = $_POST;
		if (!empty($params)) {
			$params = $this->secureForm($params);
			$this->entityRole->Update($id,$params);
			$this->redirect('http://'.$this->request->getNameServer().'/role/view/');
		}
		return $this->render("/admin/role/updateRole.php", ['donnees' => $this->entityRole->FindById($id)]);

	}
}