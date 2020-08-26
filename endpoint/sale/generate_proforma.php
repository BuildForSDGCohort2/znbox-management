<?php 

	require __DIR__."/../../autoload.php";

	use queryBuilder\JsonQB as JQB;

    use controller\Translator;
    use controller\User;
    use controller\UserType;

    use controller\Sale;
    use controller\Stock;
    use controller\SaleStock;
    use controller\Enterprise;
    use controller\Customer;
    use controller\Proforma;
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

	if(!isset($_POST['value']['sale'])) {
        die("404_request");
    }

    if(!$sale = Sale::getBy('id', $_POST['value']['sale'])->first) {
    	die("404_request");
    }

	$_POST['value']['user_added'] = $user->id;
	$_POST['value']['user_modify'] = $user->id;
	$_POST['value']['sale'] = $sale->id;
	$_POST['value']['status'] = 1;
	$_POST['value']['enterprise'] = json_encode(Enterprise::getAll()->first);
	$_POST['value']['customer'] = json_encode(Customer::getBy('id', $sale->customer)->first);
	$_POST['value']['itens'] = SaleStock::getBy('sale', $sale->id)->data;

	foreach ($_POST['value']['itens'] as $index => $item) {
		$stock = $_POST['value']['itens'][$index]['stock'];
		$_POST['value']['itens'][$index]['stock'] = (array) Stock::getBy('id', $stock)->first;
	}
	$_POST['value']['itens'] = json_encode($_POST['value']['itens']);

	$number = (Proforma::getAll()->last) ? Proforma::getAll()->last->number + 1 : 1;
	$_POST['value']['number'] = $number;

	$proforma = Proforma::add($_POST);
	if($proforma->success) {
		echo json_encode([
			'code' => '1102',
			'title' => Translator::translate("Success"),
			'message' => Translator::translate("Added successfuly"),
			'status' => 'success',
			'href' => 'sale/sale',
		]); die();
	} else {
		echo json_encode([
			'code' => '1103',
			'title' => Translator::translate("Server error"),
			'message' => Translator::translate("Error do servidor"),
			'status' => 'danger',
		]); die();
	}