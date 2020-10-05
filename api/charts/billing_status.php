<?php

require __DIR__."/../../autoload.php";

use controller\Invoice;
use controller\Receipt;
use controller\Sale;
use controller\Proforma;
use controller\QueryBuilder;
use controller\Translator;

$unpaid_invoices = Invoice::getAll()->rowCount() - Receipt::getAll()->rowCount();
$paid_invoices = Receipt::getAll()->rowCount();


$date_now = date("Y-m-d");
$overdue_invoices = QueryBuilder::exec("SELECT * FROM invoice WHERE DATE(invoice.date_due) < DATE('$date_now')")->rowCount();

header("Content-type: application/json");
die(json_encode([
	"labels" => [
		Translator::translate("Unpaid invoices"),
		Translator::translate("Paid invoices"),
		Translator::translate("Overdue invoices"),
	],
	"data" => [
		$unpaid_invoices,
		$paid_invoices,
		$overdue_invoices,
	],
	"color" => [
		"#ffce56",
		"#36a2eb",
		"#ff6384",
	]
]));