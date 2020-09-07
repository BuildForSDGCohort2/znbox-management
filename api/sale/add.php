<?php 

require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\Sale;
use controller\SaleStock;
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
	!isset($_POST["discount"]) ||
	!isset($_POST["customer"]) ||
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
$data["discount"] = $_POST["discount"];
$data["customer"] = $_POST["customer"];
$data["discount_type"] = 1;
$data["tax_percentage"] = 17;
$data["observation"] = "";

$conn = Database::conn();
$conn->beginTransaction();

if($sale = Sale::add($data)) {
	$stock = $_POST["stock"];
	$quantity = $_POST["quantity"];
	try {
		$id = $conn->lastInsertId();
		foreach ($stock as $key => $value) {
			SaleStock::add([
				"sale" => $id,
				"stock" => $value,
				"quantity" => $quantity[$key],
				"price_sale" => Price::getDefault($value)["price_sell"],
				"price_purchase" => Price::getDefault($value)["price_purchase"],
			]);
		}
		$conn->commit();
		die(json_encode([
			"code" => "1102",
			"title" => Translator::translate("Success"),
			"message" => Translator::translate("Added successfuly"),
			"status" => "success",
			"href" => Helper::url("api/sale/sale.php"),
		]));
	} catch(Exception $ex) {
		$conn->rollback();
		die(json_encode([
			"code" => "1103",
			"title" => Translator::translate("Server error"),
			"message" => Translator::translate("Error do servidor"),
			"status" => "danger",
		]));
	}
} else {
	die(json_encode([
		"code" => "1103",
		"title" => Translator::translate("Server error"),
		"message" => Translator::translate("Error do servidor"),
		"status" => "danger",
	]));
}
