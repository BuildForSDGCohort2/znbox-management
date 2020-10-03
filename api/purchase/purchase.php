<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\UserType;
use controller\Stock;
use controller\Purchase;
use controller\PurchaseItem;
use controller\Helper;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die("user_session");
}
?>
<div class="ui segment blue">
	<div class="uk-padding-small">
		<div class="ui header dividing color blue">
			<h3 class="ui header blue"><i class="ui cart icon"></i> <?=Translator::translate("Purchases")?></h3>
		</div>
		<a class="ui basic small button blue zn-link" href="<?=Helper::url("api/purchase/add_form.php?id=".$item["id"])?>"><i class="ui plus icon"></i> <?=Translator::translate("Add purchase")?></a>

	</div>
	<div class="uk-margin-top" style="margin-left: 10px;">
		<table class="ui small table color blue inverted selectable stripped">
			<thead>
				<th><?=Translator::translate("id");?></th>
				<th><?=Translator::translate("Description");?></th>
				<th><?=Translator::translate("purchase date");?></th>
				<th><?=Translator::translate("Total spent");?></th>
				<th><?=Translator::translate("Actions");?></th>
			</thead>
			<tbody>
				<?php foreach(Purchase::getAll() as $item): ?>
					<tr>
						<td>
							<label class="ui small orange ribbon label">
								<?=$item["id"]?>
							</label>
						</td>
						<td><?=$item["description"]?></td>
						<td><?=Helper::date($item["purchase_date"])?></td>
						<td>
							<label class="ui label blue mini">
								<?=Helper::formatnumber(Purchase::getTotalPrice($item["id"]))?>
							</label>
						</td>
						<td>
							<?php if(!$item["isStock"]): ?>
							<a class="ui mini circular icon button pink zn-link-dialog" href="<?=Helper::url("api/purchase/to_stock_form.php?id=".$item["id"])?>" data="<?=$item["id"]?>" data-tooltip="<?=Translator::translate("Submit to stock")?>">
								<i class="ui send alternate icon"></i>
							</a>
							<?php endif; ?>
							<a class="ui mini circular icon button violet zn-link-dialog" href="<?=Helper::url("api/purchase/view.php?id=".$item["id"])?>" data="<?=$item["id"]?>" data-tooltip="<?=Translator::translate("view details")?>">
								<i class="ui eye icon"></i>
							</a>
							<?php if(!$item["isStock"]): ?>
							<a class="ui mini circular icon button green zn-link" href="<?=Helper::url("api/purchase/edit_form.php?id=".$item["id"])?>" data-tooltip="<?=Translator::translate("edit details")?>">
								<i class="ui edit icon"></i>
							</a>
							<a class="ui mini circular icon button red zn-link-dialog" href="<?=Helper::url("api/purchase/delete_form.php?id=".$item["id"])?>" data="<?=$item["id"]?>" data-tooltip="<?=Translator::translate("delete")?>">
								<i class="ui trash alternate icon"></i>
							</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(".ui.dropdown").dropdown();
	$(".ui.table").DataTable({
		//dom: "lBfrtip",
		"bDestroy": true,
		"order": [
			[ 0, "desc" ]
		],
		language: {
			"lengthMenu": "<?=Translator::translate("lengthMenu");?>",
	        "zeroRecords": "<?=Translator::translate("zeroRecords");?>",
	        "info": "<?=Translator::translate("info");?>",
	        "infoEmpty": "<?=Translator::translate("infoEmpty");?>",
	        "infoFiltered": "(<?=Translator::translate("infoFiltered");?>)",    
	        "loadingRecords": "<?=Translator::translate("loadingRecords");?>...",
	        "processing":     "<?=Translator::translate("processing");?>...",
	        "search":         "<?=Translator::translate("search");?>:",
	        "paginate": {
	          "first":      "<?=Translator::translate("first");?>",
	          "last":       "<?=Translator::translate("last");?>",
	          "next":       "<?=Translator::translate("next");?>",
	          "previous":   "<?=Translator::translate("previous");?>"
	        },
	    },
	});
</script>