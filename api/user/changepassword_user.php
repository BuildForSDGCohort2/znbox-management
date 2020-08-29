<?php 

require __DIR__."/../../autoload.php";

use controller\User;
use controller\UserType;
use controller\Translator;
use controller\Helper;

if(
	!isset($_POST["newpassword"]) ||
	!isset($_POST["confirmnew"]) ||
	!isset($_POST["password"])
) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("Invalid request"),
		"status" => "danger",
	]));
}

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("Session Expired"),
		"status" => "danger",
	]));
}

if($_POST["newpassword"] != $_POST["confirmnew"]) {
	die(json_encode([
		"code" => "1201",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("different passwords"),
		"status" => "danger",
	]));
}

if(password_verify($_POST["password"], $user["password"])) {
	if($user["status"] == 1) {

		$password = password_hash($_POST["newpassword"], PASSWORD_DEFAULT);

		if(User::update($_POST["id"], ["password" => $password])) {
			die(json_encode([
				"code" => "1202",
				"title" => Translator::translate("Success"),
				"message" => Translator::translate("Updated successfuly"),
				"status" => "success",
				"href" => Helper::url("api/user/profile.php"),
			]));
		} else {
			die(json_encode([
				"code" => "1203",
				"title" => Translator::translate("Server error"),
				"message" => Translator::translate("Error do servidor"),
				"status" => "danger",
			]));
		}
	} else {
		die(json_encode([
			"code" => "1003",
			"title" => Translator::translate("Authentication error"),
			"message" => Translator::translate("This account is disactivated! please contact system administrator"),
			"status" => "danger"
		]));
	}
} else {
	die(json_encode([
		"code" => "1004",
		"title" => Translator::translate("Authentication error"),
		"message" => Translator::translate("Password incorrect"),
		"status" => "danger"
	]));
}