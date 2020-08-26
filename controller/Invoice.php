<?php 

namespace controller;

use queryBuilder\JsonQB as JQB;
use stdClass;

class Invoice {

	public static function add($request) {
		$result = JQB::Insert('invoice', $request)->execute();
		return $result;
	}

	public static function getBy($column, $value) {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['invoice'],
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
			'from' => ['invoice'],
		])->execute();
		return $result;
	}

	public static function update($id, $values) {
		$result = JQB::Update('invoice', [
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
			'from' => ['invoice'],
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
		$invoice = self::getBy("id", $id)->first;
		$sale = Sale::getBy('id', $invoice->sale)->first;

		$itens = json_decode($invoice->itens);
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