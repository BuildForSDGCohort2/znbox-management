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
<form class="ui small modal form zn-form-update" action="<?=Helper::url("api/stock/edit.php?id=".$_GET["id"])?>">
	<div class="header">
		<h3 class="ui header diviving color red"><i class="truck icon"></i><?=Translator::translate("Transfer stock");?></h3>
	</div>
	<div class="scrolling content">
		<div class="field required">
			<label><?=Translator::translate("Quantity")." (".Translator::translate("Available stock").": ".Stock::getStockAmount($fetch["id"]).")"?>:</label>
			<input name="quantity" type="number" placeholder="<?=Translator::translate("Quantity");?>">
		</div>
		<div class="ui field required">
			<label><?=Translator::translate("Transfer from");?>:</label>
			<select class="ui dropdown search" name="warehouse_from">
				<?php foreach (Warehouse::getAll() as $item): ?>
					<?php # Still working on it ?>
					<?php if($item["id"] == $item["id"]): ?>
						<option value="<?=$item["id"]?>"><?=$item["name"]?></option>
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="ui field required">
			<label><?=Translator::translate("Transfer to");?>:</label>
			<select class="ui dropdown search" name="warehouse_to">
				<?php foreach (Warehouse::getAll() as $item): ?>
					<?php # Still working on it ?>
					<?php if($item["id"] == $item["id"]): ?>
						<option value="<?=$item["id"]?>"><?=$item["name"]?></option>
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="ui field">
			<label><?=Translator::translate("Observation");?>:</label>
			<textarea placeholder="<?=Translator::translate("Observation");?>" name="observation"></textarea>
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
		$("form").form({
			on:"blur",
			inline:true,
			fields:{
				quantity:{
					identifier:"quantity",
					rules:[{
						type:"number",
						prompt:"<?=Translator::translate("Inserted value must be a number")?>"
					},{
						type:"empty",
						prompt:"<?=Translator::translate("Please fill this field")?>"
					}]
				},
				warehouse:{
					identifier:"warehouse",
					rules:[{
						type:"empty",
						prompt:"{name} <?=Translator::translate("Please fill this field")?>"
					}]
				},
			}
		});
		$(".dropdown").dropdown({
			on : "click"
		});
	</script>
</form>