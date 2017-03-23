<?php
/**
* Controller parent
*/
class Controller
{

	public $request;
	
	function __construct(){

		$this->request = new Request();
		Router::parseUrl($this->request->getUrl(), $this->request);

		
	}

	public function render($template, $tab = [] ) {
		ob_start();
		extract($tab);
		require "../app/view/$template";
		echo ob_get_clean();
		return true;
	}
	

	public function view(){

		$action = $this->request->getParams()[0].'Action';
		$params = $this->request->getParams();
		unset($params[0]);
		if(method_exists($this, $action)){
			call_user_func_array([$this,$action], [implode(",", $params)]);		
		}


	}




}