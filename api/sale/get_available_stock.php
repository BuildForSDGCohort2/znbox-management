<?php 

require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\UserType;
use controller\Stock;
use controller\Price;
use controller\Warehouse;
use controller\Helper;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die("user_session");
}

if(!isset($_POST["warehouse"])) { die("404_request"); }
if(!$warehouse = Warehouse::getBy("id", $_POST["warehouse"])) {
    die("404_request");   
}

if(!isset($_POST["stock"])) { die("404_request"); }
if(!$stock = Stock::getBy("id", $_POST["stock"])) {
    die("404_request");
}

$value = Stock::getStockAmountByWarehouse($stock["id"], $warehouse["id"]);
die(json_encode([
	"value" => ($value ? $value : 0),
]));