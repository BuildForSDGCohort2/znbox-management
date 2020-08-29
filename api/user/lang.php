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

if(isset($_POST["lang"])) {
	if($_POST["lang"] == "pt") {
		setcookie("lang", "pt", time() + 3600 * (24 * 365), "/", "", false, false);
		die("reload");
	}
	if($_POST["lang"] == "eng") {
		setcookie("lang", "eng", time() + 3600 * (24 * 365), "/", "", false, false);
		die("reload");
	}
} else {
	die(json_encode([
		"code" => "1103",
		"title" => Translator::translate("Server error"),
		"message" => Translator::translate("Error do servidor"),
		"status" => "danger",
	]));
}