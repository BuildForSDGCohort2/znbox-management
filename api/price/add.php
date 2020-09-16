<?php 

require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\Price;
use controller\Stock;
use controller\Helper;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("Session Expired"),
		"status" => "danger",
	]));
}
if(!isset($_GET["id"])) {
	die("404_request");
}
if(!$stock = Stock::getBy("id", $_GET["id"])) {
	die("404_request");   
}

$data = $_POST["value"];
$data["user_modify"] = $user["id"];
$data["user_added"] = $user["id"];
$data["stock"] = $stock["id"];
$data["isDefault"] = (Price::getBy("stock", $stock["id"])) ? 0 : 1;

if(Price::add($data)) {
	die(json_encode([
		"code" => "1102",
		"title" => Translator::translate("Success"),
		"message" => Translator::translate("Added successfuly"),
		"status" => "success",
		"data" => "id=".$stock["id"],
		"href" => Helper::url("api/price/price.php"),
	]));
} else {
	die(json_encode([
		"code" => "1103",
		"title" => Translator::translate("Server error"),
		"message" => Translator::translate("Error do servidor"),
		"status" => "danger",
	]));
}