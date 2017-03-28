<?php
/**
* 
*/
class Session
{
	
	function __construct()
	{
		session_start();		
	}


	public function getSession(){
		return ;
	}



	public function setSession(){
		return $this;
	}


}