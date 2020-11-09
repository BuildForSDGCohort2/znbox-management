<?php 

require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\Helper;
use controller\Warehouse;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("Session Expired"),
		"status" => "danger",
	]));
}

if(
	!isset($_POST["from"])
) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("Invalid request"),
		"status" => "danger",
	]));
}

if(!$warehouse = Warehouse::getBy("id", $_POST["from"])) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("Invalid request"),
		"status" => "danger",
	]));
}

die(json_encode([
	"code" => "1102",
	"href" => Helper::url("api/stock_transfer/add_form.php?warehouse=".$warehouse["id"]),
	"status" => "success",
]));