var total = 0;
var subtotal = 0;
var vat = 0;
var vat_tax = 0.17;


/* Add item to table */
var add_to_table = function(line) {
	line = $('.products-table tbody').append(line).children("tr:last-child");

	var product = $(line).find(".products-table-line-product")[0];
	var price_value = $('option:selected', product).attr("price");
	var quantity = $(line).find(".products-table-line-quantity")[0];
	
	/* Price */
	var price = $(line).find(".products-table-line-price")[0];
	$(price).text(price_value * $(quantity).val());

	/* Price per unity */
	var price_unity = $(line).find(".products-table-line-price-unity")[0];
	$(price_unity).text(price_value);

	/* Total */
	subtotal += Number(price_value);
	vat = subtotal * vat_tax;
	total = vat + subtotal;

	/* Total */
	$(".products-table-total-vat").text(total);
	/* VAT */
	$(".products-table-vat").text(vat);
	/* Subtotal */
	$(".products-table-subtotal").text(subtotal);
};

/* Remove item from table */
var remove_from_table = function(line) {
	product = line.parent().parent().find(".products-table-line-product")[0];
	var price_value = $('option:selected', product).attr("price");

	/* Total */
	subtotal -= Number(price_value);
	vat = subtotal * vat_tax;
	total = vat + subtotal;

	/* Total */
	$(".products-table-total-vat").text(total);
	/* VAT */
	$(".products-table-vat").text(vat);
	/* Subtotal */
	$(".products-table-subtotal").text(subtotal);

	line.parent().parent().remove();
};


/* get line of table */
function get_line() {
	var line;
	$.ajax({
		url: 'endpoint/sale/line.php',
		type: 'GET',
		dataType: 'html',
		async: false,
		beforeSend: function() {
			progress_loading();
		},
	})
	.done(function(response) {
		line = response;
	})
	.fail(function() {
		UIkit.notification({
		    message: 'Falha ao enviar pedido! Verifique a tua conexão a internet!',
		    status: 'danger',
		    pos: 'top-right',
		    timeout: 3000,
		});
	})
	.always(function() {
		progress_loaded();
	});
	return line;
};

/* Init */
window.product_table_line = get_line();

var product_previous = 0;
/* On change of product */
$(document).on('change', '.products-table-line-product', function(e) {
	e.preventDefault();

	product_previous = $('option:selected', this).attr("price");
});

/* On change of product */
$(document).on('change', '.products-table-line-product', function(e) {
	e.preventDefault();
	var price_value = $('option:selected', this).attr("price");
	var quantity = $(this).parent().parent().find(".products-table-line-quantity")[0];
	
	/* Price */
	var price = $(this).parent().parent().find(".products-table-line-price")[0];
	$(price).text(price_value * $(quantity).val());

	/* Price per unity */
	var price_unity = $(this).parent().parent().find(".products-table-line-price-unity")[0];
	$(price_unity).text(price_value);

	/* Total */
	subtotal -= Number(product_previous);
	vat = subtotal * vat_tax;
	total = vat + subtotal;

	/* Total */
	$(".products-table-total-vat").text(total);
	/* VAT */
	$(".products-table-vat").text(vat);
	/* Subtotal */
	$(".products-table-subtotal").text(subtotal);
});

/* On change of quantity */
$(document).on('keyup paste', '.products-table-line-quantity', function(e) {
	e.preventDefault();
	var product = $(this).parent().parent().parent().find(".products-table-line-product")[0];
	var price_value = $('option:selected', product).attr("price");

	/* Price */
	var price = $(this).parent().parent().parent().find(".products-table-line-price")[0];
	$(price).text(price_value * $(this).val());

	/* Price per unity */
	var price_unity = $(this).parent().parent().parent().find(".products-table-line-price-unity")[0];
	$(price_unity).text(price_value);
});

/* Add line to table */
$(document).on('click', '.products-table-add-line', function(e) {
	e.preventDefault();
	add_to_table(window.product_table_line);
	$(".ui.dropdown").dropdown({ on: "click" });
});

/* Remove line from table */
$(document).on('click', '.products-table-remove-line', function(e) {
	e.preventDefault();
	remove_from_table($(this));
});



