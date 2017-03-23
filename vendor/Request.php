<?php

/**
* Contient url
*/
class Request
{

	private $urlServer;
	private $nameServer;
	private $url;
	private $controller;
	private $action;
	private $params;

	function __construct()
	{
		$this->setUrl($_SERVER['REQUEST_URI']);
		$this->setUrlServer($_SERVER['SERVER_NAME'],$_SERVER['REQUEST_URI']);
		$this->setNameServer($_SERVER['SERVER_NAME']);
	
	}

	public function getUrl(){
			
		return $this->url;

	}
	
	public function setUrl($url){

		$this->url = $url;

		return $this;
	}

	public function getController(){
			
		return $this->controller;

	}
	
	public function setController($controller){

		$this->controller = $controller;

		return $this;
	}	

	public function getAction(){
			
		return $this->action;

	}
	
	public function setAction($action){

		$this->action = $action;

		return $this;
	}	

	public function getParams(){
			
		return $this->params;

	}
	
	public function setParams($params){

		$this->params = $params;

		return $this;
	}

	public function getUrlServer(){
			
		return $this->urlServer;

	}
	
	public function setUrlServer($urlServer){

		$this->urlServer = $urlServer;

		return $this;
	}


	public function getNameServer(){
			
		return $this->nameServer;

	}
	
	public function setNameServer($nameServer){

		$this->nameServer = $nameServer;

		return $this;
	}





}