<?php
/**
* 
*/
class AuthController extends Controller
{
	

	protected $entityUser; 

	function __construct(){

		parent::__construct();
		$this->entityUser = new UserManager();
	}


	public function register(){
		$params = $_POST;
		if (!empty($params)) {
			$params = $this->secureForm($params);
			if ($params['password'] != $params['verifPassword']) {
				Session::setFlash('danger', "Les deux mots de passe sont différents");
				return $this->redirect('http://'.$this->request->getNameServer().'/auth/register/');
			}
			if ($this->entityUser->countExists($params['username'],$params['email'])->CountUser > 0) {
				Session::setFlash('danger', "Email ou username déja présent dans la base de donnée");
				return $this->redirect('http://'.$this->request->getNameServer().'/auth/register');

			}else{

				$params['password'] = password_hash($params['password'],PASSWORD_BCRYPT);
				unset($params['verifPassword']);
				$params['idRole'] = 2;

				$this->entityUser->Create($params);
				Session::setFlash("success","Youpi vous êtes inscrit :)");
				return $this->redirect('http://'.$this->request->getNameServer().'/');
			}	
			
		}
		return $this->render("/user/auth/register.php");
	}

	public function login(){
		$params = $_POST;
		if (!empty($params['login'])&&!empty($params['password'])) {
			$params = $this->secureForm($params);
			$login = $params['login'];
			$password = $params['password'];
			if ($this->entityUser->logUser($login)) {
				$user = $this->entityUser->logUser($login);
				if (password_verify($password,$user->UsersPassword)) {
					Session::setAuth($user);
					Session::setFlash("success","Vous êtes Connecté");
					return $this->redirect('http://'.$this->request->getNameServer().'/');
				}else{
					Session::setFlash("danger","Impossible de se connecter à se compte");
					return $this->redirect('http://'.$this->request->getNameServer().'/auth/login');
				}
			}else{
				Session::setFlash("danger","Ce compte est inconnue");
			}

		}
		return $this->render("/user/auth/login.php");

	}

	public function logout(){
		Session::destroyAuth();
		Session::setFlash("success","Vous êtes Déconnecté");
		$this->redirect('http://'.$this->request->getNameServer());

	}
	
	
}