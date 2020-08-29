<?php

require __DIR__."/../../autoload.php";

use controller\User;
use controller\UserType;
use controller\Translator;
use controller\Helper;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die("user_session");
}
?>

<div class="ui small modal">
	<div class="header">
		<h3 class="ui header diviving color red"><i class="ui users icon"></i><?=Translator::translate("Edit profile");?></h3>
	</div>
	<div class="scrolling content">
		<form id="form" class="ui form zn-form-update-complex" action="<?=Helper::url("api/user/edit.php")?>" data="<?=$user["id"]?>">
			<div class="ui field required">
				<label><?=Translator::translate("First name");?>:</label>
				<input type="text" value="<?=$user["first"]?>" name="first" placeholder="<?=Translator::translate("First Name");?>">
			</div>
			<div class="ui field required">
				<label><?=Translator::translate("Last name");?>:</label>
				<input type="text" value="<?=$user["last"]?>" name="last" placeholder="<?=Translator::translate("Last Name");?>">
			</div>
			<div class="ui field required">
				<label><?=Translator::translate("Username");?>:</label>
				<input type="text" value="<?=$user["username"]?>" name="username" placeholder="<?=Translator::translate("User Name");?>">
			</div>
			<div class="ui field required">
				<label><?=Translator::translate("Email");?>:</label>
				<input type="text" value="<?=$user["email"]?>" name="email" placeholder="<?=Translator::translate("Email");?>">
			</div>
		</form>
	</div>
	<div class="actions stackable">
		<button class="ui primary labeled icon button mini" type="submit" form="form">
            <?=Translator::translate("save");?>
            <i class="checkmark inverted icon"></i>
        </button>
        <div class="ui negative labeled icon button mini">
            <?=Translator::translate("cancel");?>
            <i class="close inverted icon"></i>
        </div>
	</div>
	<script type="text/javascript">
		$(function(){
			$(".ui.dropdown").dropdown({on:"hover"});
			$("form").form({
				on:"blur",
				inline:true,
				fields:{
					first:{
						identifier:"first",
						rules:[{
							type:"empty",
							prompt:"{name} <?=Translator::translate("Please fill this field")?>"
						}]
					},
					last:{
						identifier:"last",
						rules:[{
							type:"empty",
							prompt:"{name} <?=Translator::translate("Please fill this field")?>"
						}]
					},
					username : {
						identifier : "username",
						rules:[{
							type:"empty",
							prompt:"{name} <?=Translator::translate("Please fill this field")?>"
						}]
					},
					email:{
						identifier:"email",
						rules:[{
							type:"empty",
							prompt:"{name} <?=Translator::translate("Please fill this field")?>"
						}]
					},
				}
			});
		});
	</script>
</div>