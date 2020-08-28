<?php

	require __DIR__."/../../autoload.php";

	use controller\User;
	use controller\UserType;
	use controller\Translator;

	if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
		die("user_session");
	}
?>

<div class="ui small modal zn-form-update" action="user/edit_picture" data="<?=$user->id?>">
	<div class="header">
		<h3 class="ui header diviving color red"><i class="ui users icon"></i><?=Translator::translate("Edit profile picture");?></h3>
	</div>
	<div class="scrolling content">
		<div class="js-upload uk-placeholder uk-text-center">
		    <span uk-icon="icon: cloud-upload"></span>
		    <span class="uk-text-middle"><?=Translator::translate("Drag and drop the image here or");?></span>
		    <div uk-form-custom>
		        <input type="file" accept="image/*" name="picture">
		        <span class="uk-link"><?=Translator::translate("select one");?></span>
		    </div>
		</div>
		<progress id="js-progressbar" class="uk-progress" value="0" max="100" hidden></progress>
		<script>
		    var bar = document.getElementById('js-progressbar');
		    UIkit.upload('.js-upload', {

		        url: 'endpoint/user/edit_picture.php',
		        multiple: false,
		        params: { id: <?=$user->id?> },
		        mime: 'image/*',
		        name: 'picture',
		        beforeSend: function () {
		        	progress_loading();
		        },
		        loadStart: function (e) {
		            bar.removeAttribute('hidden');
		            bar.max = e.total;
		            bar.value = e.loaded;
		        },
		        progress: function (e) {
		            bar.max = e.total;
		            bar.value = e.loaded;
		        },
		        loadEnd: function (e) {
		            bar.max = e.total;
		            bar.value = e.loaded;
		        },
		        completeAll: function () {
		            progress_loaded();
		            window.dialog.modal('hide');
		            window.location.reload();

		            setTimeout(function () {
		                bar.setAttribute('hidden', 'hidden');
		            }, 1000);
		        },
		        error: function() {
		        	UIkit.notification({
					    message: 'Failed to send request',
					    status: 'danger',
					    pos: 'top-right',
					    timeout: 3000,
					});
					progress_loaded();
		        },

		    });

		</script>
	</div>
	<div class="actions stackable">
        <div class="ui negative labeled icon button mini">
            <?=Translator::translate("cancel");?>
            <i class="close inverted icon"></i>
        </div>
	</div>
</div>