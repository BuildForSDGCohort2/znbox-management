<?php 

namespace controller;

use queryBuilder\JsonQB as JQB;
use stdClass;
use controller\Helper;
use controller\Sale;

class Proforma {

	public static function add($request) {
		$result = JQB::Insert('proforma', $request)->execute();
		return $result;
	}

	public static function getBy($column, $value) {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['proforma'],
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
			'from' => ['proforma'],
		])->execute();
		return $result;
	}

	public static function update($id, $values) {
		$result = JQB::Update('proforma', [
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
			'from' => ['proforma'],
			'where' => [
				[
					"columns" => [
						"stock" => $stock,
						"isDeleted" => 0,
					]
				]
			]
		])->execute();
		return $result;
	}
	public static function getTotal($id) {
		$proforma = self::getBy("id", $id)->first;
		$sale = Sale::getBy('id', $proforma->sale)->first;

		$itens = json_decode($proforma->itens);
		$subtotal = 0;
		$invoice_itens = [];
		foreach($itens as $item) {
			$invoice_itens[] = [
				"description" => $item->stock->name,
				"quantity" => $item->quantity,
				"price" => $item->price_sale,
				"total" => $item->quantity * $item->price_sale,
			];
			$subtotal += (floatval($item->price_sale) * intval($item->quantity));
		}

		$discount = ($sale->discount_type == 1) ? ($subtotal * ($sale->discount / 100)) : $sale->discount;
		return ($subtotal - $discount) + ($subtotal - $discount) * ($sale->tax_percentage / 100);
	}
}