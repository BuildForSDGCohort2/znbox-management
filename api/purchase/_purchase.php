<?php 
	require __DIR__."/../../autoload.php";

	use controller\Translator;
	use controller\Stock;
	use controller\User;

	use controller\Purchase;
	use controller\Helper;

	if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
		die("user_session");
	}
?>

<div class="ui segment blue">
	<div class="uk-padding-small">
		<div class="ui header dividing color blue">
			<h3 class="ui header blue"><i class="ui cart icon"></i> <?=Translator::translate('purchase')?></h3>
		</div>
		<a class="ui basic button blue zn-link-dialog" href="purchase/add_form"><i class="ui plus icon"></i> <?=Translator::translate('Add purchase')?></a>

	</div>
	<div class="uk-margin">
		<div align="center" class="ui segment spacked purple uk-width-small">
			<div class="ui statistic purple">
			    <div class="value">
			      <?=Purchase::getAll()->count?>
			    </div>
			    <div class="label">
			      <?=Translator::translate("total")?>
			    </div>
			</div>
		</div>
	</div>
	<div class="uk-margin-top" style="margin-left: 10px;">
		<table class="ui small table color blue selectable stripped">
			<thead>
				<th><?=Translator::translate("Id");?></th>
				<th><?=Translator::translate("short description");?></th>
				<th><?=Translator::translate("value");?></th>
				<th><?=Translator::translate("quantity");?></th>
				<th><?=Translator::translate("purchase date");?></th>
				<th><?=Translator::translate("Stock");?></th>
				<th><?=Translator::translate("date added");?></th>
				<th><?=Translator::translate("Actions");?></th>
			</thead>
			<tbody>
				<?php foreach(Purchase::getAll()->data as $item) { ?>
					<tr>
						<td>
							<label class="ui small orange basic ribbon label">
								<?=$item['id']?>
							</label>
						</td>
						<td><?=$item['name']?></td>
						<td class="right aligned">
							<label class="ui label blue mini">
								<?=Helper::formatnumber($item['value'])?>
							</label>		
						</td>
						<td class="right aligned">
							<label class="ui basic label mini blue">
								<?=$item['quantity']?>
							</label>		
						</td>
						<td><?=Helper::datetime($item['purchase_date'])?></td>
						<td>
							<a class="ui basic mini label purple zn-link-dialog" href="stock/view" data="<?=$item['stock']?>" data-tooltip="<?=Translator::translate("view details")?>">
								<?=Stock::getBy('id', $item['stock'])->first->name?>	
							</a>
						</td>
						<td><?=Helper::datetime($item['date_added'])?></td>
						<td>
							<a class="ui mini basic circular icon button blue zn-link-dialog" href="purchase/view" data="<?=$item['id']?>" data-tooltip="<?=Translator::translate("view details")?>">
								<i class="ui eye icon"></i>
							</a>
							<a class="ui mini basic circular icon button green zn-link-dialog" href="purchase/edit_form" data="<?=$item['id']?>" data-tooltip="<?=Translator::translate("edit details")?>">
								<i class="ui edit icon"></i>
							</a>
							<a class="ui mini basic circular icon button red zn-link-dialog" href="purchase/delete_form" data="<?=$item['id']?>" data-tooltip="<?=Translator::translate("delete")?>">
								<i class="ui trash alternate icon"></i>
							</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$('.ui.dropdown').dropdown();
	$('.ui.table').DataTable({
		//dom: 'lBfrtip',
		"bDestroy": true,
		"order": [
			[ 0, 'desc' ]
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