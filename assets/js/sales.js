var total = 0;
var subtotal = 0;
var vat = 0;
var vat_tax = 0.17;

var sale_line_url = $("#znbox-sale-line").attr("href");

/* Add item to table */
var add_to_table = function(line) {
	line = $('.stock-table tbody').append(line).children("tr:last-child");

	var stock = $(line).find(".stock-table-line-stock")[0];
	var price_value = $('option:selected', stock).attr("price");
	var quantity = $(line).find(".stock-table-line-quantity")[0];
	var stock_available = $('option:selected', stock).attr("stock");

	if(typeof $(".stock-table").find('tbody tr')[0] != "undefined") {
		var aux_stock = $(".stock-table").find('tbody tr')[0].children[1];
		$(stock).html($(aux_stock).html());
	}
	
	/* Price */
	var price = $(line).find(".stock-table-line-price")[0];
	$(price).text(price_value * $(quantity).val());

	/* Price per unity */
	var price_unity = $(line).find(".stock-table-line-price-unity")[0];
	$(price_unity).text(price_value);

	/* Stock available */
	//var stock_av = $(line).find(".stock-table-line-stock-available")[0];
	//$(stock_av).text(parseFloat(stock_available) - $(quantity).val());

	/* set max */
	//$(stock_av).attr('max', parseFloat(stock_available));

	stock = $(".stock-table").find('tbody tr');
	subtotal = 0;
	for (var i = 0; i < stock.length; i++) {
		var row = stock[i];
		var price_value = $($(row).find(".stock-table-line-price")[0]).text();
		/* Sum subtotal */
		subtotal += Number(price_value);
	}

	/* Update values */
	$(quantity).trigger('paste');

	/* Total */
	vat = parseFloat((subtotal * vat_tax).toFixed(2));
	total = parseFloat((vat + subtotal).toFixed(2));

	/* Total */
	$(".stock-table-total-vat").text(total);
	/* VAT */
	$(".stock-table-vat").text(vat);
	/* Subtotal */
	$(".stock-table-subtotal").text(subtotal);
};

/* Remove item from table */
var remove_from_table = function(line) {
	stock = line.parent().parent().find(".stock-table-line-stock")[0];
	var price_value = $('option:selected', stock).attr("price");

	line.parent().parent().remove();

	var stock = $(".stock-table").find('tbody tr');
	subtotal = 0;

	for (var i = 0; i < stock.length; i++) {
		var row = stock[i];
		var price_value = $($(row).find(".stock-table-line-price")[0]).text();
		/* Sum subtotal */
		subtotal += Number(price_value);
	}
	/* Total */
	vat = parseFloat((subtotal * vat_tax).toFixed(2));
	total = parseFloat((vat + subtotal).toFixed(2));

	/* Total */
	$(".stock-table-total-vat").text(total);
	/* VAT */
	$(".stock-table-vat").text(vat);
	/* Subtotal */
	$(".stock-table-subtotal").text(subtotal);
};


