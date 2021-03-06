<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\UserType;

use controller\Stock;
use controller\Customer;
use controller\Sale;
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

$use_from_proforma = false;
if(isset($_GET["d_start"]) && isset($_GET["d_end"])) {
    $use_from_proforma = true;
}
?>

<form class="ui small modal form zn-form" action="<?=Helper::url("api/sale/generate_invoice.php")?>" data="<?=$_GET["id"]?>">
    <div class="header">
        <h3 class="ui header red"><?=Translator::translate("Confirm to generate invoice")?></h3>
    </div>
    <div class="content">
        <div class="ui form">
            <div class="ui field">
                <label><?=Translator::translate("invoice date");?></label>
                <input class="flatpickr" value="<?=($use_from_proforma ? Helper::decrypt($_GET["d_start"]) : date("Y-m-d"))?>" type="date" name="value[date_emitted]" <?=($use_from_proforma ? "disabled" : "") ?>>
                <?php if($use_from_proforma): ?>
                    <input type="hidden" name="value[date_emitted]" value="<?=Helper::decrypt($_GET["d_start"])?>">
                <?php endif; ?>
            </div>
            <div class="ui field">
                <label><?=Translator::translate("invoice due date");?></label>
                <input class="flatpickr" value="<?=($use_from_proforma ? Helper::decrypt($_GET["d_end"]) : date("Y-m-d", strtotime("+5 days")))?>" type="date" name="value[date_due]" <?=($use_from_proforma ? "disabled" : "") ?>>
                <?php if($use_from_proforma): ?>
                    <input type="hidden" name="value[date_due]" value="<?=Helper::decrypt($_GET["d_end"])?>">
                <?php endif; ?>
            </div>
        </div>
        <input type="hidden" value="<?=$fetch["id"]?>" name="value[sale]">
    </div>
    <div class="actions stackable">
        <button class="ui primary labeled icon button mini" type="submit">
            <?=Translator::translate("Confirm");?>
            <i class="checkmark inverted icon"></i>
        </button>
        <div class="ui negative labeled icon button mini">
            <?=Translator::translate("cancel");?>
            <i class="close inverted icon"></i>
        </div>
    </div>
    <script type="text/javascript">
        $(".flatpickr").flatpickr({
            dateFormat: "Y-m-d",
            locale: "<?=$_COOKIE["lang"]?>",
            altInput: true,
            altFormat: "F j, Y",
        });
    </script>
</form>