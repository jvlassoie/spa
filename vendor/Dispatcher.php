<?php
/**
* 
*/
class Dispatcher{


	private $request;

	function __construct(){

		//appel de la méthode au controller via l'url
		$this->setRequest();
		Router::parseUrl($this->getRequest()->getUrl(),$this->getRequest());

		$classController = ucfirst($this->getRequest()->getController()).'Controller';

		if (empty($this->getRequest()->getController())) {
			require("../app/view//public/home.php");
		}elseif(class_exists($classController) && method_exists($classController, $this->getRequest()->getAction())){
			call_user_func_array([new $classController(), $this->getRequest()->getAction()], $this->request->getParams());
		}else{
			header($_SERVER["SERVER_PROTOCOL"]." 404 No Found", true, 404);
			require("../app/view/error/error404.php");
		}
		// echo "<pre>";
		// 	print_r($_SERVER);
		// echo "</pre>";
	}

	public function getRequest(){
		return $this->request;		
	}

	public function setRequest(){

		$this->request = new Request();
		return $this;
	}


}