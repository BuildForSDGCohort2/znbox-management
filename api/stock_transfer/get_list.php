<?php

require __DIR__."/../../autoload.php";

use emagombe\DataTable;
use controller\StockTransfer;
use controller\Stock;
use controller\Warehouse;
use controller\Helper;
use controller\Translator;
use controller\User;


$table = DataTable::create(StockTransfer::getAll()->fetchAll());

$table->addColumn("user_added", function($row) {
	$user = User::getBy("id", $row["user_added"]);
	return $user["first"]." ".$user["last"];
});
$table->addColumn("user_modify", function($row) {
	$user = User::getBy("id", $row["user_modify"]);
	return $user["first"]." ".$user["last"];
});
$table->addColumn("stock_register", function($row) {
	return ($row["stock_register"] ? Translator::translate("Yes") : Translator::translate("No"));
});
$table->addColumn("from", function($row) {
	$warehouse = Warehouse::getBy("id", $row["warehouse_from"]);
	return $warehouse["name"];
});
$table->addColumn("to", function($row) {
	$warehouse = Warehouse::getBy("id", $row["warehouse_to"]);
	return $warehouse["name"];
});
$table->addColumn("actions", function($row) {
	$content = "";
	return $content;
});
$table->stream();