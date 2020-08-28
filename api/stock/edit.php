<?php 
	require __DIR__."/../../autoload.php";

	use controller\Translator;
	use controller\User;
	use controller\UserType;

	use controller\Supplier;
	use controller\_StockSupplier;
	use controller\Warehouse;
	use controller\Stock;
	use controller\StockCategory;
	use controller\Helper;

	if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
		echo json_encode([
			'code' => '5000',
			'title' => Translator::translate("Error"),
			'message' => Translator::translate("Session Expired"),
			'status' => 'danger',
		]); die();
	}

	$_POST['value']['user_modify'] = $user->id;


	if(isset($_POST['value']['isDeleted'])) {
		if(Stock::update($_POST['id'], $_POST['value'])->success) {
			echo json_encode([
				'code' => '1102',
				'title' => Translator::translate("Success"),
				'message' => Translator::translate("Updated successfuly"),
				'status' => 'success',
				'href' => 'stock/stock',
			]); die();
		} else {
			echo json_encode([
				'code' => '1103',
				'title' => Translator::translate("Server error"),
				'message' => Translator::translate("Error do servidor"),
				'status' => 'danger',
			]); die();
		}
	}

	if(Stock::update($_POST['id'], $_POST['value'])->success) {
		_StockSupplier::delete([
			[
				"columns" => [
					"Stock" => $_POST['id']
				]
			]
		]);
		if(isset($_POST['supplier'])) {
			foreach ($_POST['supplier'] as $item) {
				_StockSupplier::add([
					'value' => [
						'supplier' => $item,
						'Stock' => $_POST['id']
					]
				]);
			}
		}
		echo json_encode([
			'code' => '1102',
			'title' => Translator::translate("Success"),
			'message' => Translator::translate("Updated successfuly"),
			'status' => 'success',
			'href' => 'stock/stock',
		]); die();
	} else {
		echo json_encode([
			'code' => '1103',
			'title' => Translator::translate("Server error"),
			'message' => Translator::translate("Error do servidor"),
			'status' => 'danger',
		]); die();
	}

