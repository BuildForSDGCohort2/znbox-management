<?php 

	require __DIR__."/../../autoload.php";

	use queryBuilder\JsonQB as JQB;

    use controller\Translator;
    use controller\User;
    use controller\UserType;

    use controller\Sale;
    use controller\SaleStock;
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

	if(!$sale = Sale::getBy('id', $_POST['id'])->first) {
        die("404_request");   
    }

	if(!isset($_POST['value']['isDeleted'])) {
		$_POST['value']['user_modify'] = $user->id;
		$_POST['value']['user_added'] = $user->id;
		$_POST['value']['discount'] = $_POST['discount'];
		$_POST['value']['customer'] = $_POST['customer'];
		$_POST['value']['discount_type'] = $_POST['discount_type'];
		$_POST['value']['tax_percentage'] = $_POST['tax_percentage'];
		$_POST['value']['observation'] = '';
	}

	/* Map all itens in database */
	JQB::begin();

	
	if(Sale::update($sale->id, $_POST['value'])) {
		if(!isset($_POST['value']['isDeleted'])) {
			SaleStock::deleteBySale($sale->id);
			$stock = $_POST['stock'];
			$quantity = $_POST['quantity'];
			try {
				foreach ($stock as $key => $value) {
					SaleStock::add([
						'value' => [
							'sale' => $sale->id,
							'stock' => $value,
							'quantity' => $quantity[$key],
							'price_sale' => Price::getDefault($value)->first->price_sell,
							'price_purchase' => Price::getDefault($value)->first->price_purchase,
						]
					]);
				}
				JQB::commit();
				echo json_encode([
					'code' => '1102',
					'title' => Translator::translate("Success"),
					'message' => Translator::translate("Updated successfuly"),
					'status' => 'success',
					'href' => 'sale/sale',
				]); die();
			} catch(Exception $ex) {
				JQB::rollback();
				echo json_encode([
					'code' => '1103',
					'title' => Translator::translate("Server error"),
					'message' => Translator::translate("Error do servidor"),
					'status' => 'danger',
				]); die();
			}
		} else {
			JQB::commit();
			echo json_encode([
				'code' => '1102',
				'title' => Translator::translate("Success"),
				'message' => Translator::translate("Updated successfuly"),
				'status' => 'success',
				'href' => 'sale/sale',
			]); die();
		}
	} else {
		echo json_encode([
			'code' => '1103',
			'title' => Translator::translate("Server error"),
			'message' => Translator::translate("Error do servidor"),
			'status' => 'danger',
		]); die();
	}
	