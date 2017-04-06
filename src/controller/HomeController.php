<?php
/**
* 
*/
class HomeController extends Controller
{

	protected $entityUser; 

	function __construct(){

		parent::__construct();
		
	}

	
	public function view(){
		parent::view();
		return $this->render("/public/home.php");

	}

}