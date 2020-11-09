<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\Helper;
use controller\Stock;
use controller\Warehouse;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die("user_session");
}
if(!isset($_GET["warehouse"])) {
	die("404_request");
}
if(!$warehouse = Warehouse::getBy("id", $_GET["warehouse"])) {
	die("404_request");
}
?>
<div class="ui segment">
	<div class="">
		<h3 class="ui dividing header blue">
			<i class="truck icon"></i> <?=Translator::translate("New transfer")?>
		</h3>
	</div>

	<form class="zn-form" action="<?=Helper::url("api/stock_transfer/add.php")?>">
		<div class="uk-margin-large-top">
			<div class="ui form">
				<div class="four fields">
					<div class="field">
						<label><?=Translator::translate("From")?></label>
						<select class="ui dropdown search disabled" required>
							<?php foreach(Warehouse::getAll() as $item): ?>
							<option <?=($warehouse["id"] == $item["id"]) ? "selected" : ""?> value="<?=$item["id"]?>">
								<?=$item["name"]?>
							</option>
							<?php endforeach; ?>
						</select>
						<input type="hidden" name="from" value="<?=$warehouse["id"]?>">
					</div>
					<div class="field required">
						<label><?=Translator::translate("To")?></label>
						<select class="ui dropdown search" required name="to">
							<?php foreach(Warehouse::getAll() as $item): ?>
								<?php if($item["id"] != $warehouse["id"]): ?>
								<option value="<?=$item["id"]?>">
									<?=$item["name"]?>
								</option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div>
			<table class="ui table inverted blue small stock_transfer-table">
				<thead>
					<th></th>
					<th><?=Translator::translate("stock")?></th>
					<th><?=Translator::translate("Available stock")?></th>
					<th><?=Translator::translate("Quantity")?></th>
					<th><?=Translator::translate("Actions")?></th>
				</thead>
				<tbody></tbody>
				<tfoot>
					<th>
						<button class="ui button mini blue circular icon stock_transfer-table-add-line">
							<i class="ui plus icon"></i>
						</button>
					</th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tfoot>
			</table>
			<button type="submit" class="ui button blue"><?=Translator::translate("Submit")?></button>
			<button type="submit" href="<?=Helper::url("api/stock_transfer/stock_transfer.php")?>" class="ui button white zn-link"><?=Translator::translate("Cancel")?></button>
		</div>
	</form>
	<script type="text/javascript">
		$(".ui.dropdown").dropdown();
		get_stock_transfer_line("<?=Helper::url("api/stock_transfer/line.php?warehouse=".$warehouse["id"])?>");
	</script>
</div>