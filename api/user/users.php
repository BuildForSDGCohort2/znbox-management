<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\UserType;
use controller\Helper;
use controller\Resources;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die("user_session");
}
?>

<div class="ui segment blue">
	<div class="uk-padding-small">
		<div class="ui header small dividing color blue">
			<h3 class="ui header blue"><i class="ui users icon"></i> <?=Translator::translate("users")?></h3>
		</div>
		<a class="ui small basic button blue zn-link-dialog" href="<?=Helper::url("api/user/add_form.php")?>"><i class="ui plus icon"></i> <?=Translator::translate("Create user")?></a>

		<div class="ui small message info"><i class="ui bell outline icon large"></i><?=Translator::translate("List of all created users");?></div>
	</div>
	<div class="uk-margin">
		<div align="center" class="ui small segment spacked purple uk-width-small">
			<div class="ui statistic purple">
			    <div class="value">
			      <?=User::getAll()->rowCount()?>
			    </div>
			    <div class="label">
			      <?=Translator::translate("total")?>
			    </div>
			</div>
		</div>
	</div>
	<div class="uk-margin-top" style="margin-left: 10px;">
		<table class="ui inverted small table color blue">
			<thead>
				<th><?=Translator::translate("Id");?></th>
				<th><?=Translator::translate("avatar");?></th>
				<th><?=Translator::translate("First Name");?></th>
				<th><?=Translator::translate("Last Name");?></th>
				<th><?=Translator::translate("Username");?></th>
				<th><?=Translator::translate("Email");?></th>
				<th><?=Translator::translate("User type");?></th>
				<th><?=Translator::translate("Active");?></th>
				<th><?=Translator::translate("Actions");?></th>
			</thead>
			<tbody>
				<?php foreach(User::getAll() as $item) { ?>
					<?php if($item["id"] == 0 and $user["id"] != $item["id"]) { continue; } ?>
					<tr>
						<td>
							<label class="ui small orange ribbon label">
								<?=$item["id"]?>
							</label>
						</td>
						<td>
							<img style="width: 40px; height: 40px; border-radius: 50%;" src="<?=Resources::stream("uploads/".$item["picture"]);?>">
						</td>
						<td><?=$item["first"]?></td>
						<td><?=$item["last"]?></td>
						<td><?=$item["username"]?></td>
						<td><?=$item["email"]?></td>
						<td>
							<select name="user_type" class="ui dropdown compact" data="<?=$item["id"]?>" href="<?=Helper::url("api/user/user_type.php?id=".$item["id"])?>" dropdown="zn-dropdown">
								<?php foreach(UserType::getAll() as $user_type) {?>
								<?php if($user_type["id"] == $item["user_type"]) { ?>
									<option selected value="<?=$user_type["id"]; ?>"><?=$user_type["type"]?></option>
								<?php } else { ?>
									<option value="<?=$user_type["id"]?>"><?=$user_type["type"]?></option>
								<?php }} ?>
							</select>
						</td>
						<td>
							<div class="ui segment">
								<div class="ui fitted toggle checkbox" data-tooltip="<?=Translator::translate("Enable or disable user")?>">
									<?php if($item["status"] == 0) { ?>
			                        <input class="zn-switch-button" type="checkbox" value="0" href="<?=Helper::url("api/user/status.php?id=".$item["id"])?>" data="<?=$item["id"];?>" name="status" class="switchButton" >
			                    	<?php } else { ?>
			                    	<input class="zn-switch-button" type="checkbox" value="1" href="<?=Helper::url("api/user/status.php?id=".$item["id"])?>" data="<?=$item["id"];?>" checked="" name="status" class="switchButton" >
			                    	<?php } ?>
			                        <label></label>
			                    </div>
		                    </div>
	                    </td>
						<td>
							<a class="ui mini circular icon button violet zn-link-dialog" href="<?=Helper::url("api/user/view.php?id=".$item["id"])?>" data="<?=$item["id"]?>" data-tooltip="<?=Translator::translate("User details")?>">
								<i class="ui eye icon"></i>
							</a>
							<a class="ui mini circular icon button purple zn-link-dialog" href="<?=Helper::url("api/user/changepassword_form.php?id=".$item["id"])?>" data="<?=$item["id"]?>" data-tooltip="<?=Translator::translate("Change user password")?>">
								<i class="ui key icon"></i>
							</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(".ui.dropdown").dropdown();
	$(".ui.table").DataTable({
		//dom: "lBfrtip",
		"bDestroy": true,
		"order": [
			[ 0, "desc" ]
		],
		language: {
			"lengthMenu": "<?=Translator::translate("lengthMenu");?>",
	        "zeroRecords": "<?=Translator::translate("zeroRecords");?>",
	        "info": "<?=Translator::translate("info");?>",
	        "infoEmpty": "<?=Translator::translate("infoEmpty");?>",
	        "infoFiltered": "(<?=Translator::translate("infoFiltered");?>)",    
	        "loadingRecords": "<?=Translator::translate("loadingRecords");?>...",
	        "processing": "<?=Translator::translate("processing");?>...",
	        "search": "<?=Translator::translate("search");?>:",
	        "paginate": {
	        	"first": "<?=Translator::translate("first");?>",
	        	"last": "<?=Translator::translate("last");?>",
	        	"next": "<?=Translator::translate("next");?>",
	        	"previous": "<?=Translator::translate("previous");?>"
	        },
	    },
	});
</script>