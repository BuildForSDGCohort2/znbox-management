<?php

	require __DIR__."/../../autoload.php";

	use controller\User;
	use controller\UserType;
	use controller\Translator;

	if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
		die("user_session");
	}

	$lang = ($_COOKIE['lang']) ? $_COOKIE['lang'] : "eng";
?>

<div class="ui segment basic color blue">
	<h3 class="ui header dividing blue"><i class="ui settings icon"></i><?=Translator::translate("Settings");?></h3>

	<div class="ui segment basic">
		<div class="ui accordion styled fluid">
			<div class="title active ui header trans">
				<i class="ui dropdown icon"></i>
				<?=Translator::translate("General");?>
			</div>
			<div class="content active">
				<div class="ui form container segment blue">
					<div class="ui four grouped fields">
						<label><i class="ui globe icon"></i><?=Translator::translate("Language");?></label>
						<div class="field">
					      <div class="ui slider checkbox">
					      	<?=($lang == "pt") ? '<input name="throughput" id="pt" href="user/lang" class="hidden" checked="checked" type="radio">': '<input name="throughput" id="pt" href="user/lang" class="hidden" type="radio">'?>
					        <label><?=Translator::translate("Portuguese");?></label>
					      </div>
					    </div>
					    <div class="field">
					      <div class="ui slider checkbox">
					        <?=($lang == "eng") ? '<input name="throughput" id="eng" href="user/lang" class="hidden" checked="checked" type="radio">' : '<input name="throughput" id="eng" href="user/lang" class="hidden" type="radio">'?>
					        <label><?=Translator::translate("English");?></label>
					      </div>
					    </div>
					</div>
				</div>
			</div>
			<div class="title active ui header">
				<i class="ui dropdown icon"></i>
				<?=Translator::translate("Account");?>
			</div>
			<div class="content active">
				<div class="ui segment blue">
					<div class="ui list selection animated relaxed">
						<div class="item">
							<div class="content">
								<i class="ui key icon"></i>
								<a href="user/changepassword_user_form" data="<?=$fetch['id'];?>" class="zn-link-dialog"><?=Translator::translate("Change password");?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('.ui.accordion').accordion();
	$('.ui.dropdown').dropdown();
	$('.ui.checkbox').checkbox();
</script>