<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\Stock;
use controller\Sale;
use controller\Invoice;
use controller\Proforma;
use controller\SaleStock;
use controller\Customer;
use controller\Warehouse;
use controller\Helper;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
    die("user_session");
}
if(!isset($_GET["id"])) {
    die("404_request");
}
if(!$fetch = Sale::getBy("id", $_GET["id"])) {
    die("404_request");   
}
?>
<div class="ui segment raised blue">
	<h1 class="ui header small blue dividing">
		<i class="handshake icon"></i> Sale number: <label class="ui label tiny orange"><?=$fetch["id"];?></label>
	</h1>
	<div class="ui grid stackable">
		<div class="eight wide column">
			<table class="ui small table selectable celled striped">
				<thead></thead>
				<tbody>
	                <tr>
	                    <td>
	                        <strong><?=Translator::translate("Order");?>:</strong>
	                    </td>
	                    <td colspan="3"><?=Helper::toRef($fetch["id"])?></td>
	                </tr>
	                <tr>
	                    <td>
	                        <strong><?=Translator::translate("Customer");?>:</strong>
	                    </td>
	                    <td colspan="3"><?=Customer::getBy("id", $fetch["customer"])["name"]?></td>
	                </tr>
	                <tr class="center aligned">
	                    <td colspan="4" class="active">
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
	                    <td class="active">
	                        <strong><?=Translator::translate("Warehouse");?></strong>
	                    </td>
	                </tr>
	                <?php foreach(SaleStock::getAllBy("sale", $fetch["id"]) as $item): ?>
	                <tr>
	                    <td><?=Stock::getBy("id", $item["stock"])["name"]?></td>
	                    <td class="right aligned"><?=$item["quantity"]?></td>
	                    <td class="right aligned">
	                        <label class="ui label blue mini">
	                            <?=Helper::formatnumber($item["price_sale"])?>
	                        </label>
	                    </td>
	                    <td>
	                    	<?=Warehouse::getBy("id", $item["warehouse"])["name"]?>
	                    </td>
	                </tr>
	                <?php endforeach; ?>
	                <tr>
	                    <td>
	                        <strong><?=Translator::translate("Value");?>:</strong>
	                    </td>
	                    <td colspan="3">
	                        <label class="ui label blue mini">
	                            <?=Helper::formatnumber(Sale::getTotal($fetch["id"]))?>
	                        </label>
	                    </td>
	                </tr>
	                <tr>
	                    <td>
	                        <strong><?=Translator::translate("Date Added");?>:</strong>
	                    </td>
	                    <td colspan="3"><?=Helper::datetime($fetch["date_added"])?></td>
	                </tr>
	                <tr>
	                    <td>
	                        <strong><?=Translator::translate("User Added");?>:</strong>
	                    </td>
	                    <td colspan="3"><?=User::getBy("id", $fetch["user_added"])["username"]?></td>
	                </tr>
	                <tr>
	                    <td>
	                        <strong><?=Translator::translate("Date Modify");?>:</strong>
	                    </td>
	                    <td colspan="3"><?=Helper::datetime($fetch["date_modify"])?></td>
	                </tr>
	                <tr>
	                    <td>
	                        <strong><?=Translator::translate("User Modify");?>:</strong>
	                    </td>
	                    <td colspan="3"><?=User::getBy("id", $fetch["user_modify"])["username"]?></td>
	                </tr>
	                <tr>
	                    <td>
	                        <strong><?=Translator::translate("Observation");?>:</strong>
	                    </td>
	                    <td colspan="3"><?=nl2br($fetch["observation"])?></td>
	                </tr>
	            </tbody>
			</table>
		</div>
		<div class="eight wide column">
			Hello2
		</div>
	</div>
</div>