<?php
/**
* 
*/
class HomeController extends Controller
{


	function __construct(){

		parent::__construct();
		
	}

	
	public function view(){
		parent::view();
		if(!empty(Session::getAuth())){
			if (Session::getAuth()->RolesName == "ROLE_ADMIN") {
				return $this->render("/admin/home/home.php");

			}else{
				return $this->render("/user/home/home.php");
			}

		}
		return $this->render("/public/home.php");

	}

}