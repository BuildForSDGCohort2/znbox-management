<?php 

namespace controller;

use controller\SaleStock;
use connections\Database;
use controller\QueryBuilder;
use stdClass;

class Sale {

	public static function add($data) {
		$conn = Database::conn();
		$sql = QueryBuilder::insert("sale", $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function update($id, $data) {
		$conn = Database::conn();
		$sql = QueryBuilder::update("sale", "id", $id, $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function getBy($column, $value) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM sale WHERE sale.$column = $value;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getAllBy($column, $value) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM sale WHERE sale.$column = $value AND sale.isDeleted = 0;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function getAll() {
		$conn = Database::conn();
		$sql = "SELECT * FROM sale WHERE sale.isDeleted = 0;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}

	public static function getTotal($id, $vat = false) {
		$total = 0;
		$sale = self::getBy('id', $id);
		foreach(SaleStock::getBy('sale', $id) as $item) {
			$total += ($sale->discount_type == 1) ? ($item['price_sale'] * $item['quantity']) - ($item['price_sale'] * $item['quantity']) * ($sale->discount / 100) : ($item['price_sale'] * $item['quantity']) - $sale->discount;
		}
		if($vat) {
			$total += ($total * ($sale->tax_percentage / 100));
		}
		return $total;
	}

	public static function getTotalDiscount($id) {
		$total = 0;
		$sale = self::getBy('id', $id);
		foreach(SaleStock::getBy('sale', $id) as $item) {
			$total += ($salesale["discount_type"] == 1) ? ($item['price_sale'] * $item['quantity']) * ($salesale["discount"] / 100) : $sale["discount"];
		}
		return $total;
	}
}