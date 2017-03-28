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
		require "../app/view/public/header.php";
		require "../app/view/$template";
		require "../app/view/public/footer.php";
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
	
	public static function redirectStatic($url, $statusCode = 303)
	{
		header('Location: ' . $url, true, $statusCode);
		exit();
	}

	public function redirect($url, $statusCode = 303)
	{
		header('Location: ' . $url, true, $statusCode);
		exit();
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