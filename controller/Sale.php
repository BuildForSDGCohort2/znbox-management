<?php 

namespace controller;

use controller\SaleStock;
use queryBuilder\JsonQB as JQB;
use stdClass;

class Sale {

	public static function add($request) {
		$result = JQB::Insert('sale', $request)->execute();
		return $result;
	}

	public static function getBy($column, $value) {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['sale'],
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
			'from' => ['sale'],
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
		$result = JQB::Update('sale', [
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

	public static function getTotal($id, $vat = false) {
		$total = 0;
		$sale = self::getBy('id', $id)->first;
		foreach(SaleStock::getBy('sale', $id)->data as $item) {
			$total += ($sale->discount_type == 1) ? ($item['price_sale'] * $item['quantity']) - ($item['price_sale'] * $item['quantity']) * ($sale->discount / 100) : ($item['price_sale'] * $item['quantity']) - $sale->discount;
		}
		if($vat) {
			$total += ($total * ($sale->tax_percentage / 100));
		}
		return $total;
	}

	public static function getTotalDiscount($id) {
		$total = 0;
		$sale = self::getBy('id', $id)->first;
		foreach(SaleStock::getBy('sale', $id)->data as $item) {
			$total += ($sale->discount_type == 1) ? ($item['price_sale'] * $item['quantity']) * ($sale->discount / 100) : $sale->discount;
		}
		return $total;
	}
}