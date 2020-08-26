<?php

namespace controller;

use controller\Dictionary;
use stdClass;

class Translator {

	public static function translate($key) {
		return Dictionary::find($key, $_COOKIE['lang']);
	}
}