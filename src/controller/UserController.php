<?php
/**
* 
*/
class UserController extends Controller
{

	protected $entityUser; 
	protected $entityRole; 

	function __construct(){

		parent::__construct();
		$this->entityUser = new EntityManager('Users');
		$this->entityRole = new EntityManager('Roles');
	}

	
	public function view($page = 1){
		parent::view();
		$pagination = new Pagination($this->entityUser->counter()->Counter,4,$page);

		return $this->render("/admin/user/user.php", ['a' => $this->entityUser->Read($pagination),'pagination' => $pagination]);

	}

	protected function deleteAction($id){
		if (!empty($id)) {
			$this->entityUser->Delete($id);
		}
		return true;
	}
	

	public function create(){
		$params = $_POST;
		if (!empty($params)) {
			$params = $this->secureForm($params);
			$this->entityUser->Create($params);
			$this->redirect('http://'.$this->request->getNameServer().'/user/view/');
		}
		return $this->render("/admin/user/createUser.php", ['role' => $this->entityRole->Read()]);

	}
	public function update($id){
		$params = $_POST;
		if (!empty($params)) {
			$params = $this->secureForm($params);
			$this->entityUser->Update($id,$params);
			$this->redirect('http://'.$this->request->getNameServer().'/user/view/');
		}
		return $this->render("/admin/user/updateUser.php", ['donnees' => $this->entityUser->FindById($id), 'role' => $this->entityRole->Read()]);

	}
}