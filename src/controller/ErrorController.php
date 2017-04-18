<?php
/**
* 
*/
class ErrorController extends Controller
{


	function __construct(){

		parent::__construct();
		
	}

	
	public function restrict(){
		parent::view();
		Session::setFlash("danger","Acces interdit");
		return $this->render("/error/error.php",['link' =>  $this->request->getNameServer(), 'error' => 'Access interdit']);

	}

}