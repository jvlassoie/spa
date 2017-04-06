<?php

/**
* 
*/
class Debug
{
	
	public static function debugV($donnees){
		echo "<pre>";
		var_dump($donnees);
		echo "</pre>";
	}
	public static function debugP($donnees){
		echo "<pre>";
		print_r($donnees);
		echo "</pre>";
	}
}