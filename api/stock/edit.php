<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\Supplier;
use controller\_StockSupplier;
use controller\Warehouse;
use controller\Stock;
use controller\StockCategory;
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
	!isset($_POST["value"]) ||
	!isset($_POST["id"])
) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("Invalid request"),
		"status" => "danger",
	]));
}
if(!$stock = Stock::getBy("id", $_POST["id"])) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("Session Expired"),
		"status" => "danger",
	]));
}

$data = $_POST["value"];
$data["user_modify"] = $user["id"];

$suppliers = (isset($_POST["supplier"]) ? $_POST["supplier"] : []);

/* Update deleted state */
if(isset($data["isDeleted"])) {
	if(Stock::update($_POST["id"], $data)) {
		die(json_encode([
			"code" => "1102",
			"title" => Translator::translate("Success"),
			"message" => Translator::translate("Updated successfuly"),
			"status" => "success",
			"href" => Helper::url("api/stock/stock.php"),
		]));
	} else {
		die(json_encode([
			"code" => "1103",
			"title" => Translator::translate("Server error"),
			"message" => Translator::translate("Error do servidor"),
			"status" => "danger",
		]));
	}
}
$conn = Database::conn();
$conn->beginTransaction();
if(Stock::update($_POST["id"], $data)) {
	try {
		/* Delete all supplier itens from current stock */
		_StockSupplier::delete("stock", $_POST["id"]);
		foreach($suppliers as $item) {
			_StockSupplier::add([
				"supplier" => $item,
				"stock" => $_POST["id"],
			]);
		}
	} catch(\Exception $ex) {
		$conn->rollback();
		die(json_encode([
			"code" => "1103",
			"title" => Translator::translate("Server error"),
			"message" => Translator::translate("Server error"),
			"status" => "danger",
		]));
	}
	$conn->commit();
	die(json_encode([
		"code" => "1102",
		"title" => Translator::translate("Success"),
		"message" => Translator::translate("Updated successfuly"),
		"status" => "success",
		"href" => Helper::url("api/stock/stock.php"),
	]));
} else {
	$conn->rollback();
	die(json_encode([
		"code" => "1103",
		"title" => Translator::translate("Server error"),
		"message" => Translator::translate("Server error"),
		"status" => "danger",
	]));
}

