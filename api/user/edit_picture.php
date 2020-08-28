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

	$picture = md5(time().$_FILES['picture']['name']);
	$picPath = __DIR__."/../../res/uploads/".$picture;

	$allowed = array('png', 'jpg', 'gif');
		
	$extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo json_encode([
			'code' => '1106',
			'title' => Translator::translate("Image format not allowed"),
			'message' => Translator::translate("Error do servidor"),
			'status' => 'danger',
		]); die();
	}

	$_POST = array('picture' => $picture, 'id' => $_POST['id']);

	if(move_uploaded_file($_FILES['picture']['tmp_name'], __DIR__."/../../res/uploads/".$picture)) {
		if(User::update($user->id, $_POST)) {
			echo json_encode([
				'code' => '1102',
				'title' => Translator::translate("Success"),
				'message' => Translator::translate("Updated successfuly"),
				'status' => 'success',
				'href' => 'user/profile',
			]); die();
		} else {
			echo json_encode([
				'code' => '1103',
				'title' => Translator::translate("Server error"),
				'message' => Translator::translate("Error do servidor"),
				'status' => 'danger',
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