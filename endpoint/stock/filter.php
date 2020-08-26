<?php 

require '../../loader.php'; 

$count_filter = 0;
$response = "";



$category = isset($_GET['category']) ? Database::conn()->quote($_GET['category']) : "";
$supplier = isset($_GET['supplier']) ? Database::conn()->quote($_GET['supplier']) : "";

if(isset($_GET['category'])) {
	foreach(Stock::getByCategory($category) as $item) {
		if(isset($_GET['supplier'])) {
			if(_StockSupplier::getByStockAndSupplier($item['id'], $supplier)) {
				$response .= "<div class=\"item\" data-value=\"".$item['id']."\">".$item['name']."<label class=\"ui mini label circular blue right floated\">".$item['quantity']."</label>"."</div>";
			}
		} else {
			$response .= "<div class=\"item\" data-value=\"".$item['id']."\">".$item['name']."<label class=\"ui mini label circular blue right floated\">".$item['quantity']."</label>"."</div>";
		}
	}
	$count_filter ++;
}

echo($response); die();