<?php 
	require __DIR__."/../../autoload.php";

	use controller\Translator;
	use controller\User;
	use controller\UserType;

	use controller\Price;
	use controller\Supplier;
	use controller\_StockSupplier;
	use controller\Warehouse;
	use controller\Stock;
	use controller\StockType;
	use controller\Helper;

	if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
		die("user_session");
	}
?>

<div class="ui segment blue">
	<div class="uk-padding-small">
		<div class="ui header dividing color blue">
			<h3 class="ui header blue"><i class="ui box icon"></i> <?=Translator::translate('Stock')?></h3>
		</div>
		<a class="ui basic button blue zn-link-dialog" href="stock/add_form"><i class="ui plus icon"></i> <?=Translator::translate('Add Stock')?></a>

	</div>
	<div class="uk-margin">
		<div align="center" class="ui segment spacked purple uk-width-small">
			<div class="ui statistic purple">
			    <div class="value">
			      <?=Stock::getAll()->count?>
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
				<th><?=Translator::translate("Stock type");?></th>
				<th><?=Translator::translate("Quantity");?></th>
				<th><?=Translator::translate("Warehouse");?></th>
				<th><?=Translator::translate("Supplier");?></th>
				<th><?=Translator::translate("Date added")?></th>
				<th><?=Translator::translate("price of sale");?></th>
				<th><?=Translator::translate("Prices");?></th>
				<th><?=Translator::translate("Actions");?></th>
			</thead>
			<tbody>
				<?php foreach(Stock::getAll()->data as $item) { ?>
					<tr>
						<td>
							<label class="ui small orange basic ribbon label">
								<?=$item['id']?>
							</label>
						</td>
						<td><?=$item['name']?></td>
						<td>
							<?=Translator::translate(StockType::getBy('id', $item['type'])->first->name)?>
						</td>
						<td class="right aligned">
							<label class="ui mini label basic blue">
								<?=Stock::getStockAmount($item['id'])?>
							</label>
						</td>
						<td><?=Warehouse::getBy('id', $item['warehouse'])->first->name?></td>
						<td>
							<?php foreach(_StockSupplier::getAll()->data as $_item) { ?>
	                            <?php if($item['id'] == $_item['stock']) { ?>
	                                <a href="supplier/view" data-tooltip="<?=Translator::translate("view details")?>" class="ui mini icon basic label purple zn-link-dialog" data="<?=$_item['supplier']?>">
	                                    <?=Supplier::getBy('id', $_item['supplier'])->first->name?>
	                                </a>
	                            <?php } ?>
	                        <?php } ?>
						</td>
						<td><?=Helper::datetime($item['date_added'])?></td>
						<td class="center aligned">
							<?php $price = false; ?>

							<!-- Check if there is a default price -->
							<?php foreach(Price::getBy('stock', $item['id'])->data as $item_price) { ?>
								<?php if($item_price['isDefault']) { ?>
									<?php $price = $item_price['price_sell']; break; ?>
								<?php } ?>
							<?php } ?>
							<?php if($price) { ?>
								<!-- Rendering price result -->
								<label class="ui label mini blue">
									<?=$price?>
								</label>
							<?php } else { ?>
								<!-- No price found -->
								<label class="ui label mini red">
									<?=Translator::translate("No price")?>
								</label>
							<?php } ?>
							</td>
						<td>
							<a class="ui mini circular icon button blue zn-link" href="price/price" data-tooltip="<?=Translator::translate("Prices")?>" data="<?=$item['id']?>">
								<?=Translator::translate("Prices")?>
							</a>
						</td>
						<td>
							<a class="ui mini basic circular icon button blue zn-link-dialog" href="stock/view" data="<?=$item['id']?>" data-tooltip="<?=Translator::translate("view details")?>">
								<i class="ui eye icon"></i>
							</a>
							<a class="ui mini basic circular icon button green zn-link-dialog" href="stock/edit_form" data="<?=$item['id']?>" data-tooltip="<?=Translator::translate("edit details")?>">
								<i class="ui edit icon"></i>
							</a>
							<a class="ui mini basic circular icon button red zn-link-dialog" href="stock/delete_form" data="<?=$item['id']?>" data-tooltip="<?=Translator::translate("delete")?>">
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