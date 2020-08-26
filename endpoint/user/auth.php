<?php

require __DIR__."/../../autoload.php";

use controller\User;
use controller\Helper;

header("Content-type: application/json");

$request = (object) $_POST;

if($user = User::authenticate($request->email, $request->password)) {
	if($user->status) {

		if (!isset($_COOKIE['lang'])) {
			setcookie("lang", "pt", time() + 3600 * (24 * 365), "/", "", false, false);
		}
		$_SESSION['token'] = $user->token;

		echo json_encode([
			'title' => 'Success',
			'message' => 'Authentication success',
			'status' => 'success'
		]); die();
	}
	echo json_encode([
		'title' => 'Permission denied',
		'message' => 'Your account is desactivated, please contact the system administrator',
		'status' => 'danger'
	]); die();
} else {
	echo(json_encode([
		"status" => "danger",
		"title" => "Authentication failed",
		"message" => "E-mail address or password does not match",
	]));
}