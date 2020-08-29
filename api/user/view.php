<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\UserType;
use controller\Helper;
use controller\Resources;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
    die("user_session");
}

if(!isset($_GET["id"])) {
    die("404_request");
}

if(!$fetch = User::getBy("id", $_GET["id"])) {
    die("404_request");
}
?>
<div class="ui modal tiny">
    <i class="ui close icon"></i>
	<div class="header">
		<h3 class="ui header diviving color red"><i class="ui user icon"></i><?=Translator::translate("User details");?></h3>
	</div>
	<div class="scrolling content">
        <div>
            <img src="<?=Resources::stream("uploads/".$fetch["picture"])?>" class="ui image small">
        </div>
		<table class="ui small table selectable celled striped">
			<thead></thead>
			<tbody>
				<tr>
                    <td><strong>Id:</strong></td>
                    <td><?=$fetch["id"];?></td>
                </tr>
                <tr>
                    <td><strong><?=Translator::translate("First name");?>:</strong></td>
                    <td><?=$fetch["first"];?></td>
                </tr>
                <tr>
                    <td><strong><?=Translator::translate("Last name");?>:</strong></td>
                    <td><?=$fetch["last"];?></td>
                </tr>
                <tr>
                    <td><strong><?=Translator::translate("Username");?>:</strong></td>
                    <td><?=$fetch["username"];?></td>
                </tr>
                <tr>
                    <td><strong><?=Translator::translate("Email");?>:</strong></td>
                    <td><?=$fetch["email"];?></td>
                </tr>
                <tr>
                    <td><strong><?=Translator::translate("User type");?>:</strong></td>
                    <td><?=UserType::getBy("id", $fetch["user_type"])["type"];?></td>
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