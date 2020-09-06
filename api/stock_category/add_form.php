<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\StockCategory;
use controller\Helper;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
    die("user_session");
}
?>
<form class="ui small modal form zn-form" action="<?=Helper::url("api/stock_category/add.php")?>">
	<div class="header">
		<h3 class="ui header diviving color red"><i class="ui list icon"></i><?=Translator::translate("add category");?></h3>
	</div>
	<div class="scrolling content">
		<div class="ui field required">
			<label><?=Translator::translate("Name");?>:</label>
			<input type="text" name="value[name]" placeholder="<?=Translator::translate("Name");?>">
		</div>
		<div class="ui field">
			<label><?=Translator::translate("Observation");?>:</label>
			<textarea placeholder="<?=Translator::translate("Observation");?>" name="value[observation]"></textarea>
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
				}
			}
		});
	</script>
</form>