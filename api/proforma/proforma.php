<?php

require __DIR__."/../../autoload.php";

use controller\Proforma;
use controller\Translator;
use controller\User;
use controller\Helper;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die("user_session");
}
?>
<div class="ui segment blue">
	<div class="uk-padding-small">
		<div class="ui header dividing color blue">
			<h3 class="ui header blue"><i class="ui cart icon"></i> <?=Translator::translate("proformas")?></h3>
		</div>
	</div>
	<div class="uk-margin">
		<div align="center" class="ui segment spacked purple uk-width-small">
			<div class="ui statistic purple">
			    <div class="value">
			    	<?=Proforma::getAll()->rowCount()?>
			    </div>
			    <div class="label">
			    	<?=Translator::translate("total")?>
			    </div>
			</div>
		</div>
	</div>
	<div class="uk-margin-top" style="margin-left: 10px;">
		<table class="ui small table color blue inverted selectable stripped">
			<thead>
				<th><?=Translator::translate("id");?></th>
				<th><?=Translator::translate("Document number");?></th>
				<th><?=Translator::translate("Invoice date");?></th>
				<th><?=Translator::translate("Invoice due date");?></th>
				<th><?=Translator::translate("Total");?></th>
				<th><?=Translator::translate("Actions");?></th>
			</thead>
			<tbody>
				<?php foreach(Proforma::getAll() as $item) { ?>
					<tr>
						<td>
							<label class="ui small orange ribbon label">
								<?=$item["id"]?>
							</label>
						</td>
						<td>
							<?=$item["number"]."/".date("Y", strtotime($item["date_emitted"]))?>
						</td>
						<td>
							<?=Helper::date($item["date_emitted"])?>
						</td>
						<td>
							<?=Helper::date($item["date_due"])?>		
						</td>
						<td>
							<label class="ui label mini blue">
								<?=Helper::formatNumber(Proforma::getTotal($item["id"]))?>
							</label>		
						</td>
						<td>
							<a class="ui mini circular icon button purple zn-link-print" data-href="<?=Helper::url("print-proforma?type=1&id=".$item["sale"])?>">
				                <i class="file alternate icon"></i>
				                <?=Translator::translate("Print proforma")?>
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
