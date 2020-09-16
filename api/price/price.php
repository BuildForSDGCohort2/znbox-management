<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\Stock;
use controller\Price;
use controller\Helper;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die("user_session");
}
if(!isset($_GET["id"])) {
	die("404_request");
}
if(!$stock = Stock::getBy("id", $_GET["id"])) {
	die("404_request");   
}
?>
<div class="ui segment blue">
	<div class="ui segment">
		<a class="ui mini basic circular icon button red zn-link" href="<?=Helper::url("api/stock/stock.php")?>" data="<?=$stock["id"]?>" data-tooltip="<?=Translator::translate("back")?>">
			<i class="ui left arrow icon"></i>
		</a>
	</div>
	<div class="uk-padding-small">
		<div class="ui header dividing color blue">
			<h3 class="ui header blue">
				<i class="ui box icon"></i> <?=$stock["name"]?>
			</h3>
		</div>
		<a class="ui basic button blue zn-link-dialog" href="<?=Helper::url("api/price/add_form.php")?>" data="<?=$stock["id"]?>"><i class="ui plus icon"></i> <?=Translator::translate("Add price")?></a>
	</div>
	<div class="uk-margin">
		<div align="center" class="ui segment spacked purple uk-width-small">
			<div class="ui statistic purple">
			    <div class="value">
			      <?=Price::getAllBy("stock", $stock["id"])->rowCount()?>
			    </div>
			    <div class="label">
			      <?=Translator::translate("total")?>
			    </div>
			</div>
		</div>
	</div>
	<div class="uk-margin-top" style="margin-left: 10px;">
		<table class="ui small table selectable celled striped">
			<thead>
				<th><?=Translator::translate("Id")?></th>
				<th><?=Translator::translate("price of sale");?></th>
				<th><?=Translator::translate("Default Price")?></th>
				<th><?=Translator::translate("Observation")?></th>
				<th><?=Translator::translate("Actions")?></th>
			</thead>
			<tbody>
				<?php foreach(Price::getAllBy("stock", $stock["id"]) as $item): ?>
				<tr>
					<td><?=$item["id"]?></td>
					<td class="right aligned">
						<label class="ui label blue mini">
							<?=Helper::formatnumber($item["price_sell"])?>
						</label>
					</td>
					<td class="center aligned">
						<div class="ui radio checkbox">
							<input class="zn-radiobox" href="<?=Helper::url("api/price/edit.php")?>" data="<?=$item["id"]?>" type="radio" name="value[isDefault]" <?=($item["isDefault"]) ? "checked=\"checked\"" : "";?>>
							<label></label>
					    </div>
					</td>
					<td><?=$item["observation"]?></td>
					<td>
						<a class="ui mini basic circular icon button green zn-link-dialog" href="<?=Helper::url("api/price/edit_form.php")?>" data="<?=$item["id"]?>" data-tooltip="<?=Translator::translate("edit details")?>">
							<i class="ui edit icon"></i>
						</a>
						<a class="ui mini basic circular icon button red zn-link-dialog" href="<?=Helper::url("api/price/delete_form.php")?>" data="<?=$item["id"]?>" data-tooltip="<?=Translator::translate("delete")?>">
							<i class="ui times icon"></i>
						</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>