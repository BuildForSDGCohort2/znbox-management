<?php 

require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
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
	!isset($_POST["to"]) ||
	!isset($_POST["from"]) ||
	!isset($_POST["quantity"]) ||
	!isset($_POST["stock"])
) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("Invalid request"),
		"status" => "danger",
	]));
}

$data = [];
$data["user_modify"] = $user["id"];
$data["user_added"] = $user["id"];
$data["warehouse_to"] = $_POST["to"];
$data["warehouse_from"] = $_POST["from"];
$data["observation"] = "";

$conn = Database::conn();
$conn->beginTransaction();

if($stock_transfer = StockTransfer::add($data)) {
	$stock = $_POST["stock"];
	$quantity = $_POST["quantity"];
	try {
		$id = $conn->lastInsertId();
		foreach ($stock as $key => $value) {
			StockTransferItem::add([
				"stock_transfer" => $id,
				"stock" => $value,
				"quantity" => $quantity[$key],
			]);
		}
		$conn->commit();
		die(json_encode([
			"code" => "1102",
			"title" => Translator::translate("Success"),
			"message" => Translator::translate("Added successfuly"),
			"status" => "success",
			"href" => Helper::url("api/stock_transfer/stock_transfer.php"),
		]));
	} catch(Exception $ex) {
		$conn->rollback();
		die(json_encode([
			"code" => "1103",
			"title" => Translator::translate("Server error"),
			"message" => Translator::translate("Internal server error"),
			"status" => "danger",
		]));
	}
} else {
	die(json_encode([
		"code" => "1103",
		"title" => Translator::translate("Server error"),
		"message" => Translator::translate("Internal server error"),
		"status" => "danger",
	]));
}
