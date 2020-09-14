<?php 

namespace controller;

use connections\Database;
use controller\QueryBuilder;

class PurchaseItem {

	public static function add($data) {
		$conn = Database::conn();
		$sql = QueryBuilder::insert("purchase_item", $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function update($id, $data) {
		$conn = Database::conn();
		$sql = QueryBuilder::update("purchase_item", "id", $id, $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function getBy($column, $value) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM purchase_item WHERE purchase_item.$column = $value;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getAllBy($column, $value) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM purchase_item WHERE purchase_item.$column = $value;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function getAll() {
		$conn = Database::conn();
		$sql = "SELECT * FROM purchase_item;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}

	public static function delete($id) {
		$conn = Database::conn();
		$sql = "DELETE FROM purchase_item WHERE purchase_item.id = $id;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function deleteByPurchase($purchase) {
		$conn = Database::conn();
		$sql = "DELETE FROM purchase_item WHERE purchase_item.purchase = $purchase;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
}