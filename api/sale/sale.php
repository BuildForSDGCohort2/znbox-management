<?php 
	require __DIR__."/../../autoload.php";

	use controller\Translator;
	use controller\User;
	use controller\UserType;

	use controller\Price;
	use controller\Stock;
	use controller\Sale;
	use controller\Customer;
	use controller\Invoice;
	use controller\Proforma;
	use controller\Helper;

	if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
		die("user_session");
	}

?>

<div class="ui segment blue">
	<div class="uk-padding-small">
		<div class="ui header dividing color blue">
			<h3 class="ui header blue"><i class="ui handshake icon"></i> <?=Translator::translate('Sales')?></h3>
		</div>
		<a class="ui basic small button blue zn-link" href="sale/add_form"><i class="ui plus icon"></i> <?=Translator::translate('New Sale')?></a>

	</div>
	<div class="uk-margin-top" style="margin-left: 10px;">
		<table class="ui small table color blue selectable stripped">
			<thead>
				<th><?=Translator::translate("Order");?></th>
				<th><?=Translator::translate("Customer");?></th>
				<th><?=Translator::translate("Date added");?></th>
				<th><?=Translator::translate("Total");?></th>
				<th><?=Translator::translate("Discount");?></th>
				<th><?=Translator::translate("Total (vat included)");?></th>
				<th><?=Translator::translate("Actions");?></th>
			</thead>
			<tbody>
				<?php foreach(Sale::getAll()->data as $item): ?>
					<tr>
						<td>
							<label class="ui small orange basic ribbon label">
								<?=Helper::toRef($item['id'])?>
							</label>	
						</td>
						<td><?=Customer::getBy('id', $item['customer'])->first->name?></td>
						<td><?=Helper::datetime($item['date_added'])?></td>
						<td>
							<label class="ui label blue mini">
								<?=Helper::formatnumber(Sale::getTotal($item['id']))?>
							</label>
						</td>
						<td>
							<label class="ui label blue mini">
								<?=Helper::formatnumber(Sale::getTotalDiscount($item['id']))?>
							</label>
						</td>
						<td>
							<label class="ui label blue mini">
								<?=Helper::formatnumber(Sale::getTotal($item['id'], true))?>
							</label>
						</td>
						<td>
							<a class="ui mini basic circular icon button blue zn-link-dialog" href="sale/view" data="<?=$item['id']?>" data-html="<?=Translator::translate("view details")?>">
								<i class="ui eye icon"></i>
							</a>
							<div class="ui popup">
								<div class="header">User Rating</div>
								<div class="ui star rating" data-rating="3"></div>
							</div>
							<?php $invoice = Invoice::getBy('sale', $item['id'])->first; ?>
							<?php $proforma = Proforma::getBy('sale', $item['id'])->first; ?>
							<?php if((!$invoice && !$proforma) || (($invoice && $invoice->status == 0) && ($invoice && $proforma->status == 0))): ?>
							<a class="ui mini basic circular icon button green zn-link" href="sale/edit_form" data="<?=$item['id']?>" data-tooltip="<?=Translator::translate("edit details")?>">
								<i class="ui edit icon"></i>
							</a>
							<a class="ui mini basic circular icon button red zn-link-dialog" href="sale/delete_form" data="<?=$item['id']?>" data-tooltip="<?=Translator::translate("delete")?>">
								<i class="ui trash alternate icon"></i>
							</a>
							<a class="ui primary mini basic circular icon button zn-link-dialog" href="sale/confirm_generate_invoice" data="<?=$item['id']?>">
				                <i class="file alternate icon"></i>
				                <?=Translator::translate('Generate invoice')?>
				            </a>
				            <a class="ui primary mini basic circular icon button zn-link-dialog" href="sale/confirm_generate_proforma" data="<?=$item['id']?>">
				                <i class="file alternate icon"></i>
				                <?=Translator::translate('Generate proforma')?>
				            </a>
							<?php else: ?>
								<?php if($invoice && $invoice->status != 0): ?>
						            <a class="ui mini basic circular icon button purple zn-link-print" data-href="print-invoice?type=1&id=<?=$item['id']?>">
						                <i class="file alternate icon"></i>
						                <?=Translator::translate('Print invoice')?>
						            </a>
					            <?php else: ?>
					            	<a class="ui primary mini basic circular icon button zn-link-dialog" href="sale/confirm_generate_invoice" data="<?=$item['id']?>">
						                <i class="file alternate icon"></i>
						                <?=Translator::translate('Generate invoice')?>
						            </a>
					            <?php endif; ?>
					            <?php if($proforma && $proforma->status != 0): ?>
						            <a class="ui mini basic circular icon button purple zn-link-print" data-href="print-proforma?type=1&id=<?=$item['id']?>">
						                <i class="file alternate icon"></i>
						                <?=Translator::translate('Print proforma')?>
						            </a>
					            <?php else: ?>
					            	<a class="ui primary mini basic circular icon button zn-link-dialog" href="sale/confirm_generate_proforma" data="<?=$item['id']?>">
						                <i class="file alternate icon"></i>
						                <?=Translator::translate('Generate proforma')?>
						            </a>
					            <?php endif; ?>
					        <?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$('.ui.dropdown').dropdown();
	$('.popup').popup();
	if ($.fn.DataTable.isDataTable('.ui.table')) {
	    $('.ui.table').dataTable().fnDestroy();
	    $('.ui.table').empty(); 
	}
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