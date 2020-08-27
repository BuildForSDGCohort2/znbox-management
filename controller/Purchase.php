<?php 

namespace controller;

use queryBuilder\JsonQB as JQB;
use controller\PurchaseItem;
use stdClass;

class Purchase {

	public static function add($request) {
		$result = JQB::Insert('purchase', $request)->execute();
		return $result;
	}

	public static function getBy($column, $value) {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['purchase'],
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
			'from' => ['purchase'],
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
		$result = JQB::Update('purchase', [
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
	}
	public static function getTotalPrice($id) {
		$total = 0;
		foreach(PurchaseItem::getBy("purchase", $id)->data as $item) {
			$total += $item["price_unity"];
		}
		return $total;
	}
}