<?php
/**
* Router parse l'url
*/
class Router
{
	
	public static function parseUrl($url, Request $request)
	{
		
		$url = trim($url,'/');
		$params = explode('/', $url);
		$request->setController(isset($params[0]) ? $params[0] : null);
		$request->setAction(isset($params[1]) ? $params[1]: null); 
		$request->setParams(array_slice($params,2)); 
		return true;



	}
}