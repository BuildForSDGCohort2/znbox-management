<?php 

namespace controller;

use queryBuilder\JsonQB as JQB;
use stdClass;

class UserType {

	public static function getAll() {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['user_type']
		])->execute();
		return $result;
	}

	public static function getBy($column, $value) {
		$result = JQB::Select([
			"columns" => ["*"],
			"from" => ["user_type"],
			"where" => [
				[
					"columns" => [
						"$column" => $value
					]
				]
			]
		])->execute();
		return $result;
	}
}