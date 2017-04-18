<?php
/**
* 
*/
class Session
{
	
	public static function start()
	{
		if(session_status() == PHP_SESSION_NONE){
			// session_cache_limiter('private_no_expire');
			return session_start();
		}else{
			return false;
		}
	}

	public static function setFlash($type,$msg){
		$_SESSION['flash'][$type] = $msg;
	}
	
	public static function getFlash(){
		return $_SESSION['flash'];		
	}

	public static function getFlashAlert(){
		if (isset($_SESSION['flash'])){

			foreach ($_SESSION['flash'] as $type => $message){
				echo "<div class='alert alert-$type'>
				$message
			</div>";
		}
		unset($_SESSION['flash']); 
	} 
}

public static function setAuth($user){
	$_SESSION['auth'] = $user;
}

public static function getAuth(){
	if (!empty($_SESSION['auth'])) {

		return $_SESSION['auth'];		
	}
		return false;
}
public static function destroyAuth(){
	if (!empty($_SESSION['auth'])) {
		unset($_SESSION['auth']);
	}
}


public static function set($name,$value){
	$_SESSION[$name] = $value;

}

public static function get($name){
	if (!empty($_SESSION[$name])) {
		return $_SESSION[$name];
	}
	return false;
}

public static function destroy($name){
	unset($_SESSION[$name]);
}

public static function getAllSession(){
	return $_SESSION;
}

}