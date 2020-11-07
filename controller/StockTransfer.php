<?php 

namespace controller;

use connections\Database;
use controller\QueryBuilder;

class StockTransfer {

	public static function add($data) {
		$conn = Database::conn();
		$sql = QueryBuilder::insert("stock_transfer", $data);
		#die($sql);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}

	public static function getBy($column, $value) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM stock_transfer WHERE stock_transfer.$column = $value;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getAll() {
		$conn = Database::conn();
		$sql = "SELECT * FROM stock_transfer WHERE stock_transfer.isDeleted = 0;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function where($where) {
		$conn = Database::conn();
		$sql = "SELECT * FROM stock_transfer WHERE";
		foreach($where as $key => $value) {
			$key = rtrim(ltrim($conn->quote($value[0]), "'"), "'");
			$operator = rtrim(ltrim($conn->quote($value[1]), "'"), "'");
			$value = $conn->quote($value[2]);
			$sql .= " stock_transfer.$key $operator $value AND";
		}
		$sql = rtrim($sql, " AND").";";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function whereAll($where) {
		$conn = Database::conn();
		$sql = "SELECT * FROM stock_transfer WHERE";
		foreach($where as $key => $value) {
			$key = rtrim(ltrim($conn->quote($value[0]), "'"), "'");
			$operator = rtrim(ltrim($conn->quote($value[1]), "'"), "'");
			$value = $conn->quote($value[2]);
			$sql .= " stock_transfer.$key $operator $value AND";
		}
		$sql = rtrim($sql, " AND").";";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function initialStock($stock) {
		$conn = Database::conn();
		$stock = $conn->quote($stock);
		$sql = "SELECT SUM(stock_transfer_item.quantity) AS total FROM stock_transfer INNER JOIN stock_transfer_item ON stock_transfer.id = stock_transfer_item.stock_transfer WHERE stock_transfer.stock_register = 1 AND stock_transfer_item.stock = $stock;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function update($id, $data) {
		$conn = Database::conn();
		$sql = QueryBuilder::update("stock_transfer", "id", $id, $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
}