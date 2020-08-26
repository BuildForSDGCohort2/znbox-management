<?php 
	require __DIR__."/../../autoload.php";

	use controller\Translator;
	use controller\User;
	use controller\UserType;

	if(!isset($_SESSION['token']) and !User::validate_token($_SESSION['token'])) {
		echo json_encode([
			'code' => '5000',
			'title' => Translator::translate("Error"),
			'message' => Translator::translate("Session Expired"),
			'status' => 'danger',
		]); die();
	}

	$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first;

	if(User::update($_POST['id'], ['user_type' => $_POST['status']])->success) {
		echo json_encode([
			'code' => '1102',
			'title' => Translator::translate("Success"),
			'message' => Translator::translate("Updated successfuly"),
			'status' => 'success',
			'href' => 'user/users',
		]); die();
	} else {
		echo json_encode([
			'code' => '1103',
			'title' => Translator::translate("Server error"),
			'message' => Translator::translate("Error do servidor"),
			'status' => 'danger',
		]); die();
	}