<?php 

namespace controller;

use queryBuilder\JsonQB as JQB;
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
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['price'],
			'where' => [
				[
					"columns" => [
						"stock" => $stock,
						"isDefault" => 1,
					]
				]
			]
		])->execute();
		return $result;
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