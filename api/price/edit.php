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
if(!isset($_POST["id"]) and !isset($_GET["id"])) {
	die("404_request");
}
$id = (isset($_POST["id"])) ? $_POST["id"] : $_GET["id"];

if(!$price = Price::getBy("id", $id)) {
	die("404_request");   
}
if(!$stock = Stock::getBy("id", $price["stock"])) {
	die("404_request");   
}

$data = $_POST["value"];

/* Changing is default price status */
if(isset($_POST["status"])) {

	$data["user_modify"] = $user["id"];
	$data["stock"] = $stock["id"];
	$data["isDefault"] = 1;
	
	/* Removing all defaults from current Stock */
	foreach(Price::getAllBy("stock", $stock["id"]) as $item) {
		Price::update($item["id"], ["isDefault" => 0]);
	}
}

/* Removing price */
if(isset($data["isDeleted"])) {
	if($price["isDefault"]) {
		die(json_encode([
			"code" => "1102",
			"title" => Translator::translate("Error"),
			"message" => Translator::translate("You cannot delete the default price"),
			"status" => "danger",
		]));
	}
}
if(Price::update($price["id"], $data)) {
	die(json_encode([
		"code" => "1102",
		"title" => Translator::translate("Success"),
		"message" => Translator::translate("Updated successfuly"),
		"data" => "id=".$stock["id"],
		"href" => Helper::url("api/price/price.php"),
		"status" => "success",
	]));
} else {
	die(json_encode([
		"code" => "1103",
		"title" => Translator::translate("Server error"),
		"message" => Translator::translate("Error do servidor"),
		"status" => "danger",
	]));
}