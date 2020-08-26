<?php 

	require __DIR__."/../../autoload.php";

	use controller\User;
	use controller\UserType;
	use controller\Translator;

	if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
		echo json_encode([
			'code' => '5000',
			'title' => Translator::translate("Error"),
			'message' => Translator::translate("Session Expired"),
			'status' => 'danger',
		]); die();
	}

	$password = $_POST['value']['password'];
	$confirm = $_POST['value']['confirm'];

	if($password != $confirm) {
		echo json_encode([
			'code' => '1101',
			'title' => Translator::translate("Error"),
			'message' => Translator::translate("different passwords"),
			'status' => 'danger',
		]); die();
	}

	unset($_POST['value']['confirm']);

	$_POST['value']['password'] = password_hash($_POST['value']['password'], PASSWORD_DEFAULT);

	if(User::add($_POST)) {
		echo json_encode([
			'code' => '1102',
			'title' => Translator::translate("Success"),
			'message' => Translator::translate("Added successfuly"),
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

