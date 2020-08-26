<?php 

namespace controller;

use queryBuilder\JsonQB as JQB;
use stdClass;

class Enterprise {

	public static function getBy($column, $value) {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['enterprise'],
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
			'from' => ['enterprise']
		])->execute();
		return $result;
	}

	public static function update($id, $values) {
		$result = JQB::Update('enterprise', [
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