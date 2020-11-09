<?php 

namespace controller;

use controller\Purchase;
use controller\SaleStock;
use controller\StockTransfer;
use controller\StockTransferItem;
use connections\Database;
use controller\QueryBuilder;
use stdClass;

class Stock {

	public static function add($data) {
		$conn = Database::conn();
		$sql = QueryBuilder::insert("stock", $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}

	public static function getBy($column, $value) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM stock WHERE stock.$column = $value;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getAll() {
		$conn = Database::conn();
		$sql = "SELECT * FROM stock WHERE stock.isDeleted = 0;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}

	public static function where($where) {
		$conn = Database::conn();
		$sql = "SELECT * FROM stock WHERE";
		foreach($where as $key => $value) {
			$key = rtrim(ltrim($conn->quote($value[0]), "'"), "'");
			$operator = rtrim(ltrim($conn->quote($value[1]), "'"), "'");
			$value = $conn->quote($value[2]);
			$sql .= " stock.$key $operator $value AND";
		}
		$sql = rtrim($sql, " AND").";";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function update($id, $data) {
		$conn = Database::conn();
		$sql = QueryBuilder::update("stock", "id", $id, $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function getStockAmount($id) {
		$purchase_total = Purchase::getTotalAmount($id);
		$sale_total = SaleStock::getTotalAmount($id);
		$stock_transfer = StockTransfer::initialStock($id);
		
		$total = $stock_transfer["total"] + $purchase_total["total"] - $sale_total["total"];
		return $total;
	}
	public static function getStockAmountByWarehouse($id, $warehouse) {
		$purchase_total = Purchase::getTotalAmountByWarehouse($id, $warehouse)["total"];
		$sale_total = SaleStock::getTotalAmount($id);
		$from = self::getTotalStockByWarehouseFrom($id, $warehouse)["total"];
		$to = self::getTotalStockByWarehouseTo($id, $warehouse)["total"];
		$stock_register = self::getTotalStockRegisterByWarehouse($id, $warehouse)["total"];
		
		$total = ($to - $from + $stock_register) + $purchase_total;
		return $total;
	}
	public static function getTotalStockByWarehouseTo($stock, $warehouse) {
		$conn = Database::conn();
		$stock = $conn->quote($stock);
		$warehouse = $conn->quote($warehouse);
		$sql = "SELECT SUM(stock_transfer_item.quantity) AS total FROM stock_transfer_item INNER JOIN stock_transfer ON stock_transfer.id = stock_transfer_item.stock_transfer WHERE stock_transfer.warehouse_to = $warehouse AND stock_transfer_item.stock = $stock AND stock_transfer.stock_register = 0;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getTotalStockByWarehouseFrom($stock, $warehouse) {
		$conn = Database::conn();
		$stock = $conn->quote($stock);
		$warehouse = $conn->quote($warehouse);
		$sql = "SELECT SUM(stock_transfer_item.quantity) AS total FROM stock_transfer_item INNER JOIN stock_transfer ON stock_transfer.id = stock_transfer_item.stock_transfer WHERE stock_transfer.warehouse_from = $warehouse AND stock_transfer.warehouse_to != $warehouse AND stock_transfer_item.stock = $stock AND stock_transfer.stock_register = 0;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getTotalStockRegisterByWarehouse($stock, $warehouse) {
		$conn = Database::conn();
		$stock = $conn->quote($stock);
		$warehouse = $conn->quote($warehouse);
		$sql = "SELECT SUM(stock_transfer_item.quantity) AS total FROM stock_transfer_item INNER JOIN stock_transfer ON stock_transfer.id = stock_transfer_item.stock_transfer WHERE stock_transfer_item.stock = $stock AND stock_transfer.stock_register = 1 AND stock_transfer.warehouse_to = $warehouse;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
}