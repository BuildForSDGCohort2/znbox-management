<?php 

namespace controller;

use connections\Database;
use controller\QueryBuilder;
use stdClass;

class Price {

	public static function add($request) {
		$result = JQB::Insert('price', $request)->execute();
		return $result;
	}

	public static function getBy($column, $value) {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['price'],
			'where' => [
				[
					"columns" => [
						"$column" => $value,
						"isDeleted" => 0
					]
				]
			]
		])->execute();
		return $result;
	}
	public static function getDefault($stock) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM price WHERE price.stock = $stock AND price.isDefault = 1;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getAll() {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['price'],
			'where' => [
				[
					"columns" => [
						"isDeleted" => 0
					]
				]
			]
		])->execute();
		return $result;
	}

	public static function update($id, $values) {
		$result = JQB::Update('price', [
			'value' => $values, 
			'where' => [
				[
					"columns" => [
						"id" => $id
					]
				]
			]
		])->execute();
		return $result;
	}
}