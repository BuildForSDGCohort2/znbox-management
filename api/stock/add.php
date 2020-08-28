<?php 
	require __DIR__."/../../autoload.php";

	use controller\Translator;
	use controller\User;
	use controller\UserType;

	use controller\Supplier;
	use controller\_StockSupplier;
	use controller\Warehouse;
	use controller\Stock;
	use controller\Price;
	use controller\Helper;

	if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
		echo json_encode([
			'code' => '5000',
			'title' => Translator::translate("Error"),
			'message' => Translator::translate("Session Expired"),
			'status' => 'danger',
		]); die();
	}

	$_POST['value']['user_added'] = $user->id;
	$_POST['value']['user_modify'] = $user->id;

	$price_sell = $_POST['value']['price_sell'];
	$price_purchase = $_POST['value']['price_purchase'];

	unset($_POST['value']['price_sell']);
	unset($_POST['value']['price_purchase']);

	if($result = Stock::add($_POST)) {
		if(isset($_POST['supplier'])) {
			foreach ($_POST['supplier'] as $item) {
				_StockSupplier::add([
					'value' => [
						'supplier' => $item,
						'stock' => $result->id
					]
				]);
			}
		}
		Price::add([
			"value" => [
				"isDefault" => true,
				"price_sell" => $price_sell,
				"price_purchase" => $price_purchase,
				"stock" => $result->id,
				"user_added" => $user->id,
				"user_modify" => $user->id,
			]
		]);
		echo json_encode([
			'code' => '1102',
			'title' => Translator::translate("Success"),
			'message' => Translator::translate("Added successfuly"),
			'status' => 'success',
			'href' => 'stock/stock',
		]); die();
	} else {
		echo json_encode([
			'code' => '1103',
			'title' => Translator::translate("Server error"),
			'message' => Translator::translate("Server error"),
			'status' => 'danger',
		]); die();
	}

