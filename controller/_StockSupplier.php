<?php 

namespace controller;

use connections\Database;
use controller\QueryBuilder;

class _StockSupplier {

	public static function add($data) {
		$conn = Database::conn();
		$sql = QueryBuilder::insert("_stock_supplier", $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}

	public static function getBy($column, $value) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM _stock_supplier WHERE _stock_supplier.$column = $value;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getAll() {
		$conn = Database::conn();
		$sql = "SELECT * FROM _stock_supplier;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}

	public static function update($id, $data) {
		$conn = Database::conn();
		$sql = QueryBuilder::update("_stock_supplier", "id", $id, $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}

	public static function delete($column, $value) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "DELETE FROM _stock_supplier WHERE _stock_supplier.$column = $value";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
}