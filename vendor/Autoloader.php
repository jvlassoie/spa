<?php
/**
* 
*/
class Autoloader
{
	
	public static function register(){
		spl_autoload_register([__CLASS__,'autoload']);
	}
	
	public static function autoload($class_name){
		$rootController = '../src/controller/';
		$rootCore = '../vendor/';
		if (file_exists($rootCore.$class_name.'.php')) {
			require_once($rootCore.$class_name.'.php');
		}
		if (file_exists($rootController.$class_name.'.php')) {
			require_once($rootController.$class_name.'.php');
		}
	}


}