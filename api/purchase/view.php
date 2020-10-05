<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\Stock;
use controller\Purchase;
use controller\PurchaseItem;
use controller\Resources;
use controller\Helper;
use controller\Supplier;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
    die("user_session");
}
if(!isset($_GET["id"])) {
    die("404_request");
}
if(!$fetch = Purchase::getBy("id", $_GET["id"])) {
    die("404_request");   
}
?>
<div class="ui modal tiny">
    <i class="close icon"></i>
	<div class="header">
		<h3 class="ui header diviving color red"><i class="ui cart icon"></i><?=Translator::translate("Purchase");?></h3>
	</div>
	<div class="scrolling content">
		<table class="ui small table selectable celled striped">
			<thead></thead>
			<tbody>
                <tr>
                    <td><strong><?=Translator::translate("Id");?>:</strong></td>
                    <td colspan="2"><?=$fetch["id"]?></td>
                </tr>
                <tr>
                    <td><strong><?=Translator::translate("Supplier");?>:</strong></td>
                    <td colspan="2"><?=($fetch["supplier"] ? Supplier::getBy("id", $fetch["supplier"])["name"] : "")?></td>
                </tr>
                <tr>
                    <td><strong><?=Translator::translate("description");?>:</strong></td>
                    <td colspan="2"><?=$fetch["description"];?></td>
                </tr>
                <tr>
                    <td>
                        <strong><?=Translator::translate("Attachment");?>:</strong>
                    </td>
                    <td colspan="2">
                        <?php if($fetch["file"] != "") { ?>
                            <a href="<?=Resources::stream("docs/".$fetch["file"])?>" target="_blank" data-tooltip="<?=Translator::translate("download file");?>" class="ui basic button color purple tiny circular icon"><i class="ui download icon"></i></a>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td><strong><?=Translator::translate("Purchase date");?>:</strong></td>
                    <td colspan="2"><?= Helper::date($fetch["purchase_date"]); ?></td>
                </tr>
                <tr class="center aligned">
                    <td colspan="3" class="active">
                        <strong><?=Translator::translate("Itens");?></strong>
                    </td>
                </tr>
                <tr>
                    <td class="active">
                        <strong><?=Translator::translate("Stock");?></strong>
                    </td>
                    <td class="active">
                        <strong><?=Translator::translate("Quantity");?></strong>
                    </td>
                    <td class="active">
                        <strong><?=Translator::translate("Price per unity");?></strong>
                    </td>
                </tr>
                <?php foreach(PurchaseItem::getAllBy("purchase", $fetch["id"]) as $item): ?>
                <tr>
                    <td><?=Stock::getBy("id", $item["stock"])["name"]?></td>
                    <td class="right aligned"><?=$item["quantity"]?></td>
                    <td class="right aligned">
                        <label class="ui label blue mini">
                            <?=Helper::formatnumber($item["price_unity"])?>
                        </label>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td><strong><?=Translator::translate("Date Added");?>:</strong></td>
                    <td colspan="2"><?=Helper::datetime($fetch["date_added"])?></td>
                </tr>
                <tr>
                    <td><strong><?=Translator::translate("User Added");?>:</strong></td>
                    <td colspan="2"><?=User::getBy("id", $fetch["user_added"])["username"]?></td>
                </tr>
                <tr>
                    <td><strong><?=Translator::translate("Date Modify");?>:</strong></td>
                    <td colspan="2"><?=Helper::datetime($fetch["date_modify"])?></td>
                </tr>
                <tr>
                    <td><strong><?=Translator::translate("User Modify");?>:</strong></td>
                    <td colspan="2"><?=User::getBy("id", $fetch["user_modify"])["username"]?></td>
                </tr>
                <tr>
                    <td><strong><?=Translator::translate("Observation");?>:</strong></td>
                    <td colspan="2"><?=nl2br($fetch["observation"])?></td>
                </tr>
            </tbody>
		</table>
	</div>
	<div class="actions stackable">
        <div class="ui negative labeled icon button mini">
            <?=Translator::translate("close")?>
            <i class="close inverted icon"></i>
        </div>
	</div>
</div>