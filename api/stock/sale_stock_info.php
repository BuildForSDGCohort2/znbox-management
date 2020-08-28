<?php require '../../loader.php';

$id = isset($_GET['id']) ? Database::conn()->quote($_GET['id']) : "";

if(isset($_GET['id'])) {
	$product = Stock::getById($id);
	echo(json_encode($product)); die();
} else {
	echo(json_encode([])); die();
}