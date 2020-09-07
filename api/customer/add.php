<?php 

require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\Customer;
use controller\Helper;

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
$data["user_modify"] = $user["id"];
$data["user_added"] = $user["id"];

if(Customer::getBy("name", $data["name"])) {
	die(json_encode([
		"code" => "1103",
		"title" => Translator::translate("Item already exists"),
		"message" => Translator::translate("Item with inserted name already exists"),
		"status" => "danger",
	]));
}
if(Customer::add($data)) {
	die(json_encode([
		"code" => "1102",
		"title" => Translator::translate("Success"),
		"message" => Translator::translate("Added successfuly"),
		"status" => "success",
		"href" => Helper::url("api/customer/customer.php"),
	]));
} else {
	die(json_encode([
		"code" => "1103",
		"title" => Translator::translate("Server error"),
		"message" => Translator::translate("Server error"),
		"status" => "danger",
	]));
}

