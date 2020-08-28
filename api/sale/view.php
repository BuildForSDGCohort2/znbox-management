<?php 
    require __DIR__."/../../autoload.php";

    use controller\Translator;
    use controller\User;
    use controller\UserType;
    use controller\Stock;

    use controller\Sale;
    use controller\Invoice;
    use controller\Proforma;
    use controller\SaleStock;
    use controller\Customer;
    use controller\Helper;

    if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
        die("user_session");
    }

    if(!isset($_GET['id'])) {
        die("404_request");
    }

    if(!$fetch = Sale::getBy('id', $_GET['id'])->first) {
        die("404_request");   
    }

    $fetch = (array) $fetch;
?>

<div class="ui modal tiny">
    <i class="ui close icon"></i>
	<div class="header">
		<h3 class="ui header diviving color red"><i class="ui handshake icon"></i><?=Translator::translate("Sale");?></h3>
	</div>
	<div class="scrolling content">
		<table class="ui small table selectable celled striped">
			<thead></thead>
			<tbody>
                <tr>
                    <td>
                        <strong><?=Translator::translate("Order");?>:</strong>
                    </td>
                    <td colspan="2"><?=Helper::toRef($fetch["id"])?></td>
                </tr>
                <tr>
                    <td>
                        <strong><?=Translator::translate("Customer");?>:</strong>
                    </td>
                    <td colspan="2"><?=Customer::getBy('id', $fetch["customer"])->first->name?></td>
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
                <?php foreach(SaleStock::getBy('sale', $fetch['id'])->data as $item): ?>
                <tr>
                    <td><?=Stock::getBy('id', $item['stock'])->first->name?></td>
                    <td class="right aligned"><?=$item['quantity']?></td>
                    <td class="right aligned">
                        <label class="ui label blue mini">
                            <?=Helper::formatnumber($item['price_sale'])?>
                        </label>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td>
                        <strong><?=Translator::translate("Value");?>:</strong>
                    </td>
                    <td colspan="2">
                        <label class="ui label blue mini">
                            <?=Helper::formatnumber(Sale::getTotal($fetch['id']))?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong><?=Translator::translate("Date Added");?>:</strong>
                    </td>
                    <td colspan="2"><?=Helper::datetime($fetch['date_added'])?></td>
                </tr>
                <tr>
                    <td>
                        <strong><?=Translator::translate("User Added");?>:</strong>
                    </td>
                    <td colspan="2"><?=User::getBy('id', $fetch["user_added"])->first->username?></td>
                </tr>
                <tr>
                    <td>
                        <strong><?=Translator::translate("Date Modify");?>:</strong>
                    </td>
                    <td colspan="2"><?=Helper::datetime($fetch["date_modify"])?></td>
                </tr>
                <tr>
                    <td>
                        <strong><?=Translator::translate("User Modify");?>:</strong>
                    </td>
                    <td colspan="2"><?=User::getBy('id', $fetch["user_modify"])->first->username?></td>
                </tr>
                <tr>
                    <td>
                        <strong><?=Translator::translate("Observation");?>:</strong>
                    </td>
                    <td colspan="2"><?=nl2br($fetch["observation"])?></td>
                </tr>
            </tbody>
		</table>
	</div>
	<div class="actions stackable">
        <div class="ui negative labeled icon button mini">
            <?=Translator::translate('close')?>
            <i class="close inverted icon"></i>
        </div>
	</div>
</div>