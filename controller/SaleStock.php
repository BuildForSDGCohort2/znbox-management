<?php 

namespace controller;

use queryBuilder\JsonQB as JQB;
use stdClass;

class SaleStock {

	public static function add($request) {
		$result = JQB::Insert('sale_stock', $request)->execute();
		return $result;
	}

	public static function getBy($column, $value) {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['sale_stock'],
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
			'from' => ['sale_stock'],
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
		$result = JQB::Update('sale_stock', [
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

	public static function delete($id) {
		$result = JQB::Delete('sale_stock', [
			'where' => [
				[
					"columns" => [
						"id" => $id,
					]
				]
			]
		])->execute();
		return $result;
	}
	public static function deleteBySale($sale) {
		$result = JQB::Delete('sale_stock', [
			'where' => [
				[
					"columns" => [
						"sale" => $sale,
					]
				]
			]
		])->execute();
		return $result;
	}

	public static function getTotalAmount($stock) {
		$result = JQB::Select([
			'columns' => ['*', 'SUM(quantity) AS total'],
			'from' => ['sale_stock'],
			'where' => [
				[
					"columns" => [
						"stock" => $stock,
					]
				]
			]
		])->execute();
		return $result;
	}
}