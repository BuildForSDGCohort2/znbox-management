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
	(!isset($_POST["id"]) ||
	!isset($_POST["discount"]) ||
	!isset($_POST["customer"]) ||
	!isset($_POST["quantity"]) ||
	!isset($_POST["discount_type"]) ||
	!isset($_POST["tax_percentage"]) ||
	!isset($_POST["stock"])) && !isset($_POST["value"]["isDeleted"]) ||
	!isset($_POST["warehouse"])
) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("Invalid request"),
		"status" => "danger",
	]));
}

if(!$sale = Sale::getBy("id", $_POST["id"])) {
    die("404_request");   
}

$data = [];
if(!isset($_POST["value"]["isDeleted"])) {
	$data["discount"] = $_POST["discount"];
	$data["customer"] = $_POST["customer"];
	$data["discount_type"] = $_POST["discount_type"];
	$data["tax_percentage"] = $_POST["tax_percentage"];
	$data["observation"] = "";
} else {
	$data["isDeleted"] = $_POST["value"]["isDeleted"];
}
$data["user_modify"] = $user["id"];
$data["user_added"] = $user["id"];

$conn = Database::conn();
$conn->beginTransaction();

if(Sale::update($sale["id"], $data)) {
	if(!isset($data["isDeleted"])) {
		/* Delete all stock itens from this sale */
		SaleStock::deleteBySale($sale["id"]);
		$stock = $_POST["stock"];
		$quantity = $_POST["quantity"];
		try {
			/* Add currently selected sales */
			foreach ($stock as $key => $value) {
				SaleStock::add([
					"sale" => $sale["id"],
					"stock" => $value,
					"quantity" => $quantity[$key],
					"price_sale" => Price::getDefault($value)["price_sell"],
					"price_purchase" => Price::getDefault($value)["price_purchase"],
					"warehouse" => $_POST["warehouse"][$key],
				]);
			}
			$conn->commit();
			die(json_encode([
				"code" => "1102",
				"title" => Translator::translate("Success"),
				"message" => Translator::translate("Updated successfuly"),
				"status" => "success",
				"href" => Helper::url("api/sale/sale.php"),
			]));
		} catch(Exception $ex) {
			$conn->rollback();
			die(json_encode([
				"code" => "1103",
				"title" => Translator::translate("Server error"),
				"message" => Translator::translate("Server error"),
				"status" => "danger",
			]));
		}
	} else {
		$conn->commit();
		die(json_encode([
			"code" => "1102",
			"title" => Translator::translate("Success"),
			"message" => Translator::translate("Updated successfuly"),
			"status" => "success",
			"href" => Helper::url("api/sale/sale.php"),
		]));
	}
} else {
	die(json_encode([
		"code" => "1103",
		"title" => Translator::translate("Server error"),
		"message" => Translator::translate("Server error"),
		"status" => "danger",
	]));
}
