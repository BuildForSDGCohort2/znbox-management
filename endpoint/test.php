<?php 

require __DIR__."/../autoload.php";

use controller\report\Report;
use controller\Helper;

header("Content-type: application/pdf");
//header("Content-Transfer-Encoding: Binary");
//header("Content-disposition: attachment; filename=".time()."_test.pdf");

$config = [
	'enterprise' => [
		'name' => 'ZNBOX, lda',
		'address' => 'Mozambique avenue, Zimpeto nº 199',
		'phone' => '+258 214179748',
		'mobile' => '+258 850375093',
		'email' => 'info@znbox.net',
		'nuit' => '451815684',
		'coin' => 'MZN',
	],
	'document' => [
		'number' => '0001/2020',
		'date' => '17/06/2020',
		'date_due' => '24/06/2020',
		'itens' => [
			[
				"description" => "Instalation of software on server",
				"quantity" => "2",
				"price" => Helper::formatNumber(26000)." MZN",
				"total" => Helper::formatNumber(26000 * 2)." MZN",
			],
			[
				"description" => "Instalation of software on server",
				"quantity" => "1",
				"price" => Helper::formatNumber(26000)." MZN",
				"total" => Helper::formatNumber(26000 * 2)." MZN",
			],
		],
		'total' => [
			"subtotal" => Helper::formatNumber(26000 * 4)." MZN",
			"discount" => Helper::formatNumber(0)." MZN",
			"subtotal_discount" => Helper::formatNumber(26000 * 4)." MZN",
			"tax_percentage" => "17%",
			"tax" => Helper::formatNumber((26000 * 4) * 0.17)." MZN",
			"total" => Helper::formatNumber(26000 * 4 + (26000 * 4) * 0.17)." MZN",
		]
	],
	'customer' => [
		'name' => 'Edson Magombe',
		'phone' => '+258 829707047',
		'email' => 'edson.patricio.39@gmail.com', 
	],
];

$report = new Report();
echo $report->invoice($config)->toString();