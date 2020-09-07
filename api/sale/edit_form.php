<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\Helper;
use controller\Stock;
use controller\Price;
use controller\Sale;
use controller\SaleStock;
use controller\Customer;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die("user_session");
}
if(!isset($_GET["id"])) {
    die("404_request");
}
if(!$fetch = Sale::getBy("id", $_GET["id"])) {
    die("404_request");   
}
?>
<div class="ui segment">
	<div class="ui dividing header large blue">
		<h3><?=Translator::translate("New sale")?></h3>
	</div>
	<form class="zn-form-update" action="<?=Helper::url("api/sale/edit.php")?>" data="<?=$fetch["id"]?>">
		<!-- Sale info -->
		<input type="hidden" id="tax_percentage" name="tax_percentage" value="<?=$fetch["tax_percentage"]?>">
		<!-- Sale info end -->
		<div class="uk-margin-large-top">
			<div class="ui form">
				<div class="four fields">
					<div class="field">
						<label><?=Translator::translate("customer")?></label>
						<select class="ui dropdown search" required name="customer">
							<?php foreach(Customer::getAll() as $item): ?>
							<option <?=($fetch["customer"] == $item["id"]) ? "selected" : ""?> value="<?=$item["id"]?>">
								<?=$item["name"]?>
							</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="field">
						<label><?=Translator::translate("discount type")?></label>
						<select class="ui dropdown" required name="discount_type">
							<option value="1" <?=($fetch["discount_type"] == 1) ? "selected" : ""?>>
								<?=Translator::translate("Percentage")?>
							</option>
							<option value="2" <?=($fetch["discount_type"] == 2) ? "selected" : ""?>>
								<?=Translator::translate("Value")?>
							</option>
						</select>
					</div>
					<div class="field">
						<label><?=Translator::translate("discount")?></label>
						<input 
							type="number" 
							name="discount"
							required
							placeholder="<?=Translator::translate("discount")?>"
							value="<?=$fetch["discount"]?>"
						>
					</div>
				</div>
			</div>
		</div>

		<div>
			<table class="ui table inverted blue small stock-table">
				<thead>
					<th></th>
					<th><?=Translator::translate("stock")?></th>
					<th><?=Translator::translate("Available stock")?></th>
					<th><?=Translator::translate("Quantity")?></th>
					<th><?=Translator::translate("Price per unity")?></th>
					<th><?=Translator::translate("Price")?></th>
					<th><?=Translator::translate("Actions")?></th>
				</thead>
				<tbody>
					<?php foreach(SaleStock::getAllBy("sale", $fetch["id"]) as $item): ?>
	                <tr>
						<td>
							<label class="ui label circular mini orange">
								<i class="ui arrow right icon"></i>
							</label>
						</td>
						<td>
							<select class="ui dropdown search stock-table-line-stock" name="stock[]" disabled>
								<?php foreach(Stock::getAll() as $stock):?>
									<option 
										value="<?=$stock["id"]?>"
										price="<?php
											echo (isset(Price::getDefault($stock["id"])["price_sell"])) ? Price::getDefault($stock["id"])["price_sell"] : 0
										?>"
										<?php 
											$total_quantity = Stock::getStockAmount($stock["id"]);
											foreach(SaleStock::getAllBy("sale", $fetch["id"]) as $_item) {
												if($_item["stock"] == $item["stock"]) {
													/* Sum all quantities from the same stock */
													$total_quantity += $_item["quantity"];
												}
											}
										?>
										stock="<?=$total_quantity?>"
										<?=($stock["id"] == $item["stock"]) ? "selected" : ""?>
									>
										<?=$stock["name"]?>
									</option>
								<?php endforeach; ?>
							</select>
							<input type="hidden" name="stock[]" value="<?=$item["stock"]?>">
						</td>
						<td>
							<label class="ui basic label small stock-table-line-stock-available">
								<?=Stock::getStockAmount($item["stock"]);?>
							</label>
						</td>
						<td>
							<div class="ui input">
								<input
									class="stock-table-line-quantity"
									type="number"
									name="quantity[]"
									placeholder="<?=Translator::translate("Quantity")?>"
									required
									value="<?=$item["quantity"]?>"
									max="<?=Stock::getStockAmount($item["stock"]) + $item["quantity"]?>"
									min="0"
								>
							</div>
						</td>
						<td>
							<label class="ui basic label small stock-table-line-price-unity">
								<?=$item["price_sale"]?>
							</label>
						</td>
						<td>
							<label class="ui basic label small stock-table-line-price">
								<?=$item["quantity"] * $item["price_sale"]?>
							</label>
						</td>
						<td>
							<button class="ui button mini red circular icon stock-table-remove-line">
								<i class="ui times icon"></i>
							</button>
						</td>
					</tr>
	                <?php endforeach; ?>
				</tbody>
				<tfoot>
					<th>
						<button class="ui button mini blue circular icon stock-table-add-line">
							<i class="ui plus icon"></i>
						</button>
					</th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tfoot>
			</table>
			<div>
				<div class="ui grid stackable">
					<div class="ten wide column">
						
					</div>
					<div class="six wide column">
						<table class="ui table inverted blue stripped small">
							<thead>
								<th></th>
								<th></th>
							</thead>
							<tbody>
								<tr>
									<td><?=Translator::translate("Sub total")?></td>
									<td class="right aligned">
										<label class="ui basic label small stock-table-subtotal">0</label>
									</td>
								</tr>
								<tr>
									<td><?=Translator::translate("vat")?></td>
									<td class="right aligned">
										<label class="ui basic label small stock-table-vat">0</label>
									</td>
								</tr>
								<tr>
									<td><?=Translator::translate("total (vat included)")?></td>
									<td class="right aligned">
										<label class="ui basic label small stock-table-total-vat">0</label>
									</td>
								</tr>
							</tbody>
						</table>	
					</div>
				</div>
			</div>
			<button type="submit" class="ui button blue"><?=Translator::translate("Save")?></button>
			<button type="submit" href="<?=Helper::url("api/sale/sale.php")?>" class="ui button white zn-link"><?=Translator::translate("Cancel")?></button>
		</div>
	</form>
	<script type="text/javascript">
		$(".ui.dropdown").dropdown();
		update();
	</script>
</div>