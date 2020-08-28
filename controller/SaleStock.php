<?php 

namespace controller;

use connections\Database;
use controller\QueryBuilder;
use stdClass;

class SaleStock {

	public static function add($data) {
		$conn = Database::conn();
		$sql = QueryBuilder::insert("sale_stock", $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function update($id, $data) {
		$conn = Database::conn();
		$sql = QueryBuilder::update("sale_stock", "id", $id, $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function getBy($column, $value) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM sale_stock WHERE sale_stock.$column = $value;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getAllBy($column, $value) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM sale_stock WHERE sale_stock.$column = $value;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function getAll() {
		$conn = Database::conn();
		$sql = "SELECT * FROM sale_stock;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}

	public static function delete($id) {
		$conn = Database::conn();
		$sql = "DELETE FROM sale_stock WHERE sale_stock.id = $id;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function deleteBySale($sale) {
		$conn = Database::conn();
		$sql = "DELETE FROM sale_stock WHERE sale_stock.sale = $sale;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}

	public static function getTotalAmount($stock) {
		$conn = Database::conn();
		$sql = "SELECT SUM(quantity) AS total FROM sale_stock WHERE sale_stock.stock = $stock;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
}