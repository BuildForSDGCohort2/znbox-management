<?php

	require __DIR__."/../../autoload.php";

	use controller\User;
	use controller\UserType;
	use controller\Translator;

	if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
		die("user_session");
	}
?>

<div class="ui small modal">
	<div class="header">
		<h3 class="ui header diviving color red"><i class="ui users icon"></i><?=Translator::translate("Edit profile");?></h3>
	</div>
	<div class="scrolling content">
		<form id="form" class="ui form zn-form-update" action="user/edit" data="<?=$user->id?>">
			<div class="ui field required">
				<label><?=Translator::translate("First name");?>:</label>
				<input type="text" value="<?=$user->first?>" name="value[first]" placeholder="<?=Translator::translate("First Name");?>">
			</div>
			<div class="ui field required">
				<label><?=Translator::translate("Last name");?>:</label>
				<input type="text" value="<?=$user->last?>" name="value[last]" placeholder="<?=Translator::translate("Last Name");?>">
			</div>
			<div class="ui field required">
				<label><?=Translator::translate("Username");?>:</label>
				<input type="text" value="<?=$user->username?>" name="value[username]" placeholder="<?=Translator::translate("User Name");?>">
			</div>
			<div class="ui field required">
				<label><?=Translator::translate("Email");?>:</label>
				<input type="text" value="<?=$user->email?>" name="value[email]" placeholder="<?=Translator::translate("Email");?>">
			</div>
			<?php if(0 == 1) { ?>
			<div class="ui field required">
				<label><?=Translator::translate("User type");?>:</label>
				<select name="value[user_type]" class="ui dropdown">
				<?php foreach(UserType::getAll()->data as $item) {?>
					<?php if($item['id'] == $user->user_type) { ?>
						<option selected value="<?=$item["id"]?>"><?=$item["type"]?></option>
					<?php } else { ?>
						<option value="<?=$item["id"]?>"><?=$item["type"]?></option>
					<?php } ?>
				<?php } ?>
				</select>
			</div>
			<?php } ?>
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
			$('.ui.dropdown').dropdown({on:'hover'});
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
				}
			});
		});
	</script>
</div>