<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\Supplier;
use controller\Warehouse;
use controller\Stock;
use controller\StockType;
use controller\StockCategory;
use controller\Helper;
use controller\PaymentMethod;
use controller\Invoice;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die("user_session");
}
?>
<form class="ui small modal form zn-form" action="<?=Helper::url("api/receipt/add.php")?>">
	<i class="ui close icon"></i>
	<div class="header">
		<h3 class="ui header diviving color red"><i class="ui box icon"></i><?=Translator::translate("Create receipt");?></h3>
	</div>
	<div class="scrolling content">
		<div class="ui field required">
			<label><?=Translator::translate("Invoice");?>:</label>
			<select class="ui dropdown search" name="value[invoice]">
				<?php foreach (Invoice::getAllUnpaid() as $item) { ?>
				<option value="<?=$item["id"]?>"><?=$item["number"]."/".date("Y", strtotime($item["date_emitted"]))?></option>
				<?php } ?>
			</select>
		</div>
		<div class="ui field required">
			<label><?=Translator::translate("Payment method");?>:</label>
			<select class="ui dropdown search" name="value[payment_method]">
				<?php foreach (PaymentMethod::getAll() as $item) { ?>
				<option value="<?=$item["id"]?>"><?=$item["name"]?></option>
				<?php } ?>
			</select>
		</div>
		<div class="ui field">
			<label><?=Translator::translate("payment date");?>:</label>
			<input type="date" name="value[date_payment]" value="<?=date("Y-m-d")?>" class="flatpickr">
		</div>
		<div class="ui field">
			<label><?=Translator::translate("Description");?>:</label>
			<textarea placeholder="<?=Translator::translate("Description");?>" name="value[description]"></textarea>
		</div>
	</div>
	<div class="actions stackable">
		<button class="ui primary labeled icon button mini" type="submit">
            <?=Translator::translate("add");?>
            <i class="checkmark inverted icon"></i>
        </button>
        <div class="ui negative labeled icon button mini">
            <?=Translator::translate("cancel");?>
            <i class="close inverted icon"></i>
        </div>
	</div>
	<script type="text/javascript">
		$(".dropdown").dropdown({ on : "click" });
		$(".flatpickr").flatpickr({
            dateFormat: "Y-m-d",
            locale: "<?=$_COOKIE["lang"]?>",
            altInput: true,
            altFormat: "F j, Y",
        });
		$("form").form({
			on:"blur",
			inline:true,
			fields:{
				invoice:{
					identifier:"value[invoice]",
					rules:[{
						type:"empty",
						prompt:"{name} <?=Translator::translate("Please fill this field")?>"
					}]
				},
			}
		});
	</script>
</form>