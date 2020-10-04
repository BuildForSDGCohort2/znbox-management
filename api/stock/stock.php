<?php 
require __DIR__."/../../autoload.php";

use controller\Translator;
use controller\User;
use controller\UserType;

use controller\Price;
use controller\Supplier;
use controller\_StockSupplier;
use controller\Warehouse;
use controller\Stock;
use controller\StockType;
use controller\Helper;

if(!$user = User::getBy("id", User::validate_token($_SESSION["token"])["user_id"])) {
	die("user_session");
}
?>

<div class="ui segment blue">
	<div class="uk-padding-small">
		<div class="ui header dividing color blue">
			<h3 class="ui header blue">
				<i class="ui box icon"></i> <?=Translator::translate("Stock")?>
			</h3>
		</div>
		<a class="ui basic button blue zn-link-dialog" href="<?=Helper::url("api/stock/add_form.php")?>">
			<i class="ui plus icon"></i> <?=Translator::translate("Add Stock")?>
		</a>
	</div>
	<div class="uk-margin">
		<div align="center" class="ui segment spacked purple uk-width-small">
			<div class="ui statistic purple">
			    <div class="value">
			      <?=Stock::getAll()->rowCount()?>
			    </div>
			    <div class="label">
			      <?=Translator::translate("total")?>
			    </div>
			</div>
		</div>
	</div>
	<div class="uk-margin-top" style="margin-left: 10px;">
		<table class="ui small table color blue inverted selectable stripped">
			<thead>
				<tr>
					<th><?=Translator::translate("Id");?></th>
					<th><?=Translator::translate("name");?></th>
					<th><?=Translator::translate("Stock type");?></th>
					<th><?=Translator::translate("Quantity");?></th>
					<th><?=Translator::translate("Warehouse");?></th>
					<th><?=Translator::translate("Price of sale");?></th>
					<th><?=Translator::translate("Prices");?></th>
					<th><?=Translator::translate("Date added")?></th>
					<th><?=Translator::translate("User added");?></th>
					<th><?=Translator::translate("Date modify");?></th>
					<th><?=Translator::translate("User modify");?></th>
					<th><?=Translator::translate("Actions");?></th>
				</tr>
				<tr>
					<th><?=Translator::translate("Id");?></th>
					<th><?=Translator::translate("name");?></th>
					<th><?=Translator::translate("Stock type");?></th>
					<th><?=Translator::translate("Quantity");?></th>
					<th><?=Translator::translate("Warehouse");?></th>
					<th><?=Translator::translate("Price of sale");?></th>
					<th><?=Translator::translate("Prices");?></th>
					<th><?=Translator::translate("Date added")?></th>
					<th><?=Translator::translate("User added");?></th>
					<th><?=Translator::translate("Date modify");?></th>
					<th><?=Translator::translate("User modify");?></th>
					<th><?=Translator::translate("Actions");?></th>
				</tr>
			</thead>
			<tbody></tbody>
			<tfoot>
				<th><?=Translator::translate("Id");?></th>
				<th><?=Translator::translate("name");?></th>
				<th><?=Translator::translate("Stock type");?></th>
				<th><?=Translator::translate("Quantity");?></th>
				<th><?=Translator::translate("Warehouse");?></th>
				<th><?=Translator::translate("Price of sale");?></th>
				<th><?=Translator::translate("Prices");?></th>
				<th><?=Translator::translate("Date added")?></th>
				<th><?=Translator::translate("User added");?></th>
				<th><?=Translator::translate("Date modify");?></th>
				<th><?=Translator::translate("User modify");?></th>
				<th><?=Translator::translate("Actions");?></th>
			</tfoot>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(".ui.dropdown").dropdown();
	/* Datatable */
	var columns = [
		{
			name: "<?=Translator::translate("Id");?>",
			data: "id",
			visible: true,
		},
		{
			name: "<?=Translator::translate("name");?>",
			data: "name",
			visible: true,
		},
		{
			name: "<?=Translator::translate("Stock type");?>",
			data: "type",
			visible: true,
		},
		{
			name: "<?=Translator::translate("Quantity");?>",
			data: "quantity",
			visible: true,
		},
		{
			name: "<?=Translator::translate("Warehouse");?>",
			data: "warehouse",
			visible: false,
		},
		{
			name: "<?=Translator::translate("Price of sale");?>",
			data: "price_sale",
			visible: true,
		},
		{
			name: "<?=Translator::translate("Prices");?>",
			data: "prices",
			visible: true,
		},
		{
			name: "<?=Translator::translate("Date added");?>",
			data: "date_added",
			visible: false,
		},
		{
			name: "<?=Translator::translate("User added");?>",
			data: "user_added",
			visible: false,
		},
		{
			name: "<?=Translator::translate("Date modify");?>",
			data: "date_modify",
			visible: false,
		},
		{
			name: "<?=Translator::translate("User modify");?>",
			data: "user_modify",
			visible: false,
		},
		{
			name: "<?=Translator::translate("Actions");?>",
			data: "actions",
			visible: true,
		},
	];
	/* Gravando as colunas no local storage */
	if(!localStorage.getItem("stock_cols")) {
		localStorage.setItem("stock_cols", JSON.stringify(columns));
	} else {
		var colunas_local = JSON.parse(localStorage.getItem("stock_cols"));
		/* Verificando actualização do json */
		for(var i = 0; i < columns.length; i ++) {
			if(
				colunas_local[i].name != columns[i].name || 
				colunas_local[i].data != columns[i].data ||
				Object.keys(colunas_local[i])[0] != Object.keys(columns[i])[0] ||
				Object.keys(colunas_local[i])[1] != Object.keys(columns[i])[1]
			) {
				localStorage.setItem("stock_cols", JSON.stringify(columns));
				break;
			}
		}
	}
	/* Filtros no footer da tabela */
	$(".ui.table thead tr:eq(1) th").each(function(index) {
		var title = $(this).text();
    	$(this).html("<div class=\"ui input mini compact\"><input class=\"\" type=\"text\" placeholder=\"Search " + title + "\"/></div>");
    	/* Save index to element */
    	$("input", this).attr("column_index", index);
	});
	var table = $(".ui.table").DataTable({
		bDestroy: true,
		lengthChange: true,
		orderCellsTop: true,
		lengthMenu: [
			[10, 25, 50, 75, 100, 250, 500, 750, 1000, -1],
			[10, 25, 50, 75, 100, 250, 500, 750, 1000, "Todos"],
		],
		buttons: [
			{
				extend: "excel",
				title: "<?=Translator::translate("Stock")?>",
				text: "<i class=\"icon file excel green\"></i> Excel",
			},
			{
				extend: "pdf",
				title: "<?=Translator::translate("Stock")?>",
				text: "<i class=\"icon file pdf red\"></i> Pdf",
			},
			{
				text: "<i class=\"icon sync\"></i>",
				action: function (e, dt, node, config) {
					dt.ajax.reload();
				}
			}
		],
		search: {
			"case-insensitive": false,
		},
		processing: true,
		serverSide: true,
		responsive: true,
		ajax: {
	    	url: "<?=Helper::url("api/stock/get_list.php")?>",
	        type: "post",
	        enctype: "multipart/form-data",
	    },
		order: [
			[ 1, "desc" ]
		],
		columns: JSON.parse(localStorage.getItem("stock_cols")),
		initComplete: function(settings, json) {
			table.buttons().container().appendTo($("div.eight.column:eq(0)", table.table().container()));
			$("div.loading").remove();
			$(".dt-buttons.ui.basic.buttons").addClass("blue tiny").removeClass("basic");
			$(".selection.ui.dropdown").addClass("tiny");
			/* Add scroll bar */
			$(".ui.table").parent().attr("style", "overflow-x: scroll; scrollbar-width: thin;");
			/* Adiciona botão para filtar colunas */
			$(".dt-buttons.ui.buttons").append(function() {
				return (!$(".visible-columns-button").html() ? "<button class=\"visible-columns-button ui button tiny blue\" key=\"stock_cols\"><i class=\"list icon\"></i> Visible columns</button>" : "");
			});

			/* Footer search */
            $("input", table.table().header().closest("thead")).on("keyup change clear", function() {
            	var that = this;
            	table.columns().every(function (i) {
            		if(table.column(this).index() == $(that).attr("column_index")) {
            			if(table.column($(that).attr("column_index")).search() !== that.value) {
							table.column($(that).attr("column_index")).search(that.value).draw();
	                    }
            		}
	            });
            });
		},
		language: {
			"lengthMenu": "<?=Translator::translate("lengthMenu");?>",
	        "zeroRecords": "<?=Translator::translate("zeroRecords");?>",
	        "info": "<?=Translator::translate("info");?>",
	        "infoEmpty": "<?=Translator::translate("infoEmpty");?>",
	        "infoFiltered": "(<?=Translator::translate("infoFiltered");?>)",    
	        "loadingRecords": "<?=Translator::translate("loadingRecords");?>...",
	        "processing":     "<?=Translator::translate("processing");?>...",
	        "search":         "<?=Translator::translate("search");?>:",
	        "paginate": {
	          "first":      "<?=Translator::translate("first");?>",
	          "last":       "<?=Translator::translate("last");?>",
	          "next":       "<?=Translator::translate("next");?>",
	          "previous":   "<?=Translator::translate("previous");?>"
	        },
	    },
	});
</script>