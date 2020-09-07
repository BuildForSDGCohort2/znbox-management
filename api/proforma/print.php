<?php

require __DIR__."/../../autoload.php";

use controller\Proforma;
use controller\Sale;
use controller\SaleStock;
use controller\User;
use controller\Enterprise;
use controller\report\Report;
use controller\Helper;

header("Content-type: application/pdf");
//header("Content-Transfer-Encoding: Binary");
//header("Content-disposition: attachment; filename=".time()."_invoice.pdf");

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
    die("user_session");
}
if(!isset($_GET["id"])) {
    die("404_request");
}
if(!isset($_GET["type"])) {
    die("404_request");
}
if(!$sale = (object) Sale::getBy("id", $_GET["id"])) {
    die("404_request");
}
if(!$proforma = (object) Proforma::getBy("sale", $sale->id)) {
    die("404_request");
}
if($_GET["type"] != 1) {
    die("404_request");
}

$enterprise = json_decode($proforma->enterprise);
$customer = json_decode($proforma->customer);

$itens = json_decode($proforma->itens);

$subtotal = 0;
$invoice_itens = [];
foreach($itens as $item) {
	$invoice_itens[] = [
		"description" => $item->stock->name,
		"quantity" => $item->quantity,
		"price" => $item->price_sale,
		"total" => $item->quantity * $item->price_sale,
	];
	$subtotal += ($item->price_sale * $item->quantity);
}

$discount = ($sale->discount_type == 1) ? ($subtotal * ($sale->discount / 100)) : $sale->discount;


$config = [
	"enterprise" => [
		"name" => $enterprise->name,
		"address" => $enterprise->address,
		"phone" => $enterprise->phone1,
		"mobile" => $enterprise->phone2,
		"email" => $enterprise->email,
		"nuit" => $enterprise->nuit,
		"currency" => $enterprise->currency,
		"logo" => $enterprise->logo,
	],
	"document" => [
		"number" => $proforma->number."/".date("Y", strtotime($proforma->date_emitted)),
		"date" => $proforma->date_emitted,
		"date_due" => $proforma->date_due,
		"itens" => $invoice_itens,
		"total" => [
			"subtotal" => Helper::formatNumber($subtotal),
			"discount" => Helper::formatNumber($discount),
			"subtotal_discount" => Helper::formatNumber($subtotal - $discount),
			"tax_percentage" => $sale->tax_percentage."%",
			"tax" => Helper::formatNumber(($subtotal - $discount) * ($sale->tax_percentage / 100)),
			"total" => Helper::formatNumber(($subtotal - $discount) + ($subtotal - $discount) * ($sale->tax_percentage / 100)),
		]
	],
	"customer" => [
		"name" => $customer->name,
		"phone" => $customer->contact1,
		"email" => $customer->email,
		"address" => $customer->address,
		"postal_code" => (isset($customer->postal_code) ? $customer->postal_code : ""),
	],
];

$report = new Report();
echo $report->proforma($config)->toString();