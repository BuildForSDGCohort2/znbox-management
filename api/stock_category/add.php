<?php 

	require __DIR__."/../../autoload.php";

    use controller\Translator;
    use controller\User;
    use controller\UserType;

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

	if(StockCategory::getBy('name', $_POST['value']['name'])->first) {
		echo json_encode([
			'code' => '1103',
			'title' => Translator::translate("Item alreay exists"),
			'message' => Translator::translate("Item with inserted name alreay exists"),
			'status' => 'danger',
		]); die();
	}

	$_POST['value']['user_modify'] = $user->id;
	$_POST['value']['user_added'] = $user->id;

	if(StockCategory::add($_POST)) {
		echo json_encode([
			'code' => '1102',
			'title' => Translator::translate("Success"),
			'message' => Translator::translate("Added successfuly"),
			'status' => 'success',
			'href' => 'stock_category/stock_category',
		]); die();
	} else {
		echo json_encode([
			'code' => '1103',
			'title' => Translator::translate("Server error"),
			'message' => Translator::translate("Error do servidor"),
			'status' => 'danger',
		]); die();
	}