<?php 

use controller\Translator;

?>

<ul class="uk-nav uk-nav-default tm-nav" uk-nav style="font-size: 13px;">
	<li class="uk-nav-header">
		<h4 class="ui header small dividing" style="border-bottom-color: #0e26d9;">
			<i class="ui home icon"></i> <?= Translator::translate('Home') ?>
		</h4>
	</li>
	<li>
		<a class="zn-link" style="" href="user/home">
			<i class="ui home icon"></i> <?= Translator::translate('home') ?>
		</a>
	</li>
	<?php if($user->user_type == 1 or $user->user_type == 0) { ?>
	<li class="uk-nav-header">
		<h4 class="ui header small dividing" style="border-bottom-color: #0e26d9;">
			<i class="ui chart pie icon"></i> <?= Translator::translate('Admin') ?>
		</h4>
	</li>
	<li>
		<a class="zn-link" href="user/users" style="">
			<i class="ui users icon"></i> <?= Translator::translate('users') ?>
		</a>
	</li>
	<li>
		<a class="zn-link" href="enterprise/enterprise" style="">
			<i class="ui building icon"></i> <?= Translator::translate('enterprise') ?>
		</a>
	</li>
	<?php } ?>
	<li class="uk-nav-header">
		<h4 class="ui header small dividing" style="border-bottom-color: #0e26d9;">
			<i class="ui box icon"></i> <?= Translator::translate('Stock') ?>
		</h4>
	</li>
	<li>
		<a class="zn-link" href="stock/stock" style="">
			<i class="ui box icon"></i> <?=Translator::translate('stock')?>
		</a>
	</li>
	<li>
		<a class="zn-link" href="supplier/supplier" style="">
			<i class="ui dolly flatbed icon"></i> <?=Translator::translate('supplier')?>
		</a>
	</li>
	<li>
		<a class="zn-link" href="stock_category/stock_category" style="">
			<i class="ui list icon"></i> <?=Translator::translate('category')?>
		</a>
	</li>
	<li>
		<a class="zn-link" href="warehouse/warehouse" style="">
			<i class="ui warehouse icon"></i> <?=Translator::translate('warehouse')?>
		</a>
	</li>
	<!-- Purchase -->
	<li class="uk-nav-header">
		<h4 class="ui header small dividing" style="border-bottom-color: #0e26d9;">
			<i class="ui cart icon"></i> <?= Translator::translate('Purchase') ?>
		</h4>
	</li>
	<li>
		<a class="zn-link" href="purchase/purchase" style="">
			<i class="ui cart icon"></i> <?=Translator::translate('purchase')?>
		</a>
	</li>
	<!-- Sales -->
	<li class="uk-nav-header">
		<h4 class="ui header small dividing" style="border-bottom-color: #0e26d9;">
			<i class="ui handshake icon"></i> <?= Translator::translate('sales') ?>
		</h4>
	</li>
	<li>
		<a class="zn-link" href="sale/sale" style="">
			<i class="ui handshake icon"></i> <?=Translator::translate('sales')?>
		</a>
	</li>
	<li>
		<a class="zn-link" href="proforma/proforma" style="">
			<i class="ui file alternate icon"></i> <?=Translator::translate('Proformas')?>
		</a>
	</li>
	<li>
		<a class="zn-link" href="invoice/invoice" style="">
			<i class="ui file alternate icon"></i> <?=Translator::translate('Invoices')?>
		</a>
	</li>
	<!-- Payments -->
	<li class="uk-nav-header">
		<h4 class="ui header small dividing" style="border-bottom-color: #0e26d9;">
			<i class="credit card icon"></i> <?= Translator::translate('Payments') ?>
		</h4>
	</li>
	<li>
		<a class="zn-link" href="payment/payment" style="">
			<i class="credit card icon"></i> <?=Translator::translate('Payments')?>
		</a>
	</li>
	<!-- Customer -->
	<li class="uk-nav-header">
		<h4 class="ui header small dividing" style="border-bottom-color: #0e26d9;">
			<i class="ui users icon"></i> <?= Translator::translate('customers') ?>
		</h4>
	</li>
	<li>
		<a class="zn-link" href="customer/customer" style="">
			<i class="ui users icon"></i> <?=Translator::translate('Customers')?>
		</a>
	</li>
	<li class="uk-height-medium">
		
	</li>
</ul>

<style type="text/css">
	ul.uk-nav.uk-nav-default li.uk-nav-header h3 {
		color: #86b6ff;
	}
	ul.uk-nav.uk-nav-default li.uk-nav-header {
		margin-top: 20px;
	}
</style>

<style type="text/css">
	.tm-navbar-container:not(.uk-navbar-transparent) {
		background: linear-gradient(to left, #00578f, #000);
	}
	.uk-navbar-container .uk-navbar-left ul li a {
		color : white;
	}
	.uk-navbar-container .uk-navbar-right ul li a {
		color : white;
	}
	.uk-navbar-container .uk-navbar-left ul li div ul li a {
		color : #28a5f5;
	}
	.uk-navbar-container .uk-navbar-right ul li div ul li a {
		color : #28a5f5;
	}
	.uk-navbar-container .uk-navbar-left ul li div{
		/*background-color : #28a5f5;*/
	}
	.tm-sidebar-left ul li a {
		color: #a9cbff;
	}
	.tm-sidebar-left ul li .ui.header.dividing {
		color: #86b6ff;
		border-bottom-color: #00118d;
	}
	.uk-offcanvas-bar ul li .ui.header.dividing {
		color: #86b6ff;
		border-bottom-color: #00118d;
	}

	/*side bar mobile colors*/
	#offcanvas .uk-offcanvas-bar ul li a {
		color: #a9cbff;
	}

	.tm-sidebar-left {
	    position: fixed;
	    top: 80px;
	    bottom: 0;
	    box-sizing: border-box;
	    width: 240px !important;
	    padding: 40px 40px 60px 40px;
	    border-right: 1px #e5e5e5 solid;
	    overflow: auto;
	}
	.tm-sidebar-left + .tm-main {
	    padding-left: 40px;
	}
	.tm-sidebar-left + .tm-main {
	    padding-left: 240px;
	}
	@media only screen and (max-width: 767px) {
		.tm-sidebar-left {
			display: none;
		}
		.tm-main {
			margin-left: -270px;
		}
		#username {
			display: none;
		}
	}
	@media only screen and (min-width: 767px) {
		.sidebarbutton {
			display: none;
		}
	}
</style>