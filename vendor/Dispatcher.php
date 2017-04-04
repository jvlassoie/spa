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
		} catch(CustomException $cE) {
			error_log($cE->getMessage());
			$this->errorLogWrite($cE->getMessage());
			Controller::renderStatic("error/error.php",['error' =>  $cE->message(), 'link' =>  $this->request->getNameServer()]);
		} catch(Exception $e) {
			error_log($e->getMessage());
			$this->errorLogWrite($e->getMessage());
			Controller::renderStatic("error/error.php",['error' =>  'une erreur s\'est produite ...', 'link' =>  $this->request->getNameServer()]);
		}
				
	}

	public function getRequest(){
		return $this->request;		
	}

	public function setRequest(){

		$this->request = new Request();
		return $this;
	}

	public function errorLogWrite($message){
		$today = date("Y-m-d H:i:s");     
		$file = fopen('../var/logs/error.log', 'a+');
		fputs($file, '['.$today.']');
		fputs($file, "\t");
		fputs($file, $message);
		fputs($file, "\n");
		fclose($file);
		return true;
	}
}