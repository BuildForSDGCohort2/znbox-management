<?php 

namespace controller;

use connections\Database;
use controller\QueryBuilder;

class StockType {

	public static function add($data) {
		$conn = Database::conn();
		$sql = QueryBuilder::insert("stock_type", $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}

	public static function getBy($column, $value) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM stock_type WHERE stock_type.$column = $value;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getAll() {
		$conn = Database::conn();
		$sql = "SELECT * FROM stock_type;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}

	public static function update($id, $data) {
		$conn = Database::conn();
		$sql = QueryBuilder::update("stock_type", "id", $id, $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
}