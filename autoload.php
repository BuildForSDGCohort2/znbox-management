<?php
# ini_set("max_execution_time", "0");
require_once __DIR__."/vendor/autoload.php";

session_start();

spl_autoload_register(function ($class_name) {
    require_once implode("/", explode("\\", __DIR__."/".$class_name .".php"));
});