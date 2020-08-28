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
	<div class="ui dividing header large blue">
		<h3 class="ui header blue"><?=Translator::translate("New purchase")?></h3>
	</div>

	<form class="zn-form-complex ui form" action="purchase/add">
		<div class="ui form small">
			<div class="three fields">
				<div class="field required">
					<label><?=Translator::translate("description")?></label>
					<input type="text" name="description" required minlength="3" maxlength="100" placeholder="<?=Translator::translate("description")?>">
				</div>
				<div class="field required">
					<label><?=Translator::translate("purchase date")?></label>
					<input class="flatpickr" type="date" name="purchase_date" required>
				</div>
			</div>
		</div>
		<div>
			<table class="ui table inverted blue small zn-purchase-table">
				<thead>
					<th></th>
					<th><?=Translator::translate("Stock")?></th>
					<th><?=Translator::translate("Quantity")?></th>
					<th><?=Translator::translate("Price per unity")?></th>
					<th><?=Translator::translate("Price")?></th>
					<th><?=Translator::translate("Actions")?></th>
				</thead>
				<tbody></tbody>
				<tfoot>
					<th>
						<button class="ui button mini blue circular icon zn-puchase-table-add-line">
							<i class="ui plus icon"></i>
						</button>
					</th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tfoot>
			</table>
			<div class="ui form small">
				<div class="three fields">
					<div class="field">
						<label><?=Translator::translate("attachment")?></label>
						<input type="file" name="file">
					</div>
				</div>
			</div>
			<button type="submit" class="ui button blue"><?=Translator::translate("Submit")?></button>
			<button type="submit" href="purchase/purchase" class="ui button white zn-link"><?=Translator::translate("Cancel")?></button>
		</div>
	</form>
	<script type="text/javascript">
		$('.flatpickr').flatpickr({
			dateFormat: "Y-m-d",
			locale: "<?=$_COOKIE['lang']?>",
			altInput: true,
			altFormat: "F j, Y",
			defaultDate: "today",
			maxDate: "today",
		});
	</script>
</div>