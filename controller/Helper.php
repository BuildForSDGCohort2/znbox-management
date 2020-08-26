<?php

namespace controller;

use stdClass;

class Helper {

	private static $key = "@@&AIHSU002#$";

	public static function is_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			return true;
		}
		return false;
	}

	public static function encrypt($string) {
		return base64_encode(openssl_encrypt($string, "AES-128-ECB", self::$key, 0));
	}
	public static function decrypt($hash) {
		return openssl_decrypt(base64_decode($hash), "AES-128-ECB", self::$key);
	}
	
	public static function startsWith($string, $item_to_check) {
    	return substr_compare($string, $item_to_check, 0, strlen($item_to_check)) === 0;
	}
	public static function endsWith($string, $item_to_check) {
	    return substr_compare($string, $item_to_check, -strlen($item_to_check)) === 0;
	}
	public static function contains($string, $item_to_check) {
		return (strpos($string, $item_to_check) !== false);
	}

	public static function formatNumber($number) {
		return number_format($number);
	}
	public static function toRef($number) {
		return "#" . sprintf("%04d", $number);
	}
	public static function datetime($date) {
		return date_format(date_create($date), "d-m-Y h:i:s");
	}
	public static function date($date) {
		return date_format(date_create($date), "d-m-Y");
	}
	public static function url($path) {
		$root = implode("/", explode("\\", $_SERVER["DOCUMENT_ROOT"]));
		$app_path = rtrim(implode("/", explode("\\", __DIR__)), "controller");
		$server_dir = substr($app_path, strlen($root));
		$protocol = (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on" || $_SERVER["HTTPS"] == 1)) ? "https" : "http";
		$host = $_SERVER["SERVER_NAME"];
		$port = $_SERVER["SERVER_PORT"];
		$uri = "$protocol://$host".(($port == 80 || $port == 443) ? "" : ":$port")."$server_dir";
		return $uri.$path;
	}
	public static function currentUrl() {
		$root = implode("/", explode("\\", $_SERVER["DOCUMENT_ROOT"]));
		$app_path = rtrim(implode("/", explode("\\", __DIR__)), "controller");
		$server_dir = substr($app_path, strlen($root));
		$current_url = substr($_SERVER["REQUEST_URI"], strlen($server_dir));

		$protocol = (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on" || $_SERVER["HTTPS"] == 1)) ? "https" : "http";
		$host = $_SERVER["SERVER_NAME"];
		$port = $_SERVER["SERVER_PORT"];
		$uri = "$protocol://$host".(($port == 80 || $port == 443) ? "" : ":$port")."$server_dir";
		return $uri.$current_url;
	}
}