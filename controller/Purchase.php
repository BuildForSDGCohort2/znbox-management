<?php 

namespace controller;

use connections\Database;
use controller\QueryBuilder;

class Purchase {

	public static function add($data) {
		$conn = Database::conn();
		$sql = QueryBuilder::insert("purchase", $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}

	public static function getBy($column, $value) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM purchase WHERE purchase.$column = $value;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getAll() {
		$conn = Database::conn();
		$sql = "SELECT * FROM purchase WHERE purchase.isDeleted = 0;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}

	public static function update($id, $data) {
		$conn = Database::conn();
		$sql = QueryBuilder::update("purchase", "id", $id, $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}

	public static function getTotalAmount($stock) {
		$conn = Database::conn();
		$value = $conn->quote($stock);
		$sql = "SELECT SUM(purchase_item.quantity) AS total FROM purchase_item INNER JOIN purchase ON purchase_item.purchase = purchase.id WHERE purchase.isDeleted = 0 AND purchase.isStock = 1 AND purchase_item.stock = $stock;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getTotalAmountByWarehouse($stock, $warehouse) {
		$conn = Database::conn();
		$stock = $conn->quote($stock);
		$warehouse = $conn->quote($warehouse);
		$sql = "SELECT SUM(purchase_item.quantity) AS total FROM purchase_item INNER JOIN purchase ON purchase_item.purchase = purchase.id WHERE purchase.isDeleted = 0 AND purchase.isStock = 1 AND purchase_item.stock = $stock AND purchase_item.warehouse = $warehouse;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getTotalPrice($id) {
		$total = 0;
		foreach(PurchaseItem::getAllBy("purchase", $id) as $item) {
			$total += ($item["price_unity"] * $item["quantity"]);
		}
		return $total;
	}
}