<?php 

require __DIR__."/../../autoload.php";

use controller\User;
use controller\UserType;
use controller\Translator;
use controller\Helper;
use controller\Resources;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("Session Expired"),
		"status" => "danger",
	]));
}

$allowed = array("png", "jpg", "gif");
	
$extension = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);

if(!in_array(strtolower($extension), $allowed)) {
	die(json_encode([
		"code" => "1106",
		"title" => Translator::translate("Image format not allowed"),
		"message" => Translator::translate("Error do servidor"),
		"status" => "danger",
	]));
}

if(isset($_FILES["picture"]) && $_FILES["picture"]["name"]) {
	if($file = Resources::upload("uploads", $_FILES["picture"])) {
		if($user["picture"] && ($user["picture"] != "user.png" && $user["picture"] != "user.jpg")) {
			/* Delete the last pirture */
			Resources::deleteFile("uploads/".$user["picture"]);
		}
		if(User::update($user["id"], ["picture" => $file["name"]])) {
			die(json_encode([
				"code" => "1102",
				"title" => Translator::translate("Success"),
				"message" => Translator::translate("Updated successfuly"),
				"status" => "success",
				"href" => Helper::url("api/user/profile.php"),
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