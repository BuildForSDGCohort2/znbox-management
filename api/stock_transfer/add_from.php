<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\Warehouse;
use controller\Helper;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
    die("user_session");
}
?>
<form class="ui small modal form zn-form" action="<?=Helper::url("api/stock_transfer/add_from_redirect.php")?>">
	<div class="header">
		<h3 class="ui header diviving color red"><i class="truck icon"></i><?=Translator::translate("Transfer stock");?></h3>
	</div>
	<div class="scrolling content">
		<div class="ui field required">
			<label><?=Translator::translate("Transfer from");?>:</label>
			<select class="ui dropdown search" name="from" placeholder="<?=Translator::translate("From");?>">
				<?php foreach (Warehouse::getAll() as $item): ?>
					<option value="<?=$item["id"]?>"><?=$item["name"]?></option>
				<?php endforeach ?>
			</select>
		</div>
	</div>
	<div class="actions stackable">
		<button class="ui success labeled icon button mini" type="submit">
            <?=Translator::translate("Next");?>
            <i class="arrow right icon"></i>
        </button>
        <div class="ui negative labeled icon button mini">
            <?=Translator::translate("cancel");?>
            <i class="close inverted icon"></i>
        </div>
	</div>
	<script type="text/javascript">
		$(".ui.dropdown").dropdown({ on: "click" });
	</script>
</form>