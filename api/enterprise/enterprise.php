<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\UserType;
use controller\Enterprise;
use controller\Helper;
use controller\Resources;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
    die("user_session");
}

$enterprise = Enterprise::getBy("id", 1);
?>
<div class="ui segment basic">
	<div class="ui header dividing blue">
		<i class="ui building icon"></i><?=Translator::translate("Enterprise");?>
	</div>
	<div class="ui basic segment small">
		<div class="ui segment raised small">
			<div class="ui card">
				<div class="content">
					<img src="<?=Resources::stream("enterprise/".$enterprise["logo"])?>">
				</div>
				<a class="ui button basic mini blue zn-link-dialog" href="<?=Helper::url("api/enterprise/edit_logo_form.php")?>"><i class="ui image icon"></i> <?=Translator::translate("Change logo")?></a>
			</div>
			<a class="ui basic button tiny blue zn-link" href="<?=Helper::url("api/enterprise/edit_form.php")?>">
				<i class="ui edit icon"></i><?=Translator::translate("Edit information");?>
			</a>
			<table class="ui basic table celled selectable small">
				<tr>
					<td><b><i class="pencil icon"></i><?=Translator::translate("name");?>:</b></td>
					<td><?=$enterprise["name"]?></td>
				</tr>
				<tr>
					<td><b><i class="mail icon"></i><?=Translator::translate("email");?>:</b></td>
					<td><?=$enterprise["email"]?></td>
				</tr>
				<tr>
					<td><b><i class="phone icon"></i><?=Translator::translate("contact");?>1:</b></td>
					<td><?=$enterprise["phone1"]?></td>
				</tr>
				<tr>
					<td><b><i class="phone icon"></i><?=Translator::translate("contact");?>2:</b></td>
					<td><?=$enterprise["phone2"]?></td>
				</tr>
				<tr>
					<td><b><i class="address book icon"></i><?=Translator::translate("address");?>:</b></td>
					<td><?=$enterprise["address"]?></td>
				</tr>
				<tr>
					<td><b><i class="location arrow icon"></i><?=Translator::translate("postal code");?>:</b></td>
					<td><?=$enterprise["postal_code"]?></td>
				</tr>
				<tr>
					<td><b><i class="ui pencil alternate icon"></i><?=Translator::translate("nuit")." (".Translator::translate("Tax identification number").")"?>:</b></td>
					<td><?=$enterprise["nuit"]?></td>
				</tr>
			</table>
		</div>
	</div>
	
</div>