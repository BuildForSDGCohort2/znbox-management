<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\Stock;
use controller\Purchase;
use controller\PurchaseItem;
use controller\Helper;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
    die("user_session");
}
if(!isset($_GET["id"])) {
    die("404_request");
}
if(!$fetch = Purchase::getBy("id", $_GET["id"])) {
    die("404_request");   
}
?>
<div class="ui segment blue">
	<div class="ui dividing header large blue">
		<h3 class="ui header blue"><?=Translator::translate("Edit purchase")?></h3>
	</div>
	<form class="zn-form-complex-update ui form" action="<?=Helper::url("api/purchase/edit.php")?>" data="<?=$fetch["id"]?>">
		<div class="ui form small">
			<div class="three fields">
				<div class="field required">
					<label><?=Translator::translate("description")?></label>
					<input type="text" value="<?=$fetch["description"]?>" name="description" required minlength="3" maxlength="100" placeholder="<?=Translator::translate("description")?>">
				</div>
				<div class="field required">
					<label><?=Translator::translate("purchase date")?></label>
					<input class="flatpickr" value="<?=$fetch["purchase_date"]?>" type="date" name="purchase_date" required>
				</div>
			</div>
		</div>
		<div>
			<table class="ui table inverted blue small zn-purchase-table">
				<thead>
					<th></th>
					<th><?=Translator::translate("Stock")?></th>
					<th><?=Translator::translate("Quantity")?></th>
					<th><?=Translator::translate("Price per unity")?></th>
					<th><?=Translator::translate("Price")?></th>
					<th><?=Translator::translate("Actions")?></th>
				</thead>
				<tbody>
					<?php foreach(PurchaseItem::getAllBy("purchase", $fetch["id"]) as $purchaseItem): ?>
						<tr class="zn-purchase-line">
							<td>
								<label class="ui label circular mini orange">
									<i class="ui arrow right icon"></i>
								</label>
							</td>
							<td>
								<select class="ui dropdown search zn-purchase-stock" name="stock[]" disabled>
									<?php foreach(Stock::getAll() as $item):?>
										<option
											value="<?=$item["id"]?>"
											<?=($purchaseItem["stock"] == $item["id"]) ? "selected" : ""?>
										>
											<?=$item["name"]?>
										</option>
									<?php endforeach; ?>
								</select>
								<input type="hidden" name="stock[]" value="<?=$purchaseItem["stock"]?>">
							</td>
							<td>
								<div class="ui input">
									<input class="zn-purchase-quantity" type="number" name="quantity[]" placeholder="<?=Translator::translate("Quantity")?>" disabled required value="<?=$purchaseItem["quantity"]?>">
									<input type="hidden" name="quantity[]" value="<?=$purchaseItem["quantity"]?>">
								</div>
							</td>
							<td>
								<div class="ui input">
									<input class="zn-purchase-price-unity" type="number" name="price_unity[]" placeholder="<?=Translator::translate("Price per unity")?>" disabled required value="<?=$purchaseItem["price_unity"]?>">
									<input type="hidden" name="price_unity[]" value="<?=$purchaseItem["price_unity"]?>">
								</div>
							</td>
							<td>
								<label class="ui basic label small zn-purchase-line-total"><?=($purchaseItem["price_unity"] * $purchaseItem["quantity"])?></label>
							</td>
							<td>
								<button class="ui button mini red circular icon zn-pruchase-remove-line">
									<i class="ui times icon"></i>
								</button>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<th>
						<button class="ui button mini blue circular icon zn-puchase-table-add-line">
							<i class="ui plus icon"></i>
						</button>
					</th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tfoot>
			</table>
			<div class="ui form small">
				<div class="three fields">
					<div class="field">
						<label><?=Translator::translate("attachment")?></label>
						<input type="file" name="file">
					</div>
				</div>
			</div>
			<button type="submit" class="ui button blue"><?=Translator::translate("Save")?></button>
			<button type="submit" href="<?=Helper::url("api/purchase/purchase.php")?>" class="ui button white zn-link"><?=Translator::translate("Cancel")?></button>
		</div>
	</form>
	<script type="text/javascript">
		$(".flatpickr").flatpickr({
			dateFormat: "Y-m-d",
			locale: "<?=$_COOKIE["lang"]?>",
			altInput: true,
			altFormat: "F j, Y",
			defaultDate: "today",
			maxDate: "today",
		});
		$(".ui.dropdown").dropdown({ on: "click" });
	</script>
</div>