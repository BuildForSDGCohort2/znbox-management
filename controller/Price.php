<?php 

namespace controller;

use connections\Database;
use controller\QueryBuilder;

class Price {

	public static function add($data) {
		$conn = Database::conn();
		$sql = QueryBuilder::insert("price", $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function getBy($column, $value) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM price WHERE price.$column = $value;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getDefault($stock) {
		$conn = Database::conn();
		$stock = $conn->quote($stock);
		$sql = "SELECT * FROM price WHERE price.stock = $stock AND price.isDefault = 1;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getAll() {
		$conn = Database::conn();
		$sql = "SELECT * FROM price WHERE price.isDeleted = 0;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function getAllBy($column, $value) {
		$conn = Database::conn();
		$sql = "SELECT * FROM price WHERE price.isDeleted = 0;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}

	public static function update($id, $data) {
		$conn = Database::conn();
		$sql = QueryBuilder::update("price", "id", $id, $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
}