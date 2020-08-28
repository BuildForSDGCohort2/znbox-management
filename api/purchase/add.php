<?php 

require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\UserType;
use controller\Purchase;
use controller\Resources;
use controller\Supplier;
use controller\Helper;
use controller\PurchaseItem;
use queryBuilder\JsonQB as JQB;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])->first) {
	echo json_encode([
		"code" => "5000",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("Session Expired"),
		"status" => "danger",
	]); die();
}

if(
	!isset($_POST["description"]) ||
	!isset($_POST["purchase_date"]) ||
	!isset($_POST["stock"]) ||
	!isset($_POST["price_unity"]) ||
	!isset($_POST["quantity"])
) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Invalid request"),
		"message" => Translator::translate("Invalid request"),
		"status" => "danger",
	]));
}

/* Purchase info */
$data = [];
$data["value"]["description"] = $_POST["description"];
$data["value"]["purchase_date"] = $_POST["purchase_date"];
$data["value"]["user_modify"] = $user->id;

if(isset($_FILES["file"]) && $_FILES["file"]["name"]) {
	if($file = Resources::upload("docs", $_FILES["file"])) {
		$data["value"]["file"] = $file["name"];
	} else {
		die(json_encode([
			"code" => "5000",
			"title" => Translator::translate("Invalid request"),
			"message" => Translator::translate("Invalid request"),
			"status" => "danger",
		]));
	}
}

/* Purchase itens */
$itens = [];
$itens["stock"] = $_POST["stock"];
$itens["quantity"] = $_POST["quantity"];
$itens["price_unity"] = $_POST["price_unity"];

JQB::begin();
if($insert = Purchase::add($data)) {
	foreach($itens["stock"] as $key => $value) {
		PurchaseItem::add([
			"value" => [
				"purchase" => $insert->id,
				"stock" => $value,
				"price_unity" => $itens["price_unity"][$key],
				"quantity" => $itens["quantity"][$key],
			]
		]);
	}
	JQB::commit();
	die(json_encode([
		"code" => "1102",
		"title" => Translator::translate("Success"),
		"message" => Translator::translate("Added successfuly"),
		"status" => "success",
		"href" => "purchase/purchase",
	]));
} else {
	JQB::rollback();
	die(json_encode([
		"code" => "1103",
		"title" => Translator::translate("Server error"),
		"message" => Translator::translate("Error do servidor"),
		"status" => "danger",
	]));
}