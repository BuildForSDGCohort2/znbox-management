<?php 

require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\UserType;
use controller\Stock;
use controller\Warehouse;
use controller\Helper;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die("user_session");
}
if(!isset($_GET["warehouse"])) {
	#die("404_request");
}
if(!$warehouse = Warehouse::getBy("id", 1)) {
	die("404_request");
}
?>
<tr>
	<td>
		<label class="ui label circular mini orange">
			<i class="ui arrow right icon"></i>
		</label>
	</td>
	<td>
		<select class="ui dropdown search stock_transfer-table-line-stock" name="stock[]">
			<?php foreach(Stock::getAll() as $item):?>
				<option 
					value="<?=$item["id"]?>"
					stock="<?=Stock::getStockAmount($item["id"]);?>"
				>
					<?=$item["name"]?>
				</option>
			<?php endforeach; ?>
		</select>
	</td>
	<td>
		<label class="ui basic label small stock_transfer-table-line-stock-available">
			0
		</label>
	</td>
	<td>
		<div class="ui input">
			<input class="stock_transfer-table-line-quantity" type="number" name="quantity[]" placeholder="<?=Translator::translate("Quantity")?>" required value="1">
		</div>
	</td>
	<td>
		<button class="ui button mini red circular icon stock_transfer-table-remove-line">
			<i class="ui times icon"></i>
		</button>
	</td>
</tr>