<?php 
	require __DIR__."/../../autoload.php";

	use controller\Translator;
	use controller\User;
	use controller\UserType;

	use controller\Stock;
	use controller\Price;
	use controller\Helper;

	if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
		die("user_session");
	}
?>
<tr>
	<td>
		<label class="ui label circular mini orange">
			<i class="ui arrow right icon"></i>
		</label>
	</td>
	<td>
		<select class="ui dropdown search stock-table-line-stock" name="stock[]">
			<?php foreach(Stock::getAll()->data as $item):?>
				<option 
					value="<?=$item["id"]?>"
					price="<?=((isset(Price::getDefault($item["id"])->first->price_sell)) ? Price::getDefault($item["id"])->first->price_sell : 0)?>"
					stock="<?=Stock::getStockAmount($item["id"]);?>"
				>
					<?=$item["name"]?>
				</option>
			<?php endforeach; ?>
		</select>
	</td>
	<td>
		<label class="ui basic label small stock-table-line-stock-available">
			0
		</label>
	</td>
	<td>
		<div class="ui input">
			<input class="stock-table-line-quantity" type="number" name="quantity[]" placeholder="<?=Translator::translate("Quantity")?>" required value="1">
		</div>
	</td>
	<td>
		<label class="ui basic label small stock-table-line-price-unity">
			0
		</label>
	</td>
	<td>
		<label class="ui basic label small stock-table-line-price">
			0
		</label>
	</td>
	<td>
		<button class="ui button mini red circular icon stock-table-remove-line">
			<i class="ui times icon"></i>
		</button>
	</td>
</tr>