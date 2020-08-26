<?php 

namespace controller;

use queryBuilder\JsonQB as JQB;
use stdClass;

class PurchaseItem {

	public static function add($request) {
		$result = JQB::Insert('purchase_item', $request)->execute();
		return $result;
	}

	public static function getBy($column, $value) {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['purchase_item'],
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
			'from' => ['purchase_item']
		])->execute();
		return $result;
	}

	public static function delete($where) {
		$result = JQB::Delete('purchase_item', [
			'where' => $where
		])->execute();
		return $result;
	}
	public static function deleteByPurchase($purchase) {
		$result = JQB::Delete('purchase_item', [
			'where' => [
				[
					"columns" => [
						"purchase" => $purchase,
					]
				]
			]
		])->execute();
		return $result;
	}
}