<?php 

require __DIR__."/../autoload.php";

use controller\Translator;
use controller\Helper;
use controller\User;

if (!isset($_COOKIE['lang'])) {
	setcookie("lang", "eng", time() + 3600 * (24 * 365), "/", "", false, false);
}

/* if is home */
if(!Helper::endsWith($_SERVER['REDIRECT_URL'], 'home') && !Helper::endsWith($_SERVER['REDIRECT_URL'], 'home/')) {
	header('Location: home/');
}

/* if session token exists */
if(!isset($_SESSION['token'])) { header('Location: authentication'); }

/* Validate session token */
if(!$user = (object) User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])) {
	header('Location: authentication');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>ZNBOX</title>
	<meta charset="utf-8" id="znbox" href="<?=Helper::url("")?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="znbox_mobile_app_icon.ico"/>
	<link rel="stylesheet" type="text/css" href="<?=Helper::url("assets/libs/mdl/material.min.css")?>">
	<link rel="stylesheet" type="text/css" href="<?=Helper::url("assets/css/icons.css")?>">
	<link rel="stylesheet" type="text/css" href="<?=Helper::url("assets/libs/semantic/semantic.min.css")?>">
	<link rel="stylesheet" type="text/css" href="<?=Helper::url("assets/libs/datatable/dataTables.semanticui.min.css")?>">
	<link rel="stylesheet" type="text/css" href="<?=Helper::url("assets/libs/flatpickr/flatpickr.min.css")?>">
	<link rel="stylesheet" type="text/css" href="<?=Helper::url("assets/libs/flatpickr/theme/dark.css")?>">
	<link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?=Helper::url("assets/libs/uikit/css/uikit.min.css")?>">
	<script type="text/javascript" src="<?=Helper::url("assets/libs/jquery/jquery.min.js")?>"></script>
	<link rel="stylesheet" type="text/css" href="<?=Helper::url("assets/css/app.css")?>">
</head>
<body style="scrollbar-width: thin;">
	<div id="root">
		<!-- Top Nav bar -->
		<div style="position: fixed; width: 100%; top: 0; z-index: 1000;">
			<div class="tm-navbar-container uk-navbar-container" style="background: linear-gradient(to left, #00578f, #000);">
				<div class="uk-container uk-container-expand">
					<nav class="uk-navbar-container uk-navbar-transparent" uk-navbar >
					    <div class="uk-navbar-left">
					        <ul class="uk-navbar-nav">
					        	<li id="bars_side_bar_button">
					        		<a uk-toggle="target: #mobile_sidebar">
					        			<h2 style="color: white;"><i class="ui bars icon"></i></h2>
					        		</a>
					        	</li>
					            <li>
					            	<a style="touch-action: manipulation; margin-left: 15px;">
					            		<img src="<?=Helper::url("res/img/logo.png")?>" width="40">
					            		<h2 class="uk-padding-small" style="color: white; margin-top: 0;">ZNBOX</h2>
					            	</a>
					            </li>
					        </ul>
					    </div>
					    <div class="uk-navbar-right">
					        <ul class="uk-navbar-nav">
					        	<li>
					        		<a class="uk-margin-small-right">
					        			<img class="ui avatar image" src="<?=Helper::url("res/uploads/".$user->picture)?>">
					        		</a>
					        		<div class="uk-navbar-dropdown" uk-dropdown="mode: click">
						        		<ul class="uk-nav uk-navbar-dropdown-nav">
											<li>
												<a class="zn-link" href="<?=Helper::url("api/user/profile.php")?>" id="profileButton"><i class="ui user icon"></i><?=Translator::translate('profile')?></a>
												<a class="zn-link" href="<?=Helper::url("api/user/settings.php")?>"><i class="ui settings icon"></i><?=Translator::translate('settings')?></a>
												<a href="<?=Helper::url("authentication")?>"><i class="ui sign out icon"></i><?=Translator::translate('logout')?></a>
											</li>
				                        </ul>
			                        </div>
					        	</li>
					        </ul>
					    </div>
					</nav>
				</div>
			</div>
		</div>
		<!-- End Top Nav bar -->



		<!-- Sidebar -->
		<div id="sidebar" style="">
			<div class="tm-sidebar-left" style="width: auto; background: black; height: 100vh; padding: 40px 40px 60px 40px; overflow-y: scroll; scrollbar-width: thin;">
			    <?php require __DIR__."/sidebar.php"; ?>
			</div>
		</div>
		<!-- End Sidebar -->

		<!-- Mobile sidebar -->
		<div id="mobile_sidebar" uk-offcanvas="mode: push; overlay: true">
		    <div class="uk-offcanvas-bar" style="background: black;">
		    	<button class="uk-offcanvas-close" type="button" uk-close></button>
		    	<div class="uk-width-1-2@s uk-width-2-5@m" style="padding: 10px; height: 100vh;">
				    <?php require __DIR__."/sidebar.php"; ?>
				</div>
		    </div>
		</div>
		<!-- End Mobile sidebar -->

		<div id="content"></div>
		<div class="mdl-spinner mdl-js-spinner mdl-spinner--single-color" style="position: fixed; top: 45%; right: 50%; z-index: 8999;"></div>

		<div class="splashscreen" style="position: fixed; width: 100%; height: 100%; background: linear-gradient(to left, #00578f, #000); z-index: 9000; top: 0; overflow: hidden;">
			<div align="center">
				<img src="res/img/logo.png" width="100" style="margin-top: 150px;">
				<h1 style="color: white;">ZNBOX</h1>
			</div>
		</div>

		<!-- Time -->
		<div style="min-width: 230px; height: 30px; background: black; color: white; position: fixed; left: 0; bottom: 0; border: solid; border-color: #005083; border-width: 1px; font-family: 'Orbitron', sans-serif;">
			<div style="padding: 5px; margin-left: -10px; margin-right: -10px; font-weight: 500;" class="zn-clock"></div>
		</div>
	</div>

	<div class="ui modal small" id="session_warning">
		<div class="ui top attached indicating progress blue session_warning_progress">
			<div class="bar"></div>
		</div>
		<div class="header">
			<i class="ui warning icon"></i> <?=Translator::translate("Session time")?>
		</div>
		<div class="content">
			<h3 class="ui header small">
				<?=Translator::translate("Session will end in")?> <span class="left_seconds"></span> <?=Translator::translate("Seconds")?>!
			</h3>
		</div>
		<div class="ui bottom attached indicating progress blue session_warning_progress">
			<div class="bar"></div>
		</div>
	</div>

	<script type="text/javascript" src="<?=Helper::url("assets/libs/mdl/material.min.js")?>"></script>
	<script type="text/javascript" src="<?=Helper::url("assets/libs/semantic/semantic.min.js")?>"></script>
	<script type="text/javascript" src="<?=Helper::url("assets/libs/datatable/jquery.dataTables.min.js")?>"></script>
	<script type="text/javascript" src="<?=Helper::url("assets/libs/datatable/dataTables.semanticui.min.js")?>"></script>
	<script type="text/javascript" src="<?=Helper::url("assets/libs/uikit/js/uikit.min.js")?>"></script>
	<script type="text/javascript" src="<?=Helper::url("assets/libs/uikit/js/uikit-icons.min.js")?>"></script>
	<script type="text/javascript" src="<?=Helper::url("assets/libs/flatpickr/flatpickr.min.js")?>"></script>
	<script type="text/javascript" src="<?=Helper::url("assets/libs/flatpickr/lang/pt.js")?>"></script>
	<script type="text/javascript" src="<?=Helper::url("assets/js/app.js")?>"></script>
	<script type="text/javascript" src="<?=Helper::url("assets/js/sales.js")?>"></script>
	<script type="text/javascript" src="<?=Helper::url("assets/js/purchase.js")?>"></script>
</body>
</html>