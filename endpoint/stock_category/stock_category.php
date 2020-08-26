<?php 
	require __DIR__."/../../autoload.php";

	use controller\Translator;
	use controller\User;

	use controller\StockCategory;
	use controller\Helper;

	if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
		die("user_session");
	}
?>

<div class="ui segment blue">
	<div class="uk-padding-small">
		<div class="ui header dividing color blue">
			<h3 class="ui header blue"><i class="ui list icon"></i> <?=Translator::translate('category')?></h3>
		</div>
		<a class="ui basic button blue zn-link-dialog" href="stock_category/add_form"><i class="ui plus icon"></i> <?=Translator::translate('Add category')?></a>

	</div>
	<div class="uk-margin">
		<div align="center" class="ui segment spacked purple uk-width-small">
			<div class="ui statistic purple">
			    <div class="value">
			      <?=StockCategory::getAll()->count?>
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
				<th><?=Translator::translate("name");?></th>
				<th><?=Translator::translate("date added");?></th>
				<th><?=Translator::translate("Actions");?></th>
			</thead>
			<tbody>
				<?php foreach(StockCategory::getAll()->data as $item) { ?>
					<tr>
						<td>
							<label class="ui small orange basic ribbon label">
								<?=$item['id']?>
							</label>
						</td>
						<td><?=$item['name']?></td>
						<td><?=Helper::datetime($item['date_added'])?></td>
						<td>
							<a class="ui mini basic circular icon button blue zn-link-dialog" href="stock_category/view" data="<?=$item['id']?>" data-tooltip="<?=Translator::translate("view details")?>">
								<i class="ui eye icon"></i>
							</a>
							<a class="ui mini basic circular icon button green zn-link-dialog" href="stock_category/edit_form" data="<?=$item['id']?>" data-tooltip="<?=Translator::translate("edit details")?>">
								<i class="ui edit icon"></i>
							</a>
							<a class="ui mini basic circular icon button red zn-link-dialog" href="stock_category/delete_form" data="<?=$item['id']?>" data-tooltip="<?=Translator::translate("delete")?>">
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