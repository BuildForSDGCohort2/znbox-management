<?php 

namespace connections;

use queryBuilder\JsonQB as JQB;

class Database {

	public const HOST = "localhost";
	public const DATABASE = "znbox_stock";
	public const USERNAME = "root";
	public const PORT = "3306";
	public const PASSWORD = "";
	public const CHARSET = "utf8";

	public static function conn() {
		JQB::connect([
			'database' => Database::DATABASE,	# Database name
			'host' => Database::HOST,			# Host name
			'port' => Database::PORT,			# Connection port
			'username' => Database::USERNAME,	# Username
			'password' => Database::PASSWORD,	# Password
			'charset' => Database::CHARSET,	# Charset
		]);
	}
}