function get_line() {
	/* get line of table sale */
	$.ajax({
		url: sale_line_url,
		type: 'GET',
		dataType: 'html',
		beforeSend: function() {
			progress_loading();
		},
	})
	.done(function(response) {
		window.stock_table_line = response;
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
};

/* Update */
function update() {
	vat_tax = parseFloat($('#tax_percentage').val()) / 100;

	var stock = $(".stock-table").find('tbody tr');
	subtotal = 0;

	for (var i = 0; i < stock.length; i++) {
		var row = stock[i];
		var price_value = $($(row).find(".stock-table-line-price")[0]).text();
		/* Sum subtotal */
		subtotal += Number(price_value);
	}
	/* Total */
	vat = parseFloat((subtotal * vat_tax).toFixed(2));
	total = parseFloat((vat + subtotal).toFixed(2));

	/* Total */
	$(".stock-table-total-vat").text(total);
	/* VAT */
	$(".stock-table-vat").text(vat);
	/* Subtotal */
	$(".stock-table-subtotal").text(subtotal);
}

/* Init */
get_line();

var stock_previous = 0;
/* On change of stock */
$(document).on('change', '.stock-table-line-stock', function(e) {
	e.preventDefault();

	stock_previous = $('option:selected', this).attr("price");
});

/* On change of stock */
$(document).on('change', '.stock-table-line-stock', function(e) {
	e.preventDefault();
	var price_value = $('option:selected', this).attr("price");
	var stock_available = $('option:selected', this).attr("stock");
	var quantity = $(this).parent().parent().find(".stock-table-line-quantity")[0];

	/* Stock available */
	var stock_av = $(this).parent().parent().find(".stock-table-line-stock-available")[0];
	$(stock_av).text(parseFloat(stock_available));

	/* Price */
	var price = $(this).parent().parent().find(".stock-table-line-price")[0];
	$(price).text(price_value * $(quantity).val());

	/* Price per unity */
	var price_unity = $(this).parent().parent().find(".stock-table-line-price-unity")[0];
	$(price_unity).text(price_value);

	var stock = $(".stock-table").find('tbody tr');
	subtotal = 0;
	for (var i = 0; i < stock.length; i++) {
		var row = stock[i];
		var price_value = $($(row).find(".stock-table-line-price")[0]).text();
		/* Sum subtotal */
		subtotal += Number(price_value);
	}

	/* Update values */
	$(quantity).trigger('paste');

	/* Total */
	vat = parseFloat((subtotal * vat_tax).toFixed(2));
	total = parseFloat((vat + subtotal).toFixed(2));

	/* Total */
	$(".stock-table-total-vat").text(total);
	/* VAT */
	$(".stock-table-vat").text(vat);
	/* Subtotal */
	$(".stock-table-subtotal").text(subtotal);
});

/* On change of quantity */
$(document).on('keyup paste blur', '.stock-table-line-quantity', function(e) {
	//e.preventDefault();

	/* Handling quantity text */
	if(isNaN(parseFloat($(this).val()))) {
		$(this).val(0);
	}

	var stock = $(this).parent().parent().parent().find(".stock-table-line-stock")[0];
	var selected_stock = $('option:selected', stock).attr("value");

	var price_value = $('option:selected', stock).attr("price");
	var quantity = $(this).parent().parent().parent().find(".stock-table-line-quantity")[0];

	/* Price */
	var price = $(this).parent().parent().parent().find(".stock-table-line-price")[0];
	$(price).text(price_value * $(this).val());

	/* Price per unity */
	var price_unity = $(this).parent().parent().parent().find(".stock-table-line-price-unity")[0];
	$(price_unity).text(price_value);

	var stock = $(".stock-table").find('tbody tr');
	subtotal = 0;
	/* Counting total of quantity of current product */
	var selected_stock_quantity = 0;
	for (var i = 0; i < stock.length; i++) {
		var row = stock[i];
		var quantity = $($(row).find(".stock-table-line-quantity")[0]).val();
		var stock_id = $('option:selected', $(row).find(".stock-table-line-stock")[0]).attr("value");

		if(selected_stock == stock_id) {
			selected_stock_quantity += (quantity) ? parseFloat(quantity) : 0;
		}
	}
	for (var i = 0; i < stock.length; i++) {
		var row = stock[i];
		var price_value = $($(row).find(".stock-table-line-price")[0]).text();

		var stock_id = $('option:selected', $(row).find(".stock-table-line-stock")[0]).attr("value");

		if(selected_stock == stock_id) {
			/* Stock available update */
			var stock_av = $(row).find(".stock-table-line-stock-available")[0];
			var stock_available = $('option:selected', $(row).find(".stock-table-line-stock")[0]).attr("stock");
			
			/* SUM of quantities from same stock is greater that available stock */
			if(selected_stock_quantity > parseFloat(stock_available)) {
				if((parseFloat(stock_available) - selected_stock_quantity) < 0) {
					$(this).val(0);
					$(stock_av).text(0);
				} else {
					$(stock_av).text(parseFloat(stock_available) - selected_stock_quantity);
				}
			} else {
				if((parseFloat(stock_available) - selected_stock_quantity) < 0) {
					$(stock_av).text(0);
				} else {
					$(stock_av).text(parseFloat(stock_available) - selected_stock_quantity);
				}
			}
		}
		
		/* Sum subtotal */
		subtotal += Number(price_value);
	}

	/* Total */
	vat = parseFloat((subtotal * vat_tax).toFixed(2));
	total = parseFloat((vat + subtotal).toFixed(2));

	/* Total */
	$(".stock-table-total-vat").text(total);
	/* VAT */
	$(".stock-table-vat").text(vat);
	/* Subtotal */
	$(".stock-table-subtotal").text(subtotal);
});

/* Add line to table */
$(document).on('click', '.stock-table-add-line', function(e) {
	e.preventDefault();
	add_to_table(window.stock_table_line);
	$(".ui.dropdown").dropdown({ on: "click" });
});

/* Remove line from table */
$(document).on('click', '.stock-table-remove-line', function(e) {
	e.preventDefault();
	remove_from_table($(this));
});



