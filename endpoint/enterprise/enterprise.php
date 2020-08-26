<?php 
    require __DIR__."/../../autoload.php";

    use controller\Translator;
    use controller\User;
    use controller\UserType;

    use controller\Enterprise;
    use controller\Helper;

    if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
        die("user_session");
    }

    $enterprise = (array) Enterprise::getAll()->first;
?>
<div class="ui segment basic">
	<div class="ui header dividing blue">
		<i class="ui building icon"></i><?=Translator::translate("Enterprise");?>
	</div>
	<div class="ui basic segment">
		
		<div class="ui segment raised">
			<div class="ui card">
				<div class="content">
					<img src="<?="assets/img/".$enterprise['logo']?>">
				</div>
				<a class="ui button basic mini blue zn-link-dialog" href="enterprise/edit_logo_form"><i class="ui image icon"></i> <?=Translator::translate("Change logo")?></a>
			</div>
			<a class="ui basic button blue zn-link" href="enterprise/edit_form">
				<i class="ui edit icon"></i><?=Translator::translate("Edit information");?>
			</a>
			<table class="ui basic table celled selectable">
				<tr>
					<td><b><i class="pencil icon"></i><?=Translator::translate("name");?>:</b></td>
					<td><?=$enterprise['name']?></td>
				</tr>
				<tr>
					<td><b><i class="mail icon"></i><?=Translator::translate("email");?>:</b></td>
					<td><?=$enterprise['email']?></td>
				</tr>
				<tr>
					<td><b><i class="phone icon"></i><?=Translator::translate("contact");?>1:</b></td>
					<td><?=$enterprise['phone1']?></td>
				</tr>
				<tr>
					<td><b><i class="phone icon"></i><?=Translator::translate("contact");?>2:</b></td>
					<td><?=$enterprise['phone2']?></td>
				</tr>
				<tr>
					<td><b><i class="address book icon"></i><?=Translator::translate("address");?>:</b></td>
					<td><?=$enterprise['address']?></td>
				</tr>
				<tr>
					<td><b><i class="location arrow icon"></i><?=Translator::translate("postal code");?>:</b></td>
					<td><?=$enterprise['postal_code']?></td>
				</tr>
				<tr>
					<td><b><i class="ui pencil alternate icon"></i><?=Translator::translate("nuit")." (".Translator::translate("Tax identification number").")"?>:</b></td>
					<td><?=$enterprise['nuit']?></td>
				</tr>
			</table>
		</div>
	</div>
	
</div>