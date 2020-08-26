<?php 

namespace controller;

use ReallySimpleJWT\Token;
use connections\Database;
use queryBuilder\JsonQB as JQB;
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

	public static function add($request) {
		$result = JQB::Insert('user', $request)->execute();
		return $result;
	}

	public static function update($id, $values) {
		$result = JQB::Update('user', [
			'value' => $values, 
			'where' => [
				[
					"columns" => [
						"id" => $id
					]
				]
			]
		])->execute();
		return $result;
	}

	public static function getBy($column, $value) {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['user'],
			'where' => [
				[
					"columns" => [
						"$column" => $value
					]
				]
			]
		])->execute();
		return $result;
	}

	public static function getAll() {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['user']
		])->execute();
		return $result;
	}

	public static function where($where) {
		$result = JQB::Select([
			'columns' => ['*'],
			'from' => ['user'],
			'where' => $where,
		])->execute();
		return $result;
	}

	public static function authenticate($email, $password) {
		$user = self::getBy('email', $email)->first;
		if($user) {
			if(password_verify($password, $user->password)) {
				$user = (object) $user;
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