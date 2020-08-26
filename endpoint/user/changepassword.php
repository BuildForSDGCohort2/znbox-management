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

	if($_POST['value']['newpassword'] != $_POST['value']['confirmnew']) {
		echo json_encode([
			'code' => '1201',
			'title' => Translator::translate("Error"),
			'message' => Translator::translate("different passwords"),
			'status' => 'danger',
		]); die();
	}
	$password = password_hash($_POST['value']['newpassword'], PASSWORD_DEFAULT);

	if(User::update($_POST['id'], ["password" => $password])) {
		echo json_encode([
			'code' => '1202',
			'title' => Translator::translate("Success"),
			'message' => Translator::translate("Updated successfuly"),
			'status' => 'success',
			'href' => 'user/users',
		]); die();
	} else {
		echo json_encode([
			'code' => '1203',
			'title' => Translator::translate("Server error"),
			'message' => Translator::translate("Error do servidor"),
			'status' => 'danger',
		]); die();
	}