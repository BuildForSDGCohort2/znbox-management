<?php

	require __DIR__."/../../autoload.php";

	use controller\User;
	use controller\UserType;
	use controller\Translator;

	if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
		die("user_session");
	}
?>

<form class="ui modal tiny form zn-form-update" action="user/changepassword" data="<?=$_GET['id']?>">
	<div class="header">
		<h3 class="ui header diviving color red"><i class="ui users icon"></i><?=Translator::translate("Change password");?></h3>
	</div>
	<div class="scrolling content">
		<div class="ui field required">
			<label><?=Translator::translate("New Password");?>:</label>
			<input type="password"  name="value[newpassword]" placeholder="<?=Translator::translate("New Password");?>">
		</div>
		<div class="ui field required">
			<label><?=Translator::translate("Confirm New Password");?>:</label>
			<input type="password"  name="value[confirmnew]" placeholder="<?=Translator::translate("Confirm Password");?>">
		</div>
	</div>
	<div class="actions stackable">
		<button class="ui primary labeled icon button mini" type="submit">
            <?=Translator::translate("Change Password");?>
            <i class="save inverted icon"></i>
        </button>
        <div class="ui negative labeled icon button mini">
            <?=Translator::translate("Cancel");?>
            <i class="close inverted icon"></i>
        </div>
	</div>
	<script type="text/javascript">
		$(function(){
			$("form").form({
				on:'blur',
				inline:true,
				fields:{
					confirmnew:{
						identifier:'value[confirmnew]',
						rules:[{
							type:'empty',
							prompt:'{name} <?=Translator::translate("Please fill this field")?>'
						}]
					},
					newpassword:{
						identifier:'value[newpassword]',
						rules:[{
							type:'empty',
							prompt:'{name} <?=Translator::translate("Please fill this field")?>'
						}]
					},
				}
			});
		});
	</script>
</form>