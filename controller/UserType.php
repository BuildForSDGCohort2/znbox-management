<?php 

namespace controller;

use connections\Database;
use controller\QueryBuilder;

class UserType {

	public static function getAll() {
		$conn = Database::conn();
		$sql = "SELECT * FROM user_type;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function getBy($column, $value) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM user_type WHERE user_type.$column = $value;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
}