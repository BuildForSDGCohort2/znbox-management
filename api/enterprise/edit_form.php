<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\UserType;
use controller\Enterprise;
use controller\Helper;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
    die("user_session");
}
$fetch = Enterprise::getBy("id", 1);
?>
<div class="ui segment basic">
	<div class="ui header dividing blue">
		<i class="ui edit icon"></i> <?=Translator::translate("Edit information");?>
	</div>
	<div class="ui segment raised">
		<form class="ui form submitEnterprise zn-form" action="<?=Helper::url("api/enterprise/edit.php")?>" method="POST">
			<div class="three fields">
				<div class="field required">
					<label><?=Translator::translate("name");?>:</label>
					<input type="text" value="<?=$fetch["name"]?>" autocomplete="off" name="value[name]" placeholder="Name">
				</div>
				<div class="field">
					<label><?=Translator::translate("email");?>:</label>
					<input type="email" value="<?=$fetch["email"]?>" autocomplete="off" name="value[email]" placeholder="Email">
				</div>
			</div>
			<div class="three fields">
				<div class="field">
					<label><?=Translator::translate("contact");?>1:</label>
					<input type="text" value="<?=$fetch["phone1"]?>" name="value[phone1]" placeholder="Phone">
				</div>
				<div class="field">
					<label><?=Translator::translate("contact");?>2:</label>
					<input type="text" value="<?=$fetch["phone2"]?>" name="value[phone2]" placeholder="Phone">
				</div>
			</div>
			<div class="three fields">
				<div class="field">
					<label><?=Translator::translate("address");?>:</label>
					<input type="text" value="<?=$fetch["address"]?>" autocomplete="off" name="value[address]" placeholder="Address">
				</div>
				<div class="field">
					<label><?=Translator::translate("postal code");?>:</label>
					<input type="number" value="<?=$fetch["postal_code"]?>" autocomplete="off" name="value[postal_code]"text placeholder="Postal code">
				</div>
				<div class="field">
					<label><?=Translator::translate("nuit");?>:</label>
					<input type="number" value="<?=$fetch["nuit"]?>" name="value[nuit]" placeholder="<?=Translator::translate("nuit");?>">
				</div>
			</div>
			<button class="ui basic button primary" type="submit"><i class="ui save icon"></i><?=Translator::translate("Save");?></button>
			<a href="enterprise/enterprise" class="ui basic button negative zn-link"><i class="ui times icon"></i><?=Translator::translate("Cancel");?></a>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(".submitEnterprise").form({
		on:"blur",
		inline:true,
		fields:{
			name:{
				identifier:"value[name]",
				rules:[{
					type:"empty",
					prompt:"{name} <?=Translator::translate("Please fill this field") ?>",
				}]
			},
			phone1:{
				identifier:"value[phone1]",
				rules:[{
					type:"empty",
					prompt:"{name} <?=Translator::translate("Please fill this field") ?>",
				}]
			},
			phone2:{
				identifier:"value[phone2]",
				rules:[{
					type:"empty",
					prompt:"{name} <?=Translator::translate("Please fill this field") ?>",
				}]
			},
			postal_code:{
				identifier:"value[postal_code]",
				rules:[{
					type:"empty",
					prompt:"{name} <?=Translator::translate("Inserted value must be a number") ?>",
				}]
			},
			nuit: {
				identifier:"value[nuit]",
				rules:[{
					type:"number",
					prompt:"{name} <?=Translator::translate("Inserted value must be a number") ?>",
				},{
					type:"empty",
					prompt:"{name} <?=Translator::translate("Please fill this field") ?>",
				}]
			}
		}
	});
</script>