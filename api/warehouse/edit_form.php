<?php 
    require __DIR__."/../../autoload.php";

    use controller\Translator;
    use controller\User;
    use controller\UserType;

    use controller\Warehouse;
    use controller\Helper;

    if(!$user = User::getBy('id', User::validate_token($_SESSION['token'])['user_id'])->first) {
        die("user_session");
    }

    if(!isset($_GET['id'])) {
        die("404_request");
    }

    if(!$fetch = Warehouse::getBy('id', $_GET['id'])->first) {
        die("404_request");   
    }

    $fetch = (array) $fetch;
?>

<form class="ui small modal form zn-form-update" action="warehouse/edit" data="<?=$_GET['id']?>">
	<div class="header">
		<h3 class="ui header diviving color red"><i class="ui warehouse icon"></i><?=Translator::translate("edit warehouse details");?></h3>
	</div>
	<div class="scrolling content">
		<div class="ui field required">
			<label><?=Translator::translate("Name");?>:</label>
			<input type="text" value="<?=$fetch['name']?>" name="value[name]" placeholder="<?=Translator::translate("Name");?>">
		</div>
		<div class="ui field required">
			<label><?=Translator::translate("Address");?>:</label>
			<input type="text" value="<?=$fetch['address']?>" name="value[address]" placeholder="<?=Translator::translate("Address");?>">
		</div>
		<div class="ui field">
			<label><?=Translator::translate("Description");?>:</label>
			<textarea placeholder="<?=Translator::translate("Description");?>" name="value[description]"><?=$fetch['description']?></textarea>
		</div>
	</div>
	<div class="actions stackable">
		<button class="ui primary labeled icon button mini" type="submit">
            <?=Translator::translate("save");?>
            <i class="checkmark inverted icon"></i>
        </button>
        <div class="ui negative labeled icon button mini">
            <?=Translator::translate("cancel");?>
            <i class="close inverted icon"></i>
        </div>
	</div>
	<script type="text/javascript">
			$("form").form({
				on:'blur',
				inline:true,
				fields:{
					name:{
						identifier:'value[name]',
						rules:[{
							type:'empty',
							prompt:'{name} <?=Translator::translate("Please fill this field")?>'
						}]
					}
				}
			});
	</script>
</form>