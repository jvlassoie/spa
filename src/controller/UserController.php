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
		$this->entityUser = new UserManager();
		$this->entityRole = new EntityManager('Roles');
	}

	
	public function view($order = "DESC",$page = 1){
		$this->allow(['ROLE_ADMIN']);
		parent::view();
		$pagination = new Pagination($this->entityUser->counter()->Counter,4,$page);

		return $this->render("/admin/user/user.php", ['a' => $this->entityUser->Read($pagination,$order),'pagination' => $pagination]);

	}

	public function delete($id){
		$this->allow(['ROLE_ADMIN']);
		if (!empty($id)) {
			$this->entityUser->Delete($id);
			$this->redirect('http://'.$this->request->getNameServer().'/user/view/');
			return true;
		}
		return false;
	}
	

	public function create(){
		$this->allow(['ROLE_ADMIN']);
		$params = $_POST;
		if (!empty($params)) {
			$params = $this->secureForm($params);
			if ($params['password'] != $params['verifPassword']) {
				Session::setFlash('danger', "Les deux mots de passe sont différents");
				return $this->redirect('http://'.$this->request->getNameServer().'/user/create/');
			}
			if ($this->entityUser->countExists($params['username'],$params['email'])->CountUser > 0) {
				Session::setFlash('danger', "Email ou username déja présent dans la base de donnée");
				return $this->redirect('http://'.$this->request->getNameServer().'/user/create/');

			}else{

				$params['password'] = password_hash($params['password'],PASSWORD_BCRYPT);
				unset($params['verifPassword']);

				$this->entityUser->Create($params);
				Session::setFlash("success","Youpi un nouvel inscrit :)");
				return $this->redirect('http://'.$this->request->getNameServer().'/home/view');
			}	
			
		}
		
		return $this->render("/admin/user/createUser.php", ['role' => $this->entityRole->Read()]);

	}
	public function update($id){
		$this->allow(['ROLE_ADMIN']);
		$params = $_POST;
		if (!empty($params)) {
			$params = $this->secureForm($params);
			if ($this->entityUser->FindById($id)[0]->UsersPassword != $params['password']) {
				$params['password'] = password_hash($params['password'],PASSWORD_BCRYPT);
			}
			$this->entityUser->Update($id,$params);
			$this->redirect('http://'.$this->request->getNameServer().'/user/view/');
		}
		return $this->render("/admin/user/updateUser.php", ['donnees' => $this->entityUser->FindById($id), 'role' => $this->entityRole->Read()]);

	}
}