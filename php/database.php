<?php

class Database {
	private static $dbNom = 'u699663088_fishbowl' ;
	private static $dbHost = 'localhost' ;
	private static $dbUsername = 'root';
	private static $dbUserPassword = '';

	private static $cont  = null;
	private static $cont2  = null;

	public function __construct() {
		die('Init function is not allowed');
	}

	public static function connect() { // PDO connection
	   // One connection through whole application
	   	if ( null == self::$cont ) {     
				try {
					self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbNom, self::$dbUsername, self::$dbUserPassword); 
				}
				catch(PDOException $e) {
					die($e->getMessage()); 
				}
	   	}
	   	return self::$cont;
	}

	public static function connectMySQL() {	// MySQL connection
	   // One connection through whole application
	   	if ( null == self::$cont2 ) {     
					self::$cont2 = new mysqli(self::$dbHost, self::$dbUsername, self::$dbUserPassword, self::$dbNom);
	   	}
	   	if (self::$cont2->connect_error) {
    		die("Connection failed: " . self::$cont2->connect_error);
			}
	   	return self::$cont2;
	}

	public static function disconnectMySQL() {
		mysqli_close(self::$cont2);
	}

	public static function disconnect() {
		self::$cont = null;
	}
}

?>