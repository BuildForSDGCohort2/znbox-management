<?php 

namespace controller;

use queryBuilder\JsonQB as JQB;
use stdClass;

class _StockSupplier {

	public static function add($request) {
		$result = JQB::Insert('_stock_supplier', $request)->execute();
		return $result;
	}

	public static function getBy($column, $value) {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['_stock_supplier'],
			'where' => [
				[
					"columns" => [
						"$column" => $value
					]
				]
			]
		])->execute();
		return $result;
	}
	public static function getAll() {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['_stock_supplier']
		])->execute();
		return $result;
	}

	public static function delete($where) {
		$result = JQB::Delete('_stock_supplier', [
			'where' => $where
		])->execute();
		return $result;
	}
}