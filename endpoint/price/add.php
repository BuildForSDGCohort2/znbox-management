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

	if(!isset($_GET['id'])) {
		die("404_request");
	}

	if(!$Stock = Stock::getBy('id', $_GET['id'])->first) {
		die("404_request");   
	}

	$_POST['value']['user_modify'] = $user->id;
	$_POST['value']['user_added'] = $user->id;
	$_POST['value']['stock'] = $Stock->id;
	$_POST['value']['isDefault'] = (Price::getBy('stock', $Stock->id)->count) ? 0 : 1;

	if(Price::add($_POST)) {
		echo json_encode([
			'code' => '1102',
			'title' => Translator::translate("Success"),
			'message' => Translator::translate("Added successfuly"),
			'status' => 'success',
			'data' => "id={$Stock->id}",
			'href' => "price/price",
		]); die();
	} else {
		echo json_encode([
			'code' => '1103',
			'title' => Translator::translate("Server error"),
			'message' => Translator::translate("Error do servidor"),
			'status' => 'danger',
		]); die();
	}