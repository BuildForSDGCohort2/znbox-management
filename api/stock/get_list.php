<?php

require __DIR__."/../../autoload.php";

use emagombe\DataTable;
use controller\StockCategory;
use controller\Stock;
use controller\PurchaseItem;
use controller\SaleStock;
use controller\StockType;
use controller\Helper;
use controller\Translator;
use controller\User;
use controller\Warehouse;
use controller\Price;


$table = DataTable::create(Stock::getAll()->fetchAll());

$table->addColumn("type", function($row) {
	return Translator::translate(StockType::getBy("id", $row["type"])["name"]);
});
$table->addColumn("stock_quantity", function($row) {
	return Stock::getStockAmount($row["id"]);
});
$table->addColumn("warehouse", function($row) {
	return Warehouse::getBy("id", $row["warehouse"])["name"];
});
$table->addColumn("price_sale", function($row) {
	$price = false;
	$content = Translator::translate("No price");
	/* Check if there is a default price */
	foreach(Price::getAllBy("stock", $row["id"]) as $item_price) {
		if($item_price["isDefault"]) {
			$price = $item_price["price_sell"];
			break;
		}
	}
	if($price) {
		$content = '<label class="ui label mini blue">'.$price.'</label>';
	}
	/* Rendering price result */
	return $content;
});
$table->addColumn("prices", function($row) {
	$content = '
		<a class="ui mini circular icon button blue inverted zn-link" href="'.Helper::url("api/price/price.php?id=".$row["id"]).'" data-tooltip="'.Translator::translate("Prices").'">
			'.Translator::translate("Prices").'
		</a>';
		return $content;
});

$table->addColumn("date_added", function($row) {
	return Helper::datetime($row["date_added"]);
});
$table->addColumn("user_added", function($row) {
	$user = User::getBy("id", $row["user_added"]);
	return $user["first"]." ".$user["last"];
});
$table->addColumn("user_modify", function($row) {
	$user = User::getBy("id", $row["user_modify"]);
	return $user["first"]." ".$user["last"];
});
$table->addColumn("actions", function($row) {
	$content = "";
	
	$content .= '
	<a class="ui mini circular icon button violet zn-link-dialog" href="'.Helper::url("api/stock/view.php?id=".$row["id"]).'" data="'.$row["id"].'" data-tooltip="'.Translator::translate("view details").'">
		<i class="ui eye icon"></i>
	</a>
	<a class="ui mini circular icon button green zn-link-dialog" href="'.Helper::url("api/stock/edit_form.php?id=".$row["id"]).'" data="'.$row["id"].'" data-tooltip="'.Translator::translate("edit details").'">
		<i class="ui edit icon"></i>
	</a>';
	if(!SaleStock::getBy("stock", $row["id"]) && !PurchaseItem::getBy("stock", $row["id"])) {
		$content .= '
		<a class="ui mini circular icon button red zn-link-dialog" href="'.Helper::url("api/stock/delete_form.php?id=".$row["id"]).'" data="'.$row["id"].'" data-tooltip="'.Translator::translate("delete").'">
			<i class="ui trash alternate icon"></i>
		</a>';
	}
	return $content;
});
$table->stream();