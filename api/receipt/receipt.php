<?php

require __DIR__."/../../autoload.php";

use controller\Invoice;
use controller\Receipt;
use controller\Translator;
use controller\User;
use controller\Helper;
use controller\PaymentMethod;


if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die("user_session");
}
?>
<div class="ui segment blue">
	<div class="uk-padding-small">
		<div class="ui header dividing color blue">
			<h3 class="ui header blue"><i class="file alternate icon"></i> <?=Translator::translate("Receipts")?></h3>
		</div>
		<a class="ui basic button blue zn-link-dialog" href="<?=Helper::url("api/receipt/add_form.php")?>">
			<i class="ui plus icon"></i> <?=Translator::translate("Create Receipt")?>
		</a>
	</div>
	<div class="uk-margin-top" style="margin-left: 10px;">
		<table class="ui small table color blue inverted selectable stripped">
			<thead>
				<th><?=Translator::translate("id");?></th>
				<th><?=Translator::translate("Document number");?></th>
				<th><?=Translator::translate("Payment date");?></th>
				<th><?=Translator::translate("payment method");?></th>
				<th><?=Translator::translate("Total");?></th>
				<th><?=Translator::translate("Actions");?></th>
			</thead>
			<tbody>
				<?php foreach(Receipt::getAll() as $item) { ?>
					<tr>
						<td>
							<label class="ui small orange ribbon label">
								<?=$item["id"]?>
							</label>
						</td>
						<td>
							<?=$item["number"]."/".date("Y", strtotime($item["date_payment"]))?>
						</td>
						<td>
							<?=Helper::date($item["date_payment"])?>
						</td>
						<td>
							<?=PaymentMethod::getBy("id", $item["payment_method"])["name"]?>		
						</td>
						<td>
							<label class="ui label mini blue">
								<?=Helper::formatNumber(Invoice::getTotal($item["invoice"]))?>
							</label>		
						</td>
						<td>
							<a class="ui mini circular icon button purple zn-link-print" data-href="<?=Helper::url("print-receipt?type=1&id=".$item["id"])?>">
				                <i class="file alternate icon"></i>
				                <?=Translator::translate("Print Receipt")?>
				            </a>
						</td>
					</tr>
				<?php } ?>
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
