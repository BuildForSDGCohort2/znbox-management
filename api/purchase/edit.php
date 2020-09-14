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
use connections\Database;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Error"),
		"message" => Translator::translate("Session Expired"),
		"status" => "danger",
	]));
}

if(isset($_POST["id"]) && !$purchase = Purchase::getBy("id", $_POST["id"])) {
    die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Invalid request"),
		"message" => Translator::translate("Invalid request"),
		"status" => "danger",
	]));
}

if(isset($_POST["isDeleted"])) {
	Purchase::update($purchase["id"], [
		"isDeleted" => 1,
	]);
	die(json_encode([
		"code" => "1102",
		"title" => Translator::translate("Success"),
		"message" => Translator::translate("Updated successfuly"),
		"status" => "success",
		"href" => Helper::url("api/purchase/purchase.php"),
	]));
}

/* Submit purchase itens to stock */
if(isset($_POST["isStock"])) {
	Purchase::update($purchase["id"], [
		"isStock" => 1,
	]);
	die(json_encode([
		"code" => "1102",
		"title" => Translator::translate("Success"),
		"message" => Translator::translate("Updated successfuly"),
		"status" => "success",
		"href" => Helper::url("api/purchase/purchase.php"),
	]));
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

if(!isset($_POST["id"])) {
	die(json_encode([
		"code" => "5000",
		"title" => Translator::translate("Invalid request"),
		"message" => Translator::translate("Invalid request"),
		"status" => "danger",
	]));
}

/* Purchase info */
$data = [];
$data["description"] = $_POST["description"];
$data["purchase_date"] = $_POST["purchase_date"];
$data["user_modify"] = $user["id"];

if(isset($_FILES["file"]) && $_FILES["file"]["name"]) {
	if($purchase["file"]) {
		Resources::deleteFile("docs/".$purchase["file"]);
	}
	if($file = Resources::upload("docs", $_FILES["file"])) {
		$data["file"] = $file["name"];
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

$conn = Database::conn();
$conn->beginTransaction();
if($update = Purchase::update($purchase["id"], $data)) {
	/* Delete all purchase itens */
	PurchaseItem::deleteByPurchase($purchase["id"]);

	/* Adding selected purchase itens */
	foreach($itens["stock"] as $key => $value) {
		PurchaseItem::add([
			"purchase" => $purchase["id"],
			"stock" => $value,
			"price_unity" => $itens["price_unity"][$key],
			"quantity" => $itens["quantity"][$key],
		]);
	}
	$conn->commit();
	die(json_encode([
		"code" => "1102",
		"title" => Translator::translate("Success"),
		"message" => Translator::translate("Updated successfuly"),
		"status" => "success",
		"href" => Helper::url("api/purchase/purchase.php"),
	]));
} else {
	$conn->rollback();
	die(json_encode([
		"code" => "1103",
		"title" => Translator::translate("Server error"),
		"message" => Translator::translate("Error do servidor"),
		"status" => "danger",
	]));
}

