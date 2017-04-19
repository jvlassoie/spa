<?php
/**
* Controller parent
*/
class Controller
{

	public $request;
	
	function __construct(){

		Session::start();
		$this->request = new Request();
		Router::parseUrl($this->request->getUrl(), $this->request);

		
	}

	public function render($template, $tab = [] ) {
		ob_start();
		extract($tab);
		require "../app/view/public/header.php";
		require "../app/view/$template";
		include "../app/view/public/footer.php";
		echo ob_get_clean();
		return true;
	}
	public function responseData($tab = []) {
		ob_start();
		extract($tab);
		require "../app/view/public/response.php";
		echo ob_get_clean();
		return true;
	}

	public static function renderStatic($template, $tab = [] ) {
		ob_start();
		extract($tab);
		require "../app/view/public/header.php";
		require "../app/view/$template";
		require "../app/view/public/footer.php";
		echo ob_get_clean();
		return true;
	}
	
	public static function redirectStatic($url, $statusCode = 301)
	{
		header('Location: ' . $url, true, $statusCode);
		die;
	}

	public function redirect($url, $statusCode = 301)
	{

		header('Location: ' . $url, true, $statusCode);
		die;
	}

	public function view(){
		if (!empty($this->request->getParams())) {
			
			$action = $this->request->getParams()[0].'Action';
			$params = $this->request->getParams();
			unset($params[0]);
			if(method_exists($this, $action)){
				call_user_func_array([$this,$action], $params);	

			}
		}


	}

	public function secureForm($params = []){
		$paramsSecure = [];
		foreach ($params as $key => $value) {
			$paramsSecure[$key] = htmlentities(trim($value));
		}
		return $paramsSecure;
	}

	public function allow($tabRole = []){
		$role = (!empty(Session::getAuth()->RolesName))?Session::getAuth()->RolesName:null;
		if(in_array($role, $tabRole) != true){
			return $this->redirect('http://'.$this->request->getNameServer().'/error/restrict');
		}
	}

}