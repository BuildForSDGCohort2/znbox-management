<?php 

require __DIR__."/../../autoload.php";

use controller\User;
use controller\UserType;
use controller\Enterprise;
use controller\Translator;
use controller\Resources;
use controller\Helper;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("Session Expired"),
		"status" => "danger",
	]));
}

$allowed = array("png", "jpg", "gif");
	
$extension = pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);

if(!in_array(strtolower($extension), $allowed)){
	die(json_encode([
		"code" => "1106",
		"title" => Translator::translate("Image format not allowed"),
		"message" => Translator::translate("Image format not allowed"),
		"status" => "danger",
	]));
}

$enterprise = Enterprise::getBy("id", 1);

if(isset($_FILES["logo"]) && $_FILES["logo"]["name"]) {
	if($file = Resources::upload("enterprise", $_FILES["logo"])) {
		if($enterprise["logo"]) {
			/* Delete the last pirture */
			Resources::deleteFile("enterprise/".$enterprise["logo"]);
		}
		$data = [
			"logo" => $file["name"],
			"user_modify" => $user["id"],
			"date_modify" => date("Y-m-d h:i:s"),
		];
		if(Enterprise::update($enterprise["id"], $data)) {
			die(json_encode([
				"code" => "1102",
				"title" => Translator::translate("Success"),
				"message" => Translator::translate("Updated successfuly"),
				"status" => "success",
				"href" => Helper::url("api/enterprise/enterprise.php"),
			]));
		} else {
			die(json_encode([
				"code" => "1103",
				"title" => Translator::translate("Internal server error"),
				"message" => Translator::translate("Internal server error"),
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
}