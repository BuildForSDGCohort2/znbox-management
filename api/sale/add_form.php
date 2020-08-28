<?php 
	require __DIR__."/../../autoload.php";

	use controller\Translator;
	use controller\User;
	use controller\Helper;
	use controller\Stock;
	use controller\Customer;

	if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
		die("user_session");
	}
?>

<div class="ui segment">
	<div class="ui dividing header large blue">
		<h3><?=Translator::translate("New sale")?></h3>
	</div>

	<form class="zn-form" action="sale/add">
		<div class="uk-margin-large-top">
			<div class="ui form">
				<div class="four fields">
					<div class="field">
						<label><?=Translator::translate("customer")?></label>
						<select class="ui dropdown search" required name="customer">
							<?php foreach(Customer::getAll()->data as $item): ?>
							<option value="<?=$item["id"]?>">
								<?=$item["name"]?>
							</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="field">
						<label><?=Translator::translate("discount type")?></label>
						<select class="ui dropdown" required name="discount_type">
							<option value="1">
								<?=Translator::translate("Percentage")?>
							</option>
							<option value="2">
								<?=Translator::translate("Value")?>
							</option>
						</select>
					</div>
					<div class="field">
						<label><?=Translator::translate("discount")?></label>
						<input 
							type="number" 
							name="discount"
							required
							placeholder="<?=Translator::translate("discount")?>"
						>
					</div>
				</div>
			</div>
		</div>

		<div>
			<table class="ui table inverted blue small stock-table">
				<thead>
					<th></th>
					<th><?=Translator::translate("stock")?></th>
					<th><?=Translator::translate("Available stock")?></th>
					<th><?=Translator::translate("Quantity")?></th>
					<th><?=Translator::translate("Price per unity")?></th>
					<th><?=Translator::translate("Price")?></th>
					<th><?=Translator::translate("Actions")?></th>
				</thead>
				<tbody>
					
				</tbody>
				<tfoot>
					<th>
						<button class="ui button mini blue circular icon stock-table-add-line">
							<i class="ui plus icon"></i>
						</button>
					</th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tfoot>
			</table>
			<div>
				<div class="ui grid stackable">
					<div class="ten wide column">
						
					</div>
					<div class="six wide column">
						<table class="ui table inverted blue stripped small">
							<thead>
								<th></th>
								<th></th>
							</thead>
							<tbody>
								<tr>
									<td><?=Translator::translate("Sub total")?></td>
									<td class="right aligned">
										<label class="ui basic label small stock-table-subtotal">0</label>
									</td>
								</tr>
								<tr>
									<td><?=Translator::translate("vat")?></td>
									<td class="right aligned">
										<label class="ui basic label small stock-table-vat">0</label>
									</td>
								</tr>
								<tr>
									<td><?=Translator::translate("total (vat included)")?></td>
									<td class="right aligned">
										<label class="ui basic label small stock-table-total-vat">0</label>
									</td>
								</tr>
							</tbody>
						</table>	
					</div>
				</div>
			</div>
			<button type="submit" class="ui button blue"><?=Translator::translate("Submit")?></button>
			<button type="submit" href="sale/sale" class="ui button white zn-link"><?=Translator::translate("Cancel")?></button>
		</div>
	</form>
	<script type="text/javascript">
		$('.ui.dropdown').dropdown();
	</script>
</div>