

/* Get purchase line */
function getPurchaseLine() {
	$.ajax({
		url: "endpoint/purchase/line.php",
		type: "GET",
		dataType: "html",
		beforeSend: function() {
			progress_loading();
		},
	})
	.done(function(response) {
		window.purchase_line = response;
	})
	.fail(function() {
		UIkit.notification({
		    message: "Falha ao enviar pedido! Verifique a tua conexão a internet!",
		    status: "danger",
		    pos: "top-right",
		    timeout: 3000,
		});
	})
	.always(function() {
		progress_loaded();
	});
}

/* Add line to purchase table */
$(document).on("click", ".zn-puchase-table-add-line", function(event) {
	event.preventDefault();

	/* Purchase table body */
	var purchase_table_body = $(".zn-purchase-table tbody");
	var line = window.purchase_line;
	/* Add line to table */
	purchase_table_body.append(line);
});
/* Remove item from purchasetable */
$(document).on("click", ".zn-pruchase-remove-line", function(event) {
	event.preventDefault();
	
	/* Purchase table body */
	var purchase_table_body = $(".zn-purchase-table tbody");
	var line = window.purchase_line;
	/* remove line from table */
	$(this).parent().parent().remove();
});

/* On change of line quantity */
$(document).on("change paste keyup", ".zn-purchase-quantity", function(event) {
	event.preventDefault();
	
	/* If not a number, force to zero */
	if(isNaN(parseFloat($(this).val()))) {
		$(this).val(0);
	}

	var price_label = $(this).parent().parent().parent().find(".zn-purchase-line-total")[0];
	var price_field = $(this).parent().parent().parent().find(".zn-purchase-price-unity")[0];
	/* Calculating total per line */
	var total_price_line = parseFloat($(price_field).val()) * parseFloat($(this).val());
	/* Displaying total price */
	$(price_label).text(total_price_line);
});

/* On change of line price */
$(document).on("change paste keyup", ".zn-purchase-price-unity", function(event) {
	event.preventDefault();
	
	/* If not a number, force to zero */
	if(isNaN(parseFloat($(this).val()))) {
		$(this).val(0);
	}

	var price_label = $(this).parent().parent().parent().find(".zn-purchase-line-total")[0];
	var price_field = $(this).parent().parent().parent().find(".zn-purchase-quantity")[0];
	/* Calculating total per line */
	var total_price_line = parseFloat($(price_field).val()) * parseFloat($(this).val());
	/* Displaying total price */
	$(price_label).text(total_price_line);
});