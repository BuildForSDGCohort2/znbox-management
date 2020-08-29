<?php 

require __DIR__."/../../autoload.php";

use controller\User;
use controller\UserType;
use controller\Translator;
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
	!isset($_POST["first"]) ||
	!isset($_POST["last"]) ||
	!isset($_POST["username"]) ||
	!isset($_POST["email"]) ||
	!isset($_POST["user_type"]) ||
	!isset($_POST["password"]) ||
	!isset($_POST["confirm"])
) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("Invalid request"),
		"status" => "danger",
	]));
}

$password = $_POST["password"];
$confirm = $_POST["confirm"];

if($password != $confirm) {
	die(json_encode([
		"code" => "1101",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("different passwords"),
		"status" => "danger",
	]));
}

$data = [
	"first" => $_POST["first"],
	"last" => $_POST["last"],
	"username" => $_POST["username"],
	"email" => $_POST["email"],
	"user_type" => $_POST["user_type"],
	"password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
];

if(User::add($data)) {
	die(json_encode([
		"code" => "1102",
		"title" => Translator::translate("Success"),
		"message" => Translator::translate("Added successfuly"),
		"status" => "success",
		"href" => Helper::url("api/user/users.php"),
	]));
} else {
	die(json_encode([
		"code" => "1103",
		"title" => Translator::translate("Server error"),
		"message" => Translator::translate("Error do servidor"),
		"status" => "danger",
	]));
}