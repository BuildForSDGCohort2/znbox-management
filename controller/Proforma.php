<?php 

namespace controller;

use connections\Database;
use controller\QueryBuilder;

class Proforma {

	public static function add($data) {
		$conn = Database::conn();
		$sql = QueryBuilder::insert("proforma", $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function update($id, $data) {
		$conn = Database::conn();
		$sql = QueryBuilder::update("proforma", "id", $id, $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function getBy($column, $value) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM proforma WHERE proforma.$column = $value;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getAllBy($column, $value) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM proforma WHERE proforma.$column = $value;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function getAll() {
		$conn = Database::conn();
		$sql = "SELECT * FROM proforma;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}

	public static function getTotalAmount($stock) {
		$conn = Database::conn();
		$stock = $conn->quote($stock);
		$sql = "SELECT SUM(proforma.quantity) AS total FROM proforma WHERE proforma.stock = $stock AND proforma.isDeleted = 0;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getLast() {
		$conn = Database::conn();
		$sql = "SELECT * FROM proforma ORDER BY proforma.id DESC LIMIT 1;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getTotal($id) {
		$proforma = self::getBy("id", $id);
		$sale = Sale::getBy("id", $proforma["sale"]);

		$itens = (array) json_decode($proforma["itens"]);
		$subtotal = 0;
		$invoice_itens = [];
		foreach($itens as $item) {
			$item = (array) $item;
			$invoice_itens[] = [
				"description" => $item["stock"]->name,
				"quantity" => $item["quantity"],
				"price" => $item["price_sale"],
				"total" => $item["quantity"] * $item["price_sale"],
			];
			$subtotal += (floatval($item["price_sale"]) * intval($item["quantity"]));
		}

		$discount = ($sale["discount_type"] == 1) ? ($subtotal * ($sale["discount"] / 100)) : $sale["discount"];
		return ($subtotal - $discount) + ($subtotal - $discount) * ($sale["tax_percentage"] / 100);
	}
}