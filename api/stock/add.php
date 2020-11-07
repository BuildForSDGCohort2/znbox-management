<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\_StockSupplier;
use controller\Stock;
use controller\StockTransfer;
use controller\StockTransferItem;
use controller\Price;
use controller\Helper;
use connections\Database;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("Session Expired"),
		"status" => "danger",
	]));
}

if(
	!isset($_POST["value"])
) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("Invalid request"),
		"status" => "danger",
	]));
}

$data = $_POST["value"];

$data["user_added"] = $user["id"];
$data["user_modify"] = $user["id"];

$price_sell = $data["price_sell"];

unset($data["price_sell"]);
unset($data["price_purchase"]);

$conn = Database::conn();
$conn->beginTransaction();

$data_stock = [
	"name" => $data["name"],
	"category" => $data["category"],
	"type" => $data["type"],
	"description" => $data["description"],
	"user_added" => $user["id"],
	"user_modify" => $user["id"],
];

if($result = Stock::add($data_stock)) {
	try {
		$id = $conn->lastInsertId();
		if(isset($data["supplier"])) {
			foreach ($data["supplier"] as $item) {
				_StockSupplier::add([
					"supplier" => $item,
					"stock" => $id
				]);
			}
		}
		Price::add([
			"isDefault" => true,
			"price_sell" => $price_sell,
			"stock" => $id,
			"user_added" => $user["id"],
			"user_modify" => $user["id"],
		]);

		StockTransfer::add([
			"stock_register" => true,
			"warehouse_from" => $data["warehouse"],
			"warehouse_to" => $data["warehouse"],
			"user_added" => $user["id"],
			"user_modify" => $user["id"],
		]);
		$stock_transfer_id = $conn->lastInsertId();
		StockTransferItem::add([
			"stock_transfer" => $stock_transfer_id,
			"stock" => $id,
			"quantity" => $data["quantity"],
		]);

		$conn->commit();
		die(json_encode([
			"code" => "1102",
			"title" => Translator::translate("Success"),
			"message" => Translator::translate("Added successfuly"),
			"status" => "success",
			"href" => Helper::url("api/stock/stock.php"),
		]));
	} catch(\Exception $ex) {
		$conn->rollback();
		die(json_encode([
			"status" => "error",
			"message" => Translator::translate("Server error"),
		]));
	}
} else {
	$conn->rollback();
	die(json_encode([
		"code" => "1103",
		"title" => Translator::translate("Server error"),
		"message" => Translator::translate("Server error"),
		"status" => "danger",
	]));
}