<?php 

namespace controller;

use queryBuilder\JsonQB as JQB;
use stdClass;

class StockType {

	public static function add($request) {
		$result = JQB::Insert('stock_type', $request)->execute();
		return $result;
	}

	public static function getBy($column, $value) {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['stock_type'],
			'where' => [
				[
					"columns" => [
						"$column" => $value,
					]
				]
			]
		])->execute();
		return $result;
	}
	public static function getAll() {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['stock_type'],
		])->execute();
		return $result;
	}

	public static function update($id, $values) {
		$result = JQB::Update('stock_type', [
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