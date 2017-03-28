<?php
/**
* 
*/
class Dispatcher{


	private $request;

	function __construct(){

		try{
		//appel de la méthode au controller via l'url
			$this->setRequest();
			Router::parseUrl($this->getRequest()->getUrl(),$this->getRequest());

			$classController = ucfirst($this->getRequest()->getController()).'Controller';

			if (empty($this->getRequest()->getController())) {
				Controller::renderStatic("public/home.php");
			}elseif(class_exists($classController) && method_exists($classController, $this->getRequest()->getAction())){
				$GLOBALS['requestGlobal'] = $this->getRequest();
				call_user_func_array([new $classController(), $this->getRequest()->getAction()], $this->request->getParams());
			}else{
				Controller::redirectStatic($_SERVER["SERVER_PROTOCOL"]." 404 No Found", true, 404);
				Controller::renderStatic("error/error404.php");

			}
		}catch(Exception $e){
			$link = $this->request->getNameServer();
			$a = new CustomException($e->getMessage(), 1, $e);
			Controller::renderStatic("error/error.php",['error' =>  $a->messageError(), 'link' => $link]);
		}
				
	}

	public function getRequest(){
		return $this->request;		
	}

	public function setRequest(){

		$this->request = new Request();
		return $this;
	}


}