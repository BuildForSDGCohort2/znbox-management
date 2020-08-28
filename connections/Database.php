<?php 

namespace connections;

class Database {

	private const HOST = "localhost";
	private const PORT = "3306";
	private const DATABASE = "znbox_stock";
	private const USERNAME = "root";
	private const PASSWORD = "";
	private const CHARSET = "utf8";
	private static $connection = null;

	public static function conn() {

		$host = self::HOST;
		$port = self::PORT;
		$database = self::DATABASE;
		$username = self::USERNAME;
		$password = self::PASSWORD;
		$charset = self::CHARSET;

		if(self::$connection) {
			return self::$connection;
		}
		$connection = new \PDO("mysql:host=$host;port=$port;dbname=$database;charset=$charset", $username, $password);
		self::$connection = $connection;
		return self::$connection;
	}
}