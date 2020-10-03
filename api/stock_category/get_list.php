<?php

require __DIR__."/../../autoload.php";

use emagombe\DataTable;
use controller\StockCategory;
use controller\Stock;
use controller\Helper;
use controller\Translator;
use controller\User;


$table = DataTable::create(StockCategory::getAll()->fetchAll());

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
	<a class="ui mini circular icon button violet zn-link-dialog" href="'.Helper::url("api/stock_category/view.php?id=".$row["id"]).'" data="'.$row["id"].'" data-tooltip="'.Translator::translate("view details").'">
		<i class="ui eye icon"></i>
	</a>
	<a class="ui mini circular icon button green zn-link-dialog" href="'.Helper::url("api/stock_category/edit_form.php?id=".$row["id"]).'" data="'.$row["id"].'" data-tooltip="'.Translator::translate("edit details").'">
		<i class="ui edit icon"></i>
	</a>';
	if(!Stock::getBy("category", $row["id"])) {
		$content .= '
		<a class="ui mini circular icon button red zn-link-dialog" href="'.Helper::url("api/stock_category/delete_form.php?id=".$row["id"]).'" data="'.$row["id"].'" data-tooltip="'.Translator::translate("delete").'">
			<i class="ui trash alternate icon"></i>
		</a>';
	}
	return $content;
});
$table->stream();