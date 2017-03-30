<?php
/**
*
*/
class Database
{
	private static $_host;
	private static $_name;
	private static $_user;
	private static $_pass;

	private static $_db;

	public function __construct(string $host,string $name,string $user, string $pass){
		self::$_host = $host;
		self::$_name = $name;
		self::$_user = $user;
		self::$_pass = $pass;
	}

	public function getDB() {
		if (self::$_db === null) {
			// try{
			$pdo = new PDO('mysql:host='.self::$_host.';dbname='.self::$_name.'', self::$_user, self::$_pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$pdo->exec('SET NAMES utf8');
				// $pdo->setAttribute(PDO::ATTR_FETCH_TABLE_NAMES, true);
			self::$_db = $pdo;
			// }catch(PDOException $e){

				// throw new CustomException("Problem with Database :(, your problem is : $exception");
		}
		return self::$_db;
		// }
	}

}