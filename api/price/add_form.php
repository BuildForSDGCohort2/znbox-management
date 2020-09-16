<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\Supplier;
use controller\_StockSupplier;
use controller\Warehouse;
use controller\Stock;
use controller\StockCategory;
use controller\Helper;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die("user_session");
}
if(!isset($_GET["id"])) {
	die("404_request");
}
if(!$stock = Stock::getBy("id", $_GET["id"])) {
	die("404_request");   
}
?>
<form class="ui small modal form zn-form" action="<?=Helper::url("api/price/add.php")?>" data="<?=$stock["id"]?>">
	<i class="ui close icon"></i>
	<div class="header">
		<h3 class="ui header diviving color red"><i class="ui box icon"></i><?=Translator::translate("add price");?></h3>
	</div>
	<div class="scrolling content">
		<div class="ui field required">
			<label><?=Translator::translate("Price of sell");?>:</label>
			<input type="text" name="value[price_sell]" autocomplete="off" placeholder="<?=Translator::translate("Price of sell");?>">
		</div>
		<div class="ui field">
			<label><?=Translator::translate("observation");?>:</label>
			<textarea placeholder="<?=Translator::translate("observation");?>" name="value[observation]"></textarea>
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
		$(".dropdown").dropdown({
			on: "click"
		});
		$("form").form({
			on:"blur",
			inline:true,
			fields:{
				name:{
					identifier:"value[name]",
					rules:[{
						type:"empty",
						prompt:"{name} <?=Translator::translate("Please fill this field")?>"
					}]
				},
				price_sell:{
					identifier:"value[price_sell]",
					rules:[{
						type:"number",
						prompt:"{name} <?=Translator::translate("Inserted value must be a number")?>" 
					},{
						type:"empty",
						prompt:"{name} <?=Translator::translate("Please fill this field")?>"
					}]
				},
				price_purchase:{
					identifier:"value[price_purchase]",
					rules:[{
						type:"number",
						prompt:"{name} <?=Translator::translate("Inserted value must be a number")?>"
					},{
						type:"empty",
						prompt:"{name} <?=Translator::translate("Please fill this field")?>"
					}]
				},
				supplier:{
					identifier:"value[price_purchase]",
					rules:[{
						type:"empty",
						prompt:"{name} <?=Translator::translate("Please fill this field")?>"
					}]
				},
				quantity:{
					identifier:"value[quantity]",
					rules:[{
						type:"number",
						prompt:"{name} <?=Translator::translate("Inserted value must be a number")?>"
					},{
						type:"empty",
						prompt:"{name} <?=Translator::translate("Please fill this field")?>"
					}]
				}
			}
		});
	</script>
</form>