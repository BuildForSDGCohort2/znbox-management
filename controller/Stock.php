<?php 

namespace controller;

use queryBuilder\JsonQB as JQB;
use controller\Purchase;
use controller\SaleStock;
use stdClass;

class Stock {

	public static function add($request) {
		$result = JQB::Insert('stock', $request)->execute();
		return $result;
	}

	public static function getBy($column, $value) {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['stock'],
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
			'from' => ['stock'],
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
		$result = JQB::Update('stock', [
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

	public static function getStockAmount($id) {
		$purchase_total = Purchase::getTotalAmount($id);
		$sale_total = SaleStock::getTotalAmount($id);
		
		$total = Stock::getBy('id', $id)->first->quantity + $purchase_total->first->total - $sale_total->first->total;
		return $total;
	}
}