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

	if(isset($_POST['lang'])) {

		if($_POST['lang'] == "pt") {
			setcookie("lang", "pt", time() + 3600 * (24 * 365), "/", "", false, false);
			echo("reload"); die();
		}
		if($_POST['lang'] == "eng") {
			setcookie("lang", "eng", time() + 3600 * (24 * 365), "/", "", false, false);
			echo("reload"); die();
		}
	} else {
		echo json_encode([
			'code' => '1103',
			'title' => Translator::translate("Server error"),
			'message' => Translator::translate("Error do servidor"),
			'status' => 'danger',
		]); die();
	}