<?php 

namespace controller;

use queryBuilder\JsonQB as JQB;
use stdClass;

class Customer {

	public static function add($request) {
		$result = JQB::Insert('customer', $request)->execute();
		return $result;
	}

	public static function getBy($column, $value) {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['customer'],
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
	public static function getAll() {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['customer'],
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
		$result = JQB::Update('customer', [
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