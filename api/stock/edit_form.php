<?php 
	require __DIR__."/../../autoload.php";

	use controller\Translator;
	use controller\User;
	use controller\Supplier;
	use controller\_StockSupplier;
	use controller\Warehouse;
	use controller\Stock;
	use controller\StockType;
	use controller\StockCategory;
	use controller\Helper;

	if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
		die("user_session");
	}
	if(!isset($_GET["id"])) {
		die("404_request");
	}
	if(!$fetch = Stock::getBy("id", $_GET["id"])) {
		die("404_request");   
	}
?>

<form class="ui small modal form zn-form-update" action="<?=Helper::url("api/stock/edit.php")?>" data="<?=$_GET["id"]?>">
	<div class="header">
		<h3 class="ui header diviving color red"><i class="ui box icon"></i><?=Translator::translate("edit stock");?></h3>
	</div>
	<div class="scrolling content">
		<div class="ui field required">
			<label><?=Translator::translate("Name");?>:</label>
			<input type="text" value="<?=$fetch["name"]?>" name="value[name]" autocomplete="off" placeholder="<?=Translator::translate("Name");?>">
		</div>
		<div class="ui field required">
			<label><?=Translator::translate("Stock type");?>:</label>
			<select class="ui dropdown search" name="value[type]">
				<?php foreach (StockType::getAll() as $item) { ?>
				<option <?=($fetch["type"] == $item["id"]) ? "selected" : ""?> value="<?=$item["id"]?>"><?=Translator::translate($item["name"])?></option>
				<?php } ?>
			</select>
		</div>
		<div class="ui field required">
			<label><?=Translator::translate("Quantity");?>:</label>
			<input type="text" value="<?=$fetch["quantity"]?>" name="value[quantity]" autocomplete="off" placeholder="<?=Translator::translate("Quantity");?>">
		</div>
		<div class="ui field required">
			<label><?=Translator::translate("Category");?>:</label>
			<select class="ui dropdown search" name="value[category]">
				<?php foreach (StockCategory::getAll() as $item) { ?>
				<option <?=($fetch["category"] == $item["id"]) ? "selected" : ""?> value="<?=$item["id"]?>"><?=$item["name"]?></option>
				<?php } ?>
			</select>
		</div>
		<div class="ui field required">
			<label><?=Translator::translate("Supplier");?>:</label>
			<select class="ui dropdown multiple search" multiple name="supplier[]">
				<?php foreach (Supplier::getAll() as $item) { ?>
					<?php $found = false; ?>
					<?php foreach (_StockSupplier::getAllBy("stock", $fetch["id"]) as $_item) { ?>
						<?php if($_item["supplier"] == $item["id"]) { ?>
							<?php $found = true; ?>
							<option <?=(($found) ? "selected" : "")?> value="<?=$item["id"]?>"><?=$item["name"]?></option>
						<?php } ?>
					<?php } ?>
					<?php if(!$found) { ?>
						<option value="<?=$item["id"]?>"><?=$item["name"]?></option>
					<?php } ?>
				<?php } ?>
			</select>
		</div>
		<div class="ui field required">
			<label><?=Translator::translate("Warehouse");?>:</label>
			<select class="ui dropdown search" name="value[warehouse]">
				<?php foreach (Warehouse::getAll() as $item) { ?>
				<option <?=($fetch["warehouse"] == $item["id"]) ? "selected" : ""?> value="<?=$item["id"]?>"><?=$item["name"]?></option>
				<?php } ?>
			</select>
		</div>
		<div class="ui field">
			<label><?=Translator::translate("Description");?>:</label>
			<textarea placeholder="<?=Translator::translate("Description");?>" name="value[description]"><?=nl2br($fetch["description"])?></textarea>
		</div>
	</div>
	<div class="actions stackable">
		<button class="ui primary labeled icon button mini" type="submit">
            <?=Translator::translate("save");?>
            <i class="checkmark inverted icon"></i>
        </button>
        <div class="ui negative labeled icon button mini">
            <?=Translator::translate("cancel");?>
            <i class="close inverted icon"></i>
        </div>
	</div>
	<script type="text/javascript">
		$(".dropdown").dropdown({
			on : "click"
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