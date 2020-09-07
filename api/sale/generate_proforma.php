<?php 

require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\Sale;
use controller\Stock;
use controller\SaleStock;
use controller\Enterprise;
use controller\Customer;
use controller\Proforma;
use controller\Price;
use controller\Helper;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("Session Expired"),
		"status" => "danger",
	]));
}
if(!isset($_POST["value"]["sale"])) {
    die("404_request");
}
if(!$sale = Sale::getBy("id", $_POST["value"]["sale"])) {
	die("404_request");
}

$data = [];
$data["user_added"] = $user["id"];
$data["user_modify"] = $user["id"];
$data["date_emitted"] = $_POST["value"]["date_emitted"];
$data["date_due"] = $_POST["value"]["date_due"];
$data["sale"] = $sale["id"];
$data["status"] = 1;
$data["enterprise"] = json_encode(Enterprise::getBy("id", 1));
$data["customer"] = json_encode(Customer::getBy("id", $sale["customer"]));

$data["itens"] = [];
foreach (SaleStock::getAllBy("sale", $sale["id"]) as $key => $item) {
	$data["itens"][$key] = $item;
}
foreach (SaleStock::getAllBy("sale", $sale["id"]) as $key => $item) {
	$data["itens"][$key]["stock"] = Stock::getBy("id", $item["stock"]);
}
$data["itens"] = json_encode($data["itens"]);

$number = (Proforma::getLast()) ? Proforma::getLast()["number"] + 1 : 1;
$data["number"] = $number;

if(Proforma::add($data)) {
	die(json_encode([
		"code" => "1102",
		"title" => Translator::translate("Success"),
		"message" => Translator::translate("Added successfuly"),
		"status" => "success",
		"href" => Helper::url("api/sale/sale.php"),
	]));
} else {
	die(json_encode([
		"code" => "1103",
		"title" => Translator::translate("Server error"),
		"message" => Translator::translate("Error do servidor"),
		"status" => "danger",
	]));
}