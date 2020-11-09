<?php

require __DIR__."/../../autoload.php";

use controller\Stock;
use controller\Warehouse;
use controller\Helper;
use controller\User;
use controller\Translator;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die("user_session");
}
?>
<tr class="zn-purchase-line">
	<td>
		<label class="ui label circular mini orange">
			<i class="ui arrow right icon"></i>
		</label>
	</td>
	<td>
		<select class="ui dropdown search zn-purchase-stock" name="stock[]">
			<?php foreach(Stock::getAll() as $item):?>
				<option value="<?=$item["id"]?>">
					<?=$item["name"]?>
				</option>
			<?php endforeach; ?>
		</select>
	</td>
	<td>
		<div class="ui input">
			<input class="zn-purchase-quantity" type="number" name="quantity[]" placeholder="<?=Translator::translate("Quantity")?>" required value="1">
		</div>
	</td>
	<td>
		<div class="ui input">
			<input class="zn-purchase-price-unity" type="number" name="price_unity[]" placeholder="<?=Translator::translate("Price per unity")?>" required value="1">
		</div>
	</td>
	<td>
		<label class="ui basic label small zn-purchase-line-total">1</label>
	</td>
	<td>
		<select name="warehouse[]" class="ui dropdown search">
			<?php foreach (Warehouse::getAll() as $key => $value): ?>
				<option value="<?=$value["id"]?>"><?=$value["name"]?></option>
			<?php endforeach ?>
		</select>
	</td>
	<td>
		<button class="ui button mini red circular icon zn-pruchase-remove-line">
			<i class="ui times icon"></i>
		</button>
	</td>
	<script type="text/javascript">
		$(".ui.dropdown").dropdown({ on: "click" });
	</script>
</tr>