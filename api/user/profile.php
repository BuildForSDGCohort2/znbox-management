<?php

	require __DIR__."/../../autoload.php";

	use controller\User;
	use controller\UserType;
	use controller\Translator;

	if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
		die("user_session");
	}
?>

<div class="ui segment raised">
	<div class="uk-background-fixed uk-background-blend-multiply uk-background-primary uk-background-cover uk-background-center-center uk-height-medium uk-width-large uk-flex uk-flex-middle uk-flex-center" style="background-image: url(resources/img/profile.jpg); width: 100%;">
		<img style="border: solid; border-width: 1px; border-color: #149ace;" class="ui circular small image" src="res/uploads/<?=$user->picture?>">
	</div>
	<div align="center" class="uk-padding-small">
		<div class="ui segment">
			<a class="ui button basic mini blue zn-link-dialog" href="user/changepassword_user_form"><i class="ui key icon"></i> <?=Translator::translate("Change user password")?></a>
			<a class="ui button basic mini blue zn-link-dialog" href="user/edit_form" data="<?=$user->id?>"><i class="ui edit icon"></i> <?=Translator::translate("Edit User")?></a>
			<a class="ui button basic mini blue zn-link-dialog" href="user/edit_picture_form" data="<?=$user->id?>"><i class="ui image icon"></i> <?=Translator::translate("Change picture")?></a>
		</div>
	</div>
	<table class="ui table selectable striped celled inverted blue">
		<tbody>
			<tr><td><?=Translator::translate("Id");?>:</td><td><?=$user->id?></td></tr>
			<tr><td><?=Translator::translate("User name");?>:</td><td><?=$user->username?></td></tr>
			<tr><td><?=Translator::translate("First name");?>:</td><td><?=$user->first?></td></tr>
			<tr><td><?=Translator::translate("Last name");?>:</td><td><?=$user->last?></td></tr>
			<tr><td><?=Translator::translate("Email");?>:</td><td><?=$user->email?></td></tr>
			<tr><td><?=Translator::translate("User type");?>:</td><td><?=UserType::getBy('id', $user->user_type)->first->type?></td></tr>
		</tbody>
	</table>
</div>