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
		$result = JQB::Select([
			'columns' => ['*', 'SUM(quantity) AS total'],
			'from' => ['purchase_item'],
			'join' =>[
				'inner' => [
					'table' => 'purchase',
					'on' => [
						[
							'columns' => [
								'purchase.id' => 'purchase_item.purchase',
							]
						]
					],
				]
			],
			'where' => [
				[
					"columns" => [
						"stock" => $stock,
						"purchase.isDeleted" => 0,
						"purchase.isStock" => 1,
					]
				]
			]
		])->execute();
		return $result;
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM purchase WHERE purchase.$column = $value;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getTotalPrice($id) {
		$total = 0;
		foreach(PurchaseItem::getBy("purchase", $id)->data as $item) {
			$total += $item["price_unity"];
		}
		return $total;
	}
}