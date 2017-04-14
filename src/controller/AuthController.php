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

	return $this->render("/user/auth/register.php");
	}
	public function login(){

	return $this->render("/user/auth/login.php");

	}
	public function lougout(){

	}
	
	
}