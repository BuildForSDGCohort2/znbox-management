<?php 

	require __DIR__."/../../autoload.php";

    use controller\Translator;
    use controller\User;
    use controller\UserType;

    use controller\Price;
    use controller\Stock;
    use controller\Helper;

	if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
		echo json_encode([
			'code' => '5000',
			'title' => Translator::translate("Error"),
			'message' => Translator::translate("Session Expired"),
			'status' => 'danger',
		]); die();
	}

	if(!isset($_POST['id']) and !isset($_GET['id'])) {
		die("404_request");
	}

	$id = (isset($_POST['id'])) ? $_POST['id'] : $_GET['id'];

	if(!$price = Price::getBy('id', $id)->first) {
		die("404_request");   
	}

	if(!$Stock = Stock::getBy('id', $price->stock)->first) {
		die("404_request");   
	}

	/* Changing is default price status */
	if(isset($_POST['status'])) {
		$_POST['value']['user_modify'] = $user->id;
		$_POST['value']['stock'] = $Stock->id;
		$_POST['value']['isDefault'] = 1;


		/* Removing all defaults from current Stock */
		foreach(Price::getBy('stock', $Stock->id)->data as $item) {
			Price::update($item['id'], ["isDefault" => 0]);
		}
	}

	/* Removing price */
	if(isset($_POST['value']['isDeleted'])) {
		if($price->isDefault) {
			echo json_encode([
				'code' => '1102',
				'title' => Translator::translate("Error"),
				'message' => Translator::translate("You cannot delete the default price"),
				'status' => 'danger',
			]); die();
		}
	}


	if(Price::update($price->id, $_POST['value'])) {
		echo json_encode([
			'code' => '1102',
			'title' => Translator::translate("Success"),
			'message' => Translator::translate("Updated successfuly"),
			'data' => "id={$Stock->id}",
			'href' => "price/price",
			'status' => 'success',
		]); die();
	} else {
		echo json_encode([
			'code' => '1103',
			'title' => Translator::translate("Server error"),
			'message' => Translator::translate("Error do servidor"),
			'status' => 'danger',
		]); die();
	}