<?php

	require __DIR__."/../../autoload.php";

	use controller\User;
	use controller\UserType;
	use controller\Translator;

	if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
		die("user_session");
	}
?>

<form class="ui small modal form zn-form" action="user/add">
	<div class="header">
		<h3 class="ui header diviving color red"><i class="ui users icon"></i><?=Translator::translate("Create new user");?></h3>
	</div>
	<div class="scrolling content">
		<div class="ui field required">
			<label><?=Translator::translate("First name");?>:</label>
			<input type="text" name="value[first]" placeholder="<?=Translator::translate("First Name");?>">
		</div>
		<div class="ui field required">
			<label><?=Translator::translate("Last name");?>:</label>
			<input type="text" name="value[last]" placeholder="<?=Translator::translate("Last Name");?>">
		</div>
		<div class="ui field required">
			<label><?=Translator::translate("Username");?>:</label>
			<input type="text" name="value[username]" placeholder="<?=Translator::translate("User Name");?>">
		</div>
		<div class="ui field required">
			<label><?=Translator::translate("Email");?>:</label>
			<input type="text" name="value[email]" placeholder="<?=Translator::translate("Email");?>">
		</div>
		<div class="ui field required">
			<label><?=Translator::translate("User type");?>:</label>
			<select name="value[user_type]" class="ui dropdown">
			<?php foreach(UserType::getAll()->data as $item) {?>
				<option value="<?=$item["id"]; ?>"><?=$item["type"]; ?></option>
			<?php } ?>
			</select>
		</div>
		<div class="ui field required">
			<label><?=Translator::translate("Password");?>:</label>
			<input type="password" name="value[password]" placeholder="<?=Translator::translate("Password");?>">
		</div>
		<div class="ui field required">
			<label><?=Translator::translate("Confirm Password");?>:</label>
			<input type="password" name="value[confirm]" placeholder="<?=Translator::translate("Confirm Password");?>">
		</div>
	</div>
	<div class="actions stackable">
		<button class="ui primary labeled icon button mini" type="submit">
            <?=Translator::translate("Create");?>
            <i class="checkmark inverted icon"></i>
        </button>
        <div class="ui negative labeled icon button mini">
            <?=Translator::translate("cancel");?>
            <i class="close inverted icon"></i>
        </div>
	</div>
	<script type="text/javascript">
		$(function() {
			$('.ui.dropdown').dropdown();
			$("form").form({
				on:'blur',
				inline:true,
				fields:{
					first:{
						identifier:'value[first]',
						rules:[{
							type:'empty',
							prompt:'{name} <?=Translator::translate("Please fill this field")?>'
						}]
					},
					last:{
						identifier:'value[last]',
						rules:[{
							type:'empty',
							prompt:'{name} <?=Translator::translate("Please fill this field")?>'
						}]
					},
					username : {
						identifier : 'value[username]',
						rules:[{
							type:'empty',
							prompt:'{name} <?=Translator::translate("Please fill this field")?>'
						}]
					},
					email:{
						identifier:'value[email]',
						rules:[{
							type:'empty',
							prompt:'{name} <?=Translator::translate("Please fill this field")?>'
						}]
					},
					password:{
						identifier:'value[password]',
						rules:[{
							type:'empty',
							prompt:'{name} <?=Translator::translate("Please fill this field")?>'
						}]
					},
					confirm:{
						identifier:'value[confirm]',
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