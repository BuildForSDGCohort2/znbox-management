<?php

require __DIR__."/../../autoload.php";

use emagombe\DataTable;
use controller\Sale;
use controller\Customer;
use controller\Helper;
use controller\Invoice;
use controller\Proforma;
use controller\Translator;
use controller\User;


$table = DataTable::create(Sale::getAll()->fetchAll());

$table->addColumn("customer", function($row) {
	return Customer::getBy("id", $row["customer"])["name"];
});
$table->addColumn("discount", function($row) {
	return Helper::formatnumber(Sale::getTotalDiscount($row["id"]));
});
$table->addColumn("total", function($row) {
	return Helper::formatnumber(Sale::getTotal($row["id"]));
});
$table->addColumn("total_with_vat", function($row) {
	return Helper::formatnumber(Sale::getTotal($row["id"], true));
});
$table->addColumn("date_added", function($row) {
	return Helper::datetime($row["date_added"]);
});
$table->addColumn("date_modify", function($row) {
	return Helper::datetime($row["date_modify"]);
});
$table->addColumn("user_added", function($row) {
	$user = User::getBy("id", $row["user_added"]);
	return $user["first"]." ".$user["last"];
});
$table->addColumn("user_modify", function($row) {
	$user = User::getBy("id", $row["user_modify"]);
	return $user["first"]." ".$user["last"];
});
$table->addColumn("actions", function($row) {
	$content = "";
	$content .= '
		<a class="ui mini circular icon button violet zn-link-dialog" href="'.Helper::url("api/sale/view.php?id=".$row["id"]).'" data-tooltip="'.Translator::translate("view details").'">
			<i class="ui eye icon"></i>
		</a>';
	$invoice = Invoice::getBy("sale", $row["id"]);
	$proforma = Proforma::getBy("sale", $row["id"]);
	if((!$invoice && !$proforma) || (($invoice && $invoice["status"] == 0) && ($invoice && $proforma["status"] == 0))) {
		$content .= '
			<a class="ui mini circular icon button green zn-link" href="'.Helper::url("api/sale/edit_form.php?id=".$row["id"]).'" data-tooltip="'.Translator::translate("edit details").'">
				<i class="ui edit icon"></i>
			</a>';
		$content .= '
			<a class="ui mini circular icon button red zn-link-dialog" href="'.Helper::url("api/sale/delete_form.php?id=".$row["id"]).'" data-tooltip="'.Translator::translate("delete").'">
				<i class="ui edit icon"></i>
			</a>';
		$content .= '
			<a class="ui mini circular icon button red zn-link-dialog" href="'.Helper::url("api/sale/delete_form.php?id=".$row["id"]).'" data-tooltip="'.Translator::translate("delete").'">
				<i class="ui trash alternate icon"></i>
			</a>';
		$content .= '
			<a class="ui mini circular icon button red zn-link-dialog" href="'.Helper::url("api/sale/confirm_generate_proforma.php?id=".$row["id"]).'" data-tooltip="'.Translator::translate("Generate invoice").'">
				<i class="file alternate icon"></i>'.Translator::translate("Generate proforma").'
			</a>';
	} else {
		if($invoice && $invoice["status"] != 0) {
			$content .= '
            	<a class="ui mini circular icon button purple zn-link-print" data-href="'.Helper::url("print-invoice?type=1&id=".$row["id"]).'">
	                <i class="file alternate icon"></i>
	                '.Translator::translate("Print invoice").'
	            </a>';
        } else {
        	$content .= '
	        	<a class="ui primary mini circular icon button zn-link-dialog" href="'.Helper::url("api/sale/confirm_generate_invoice.php?id=".$row["id"]).'" >
	                <i class="file alternate icon"></i>
	                '.Translator::translate("Generate invoice").'
	            </a>';
    	}
        if($proforma && $proforma["status"] != 0) {
        	$content .= '
	            <a class="ui mini circular icon button purple zn-link-print" data-href="'.Helper::url("print-proforma?type=1&id=".$row["id"]).'">
	                <i class="file alternate icon"></i>
	                '.Translator::translate("Print proforma").'
	            </a>';
        } else {
        	$content .= '
	        	<a class="ui primary mini circular icon button zn-link-dialog" href="'.Helper::url("api/sale/confirm_generate_proforma.php?id=".$row["id"]).'">
	                <i class="file alternate icon"></i>
	                '.Translator::translate("Generate proforma").'
	            </a>';
        }
    }
	return $content;
});
$table->addColumn("id", function($row) {
	return $row["id"];
});
$table->stream();