<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\Warehouse;
use controller\Helper;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
    die("user_session");
}
if(!isset($_GET["id"])) {
    die("404_request");
}
if(!$fetch = Warehouse::getBy("id", $_GET["id"])) {
    die("404_request");   
}
?>
<form class="ui mini modal form zn-form-update" action="<?=Helper::url("api/warehouse/edit.php")?>" data="<?=$_GET["id"]?>">
    <div class="header">
        <h3 class="ui header red"><?=Translator::translate("Do you wish to delete this item")?>?</h3>
    </div>
    <div class="content">
        <div class="ui header small">
            <h6><?=$fetch["name"]?></h6>
        </div>
        <input type="hidden" value="1" name="value[isDeleted]">
    </div>
    <div class="actions stackable">
        <button class="ui primary labeled icon button mini" type="submit">
            <?=Translator::translate("Yes");?>
            <i class="checkmark inverted icon"></i>
        </button>
        <div class="ui negative labeled icon button mini">
            <?=Translator::translate("cancel");?>
            <i class="close inverted icon"></i>
        </div>
    </div>
</form>