<?php 

namespace controller;

use ReallySimpleJWT\Token;
use connections\Database;
use controller\QueryBuilder;
use stdClass;

class User extends Database {

	public const secret_token_key = '@base#!_znbox_ReT_%sys_555*&';
	public const issuer = "localhost";

	public static function create_token($user) {
		$userId = $user->id;
		$secret = self::secret_token_key;
		$expiration = time() + (3600 * 24) * 30 * 3;
		$issuer = self::issuer;
		$token = Token::create($userId, $secret, $expiration, $issuer);
		return $token;
	}
	public static function validate_token($token) {
		$secret = self::secret_token_key;
		if(Token::validate($token, $secret)) {
			return Token::getPayload($token, $secret);
		}
		return false;
	}
	public static function with_token($object, $token) {
		$object->token = $token;
		return $object;
	}
	public static function add($data) {
		$conn = Database::conn();
		$sql = QueryBuilder::insert("user", $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function update($id, $data) {
		$conn = Database::conn();
		$sql = QueryBuilder::update("user", "id", $id, $data);
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function getBy($column, $value) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM user WHERE user.$column = $value;";
		$stmt = $conn->query($sql);
		$fetch = $stmt->fetch();
		return $fetch;
	}
	public static function getAllBy($column, $value) {
		$conn = Database::conn();
		$value = $conn->quote($value);
		$sql = "SELECT * FROM user WHERE user.$column = $value;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}
	public static function getAll() {
		$conn = Database::conn();
		$sql = "SELECT * FROM user;";
		$stmt = $conn->prepare($sql);
		return ($stmt->execute() ? $stmt : null);
	}

	public static function authenticate($email, $password) {
		if($user = self::getBy('email', $email)) {
			$user = (object) $user;
			if(password_verify($password, $user->password)) {
				$response = new stdClass;
				$response->id = $user->id;
				$response->email = $user->email;
				$response->first = $user->first;
				$response->last = $user->last;
				$response->date_added = $user->date_added;
				$response->status = $user->status;
				$response->user_type = $user->user_type;
				return self::with_token($response, self::create_token($response));
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}