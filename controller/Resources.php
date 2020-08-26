<?php

namespace controller;

use controller\Helper;

class Resources {

	public static function stream($filename) {
		return Helper::url("res/$filename");
	}
	public static function upload($folder, $file) {
		$response = null;
		$dir = __DIR__."/../res/$folder";
		if(!is_dir($dir)) {
			mkdir($dir);
		}

		$file_extension = pathinfo($file["name"], PATHINFO_EXTENSION);
		$original_filename = $file["name"];
		$filename = md5(time() . $original_filename) . $file_extension;
		$filepath = $dir."/$filename";

		if(move_uploaded_file($file["tmp_name"], $filepath)) {
			$response = [
				"name" => $filename,
				"path" => $filepath,
				"original" => $original_filename,
				"extension" => $file_extension,
			];
		}
		return $response;
	}
	public static function deleteFile($file) {
		return @unlink(__DIR__."/../res/$file");
	}
}