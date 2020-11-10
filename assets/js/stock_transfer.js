/* Add item to table */
var add_to_table_stock_transfer = function(line) {
	line = $('.stock_transfer-table tbody').append(line).children("tr:last-child");

	var stock = $(line).find(".stock_transfer-table-line-stock")[0];

	if(typeof $(".stock_transfer-table").find('tbody tr')[0] != "undefined") {
		var aux_stock = $(".stock_transfer-table").find('tbody tr')[0].children[1];
		$(stock).html($(aux_stock).html());
	}
};

/* Remove item from table */
var remove_from_table_stock_transfer = function(line) {
	line.parent().parent().remove();
};


function get_stock_transfer_line(stock_transfer_url) {
	/* get line of table sale */
	$.ajax({
		url: stock_transfer_url,
		type: 'GET',
		dataType: 'html',
		beforeSend: function() {
			progress_loading();
		},
	})
	.done(function(response) {
		window.stock_transfer_table_line = response;
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

/* Init */
get_stock_transfer_line();

var stock_previous = 0;
/* On change of stock */
$(document).on('change', '.stock_transfer-table-line-stock', function(e) {
	e.preventDefault();

	stock_previous = $('option:selected', this).attr("price");
});

/* On change of stock */
$(document).on('change', '.stock_transfer-table-line-stock', function(e) {
	e.preventDefault();
	var stock_available = $('option:selected', this).attr("stock");
	var quantity = $(this).parent().parent().find(".stock_transfer-table-line-quantity")[0];

	/* Stock available */
	var stock_av = $(this).parent().parent().find(".stock_transfer-table-line-stock-available")[0];
	$(stock_av).text(parseFloat(stock_available));
});

/* On change of quantity */
$(document).on('keyup paste blur', '.stock_transfer-table-line-quantity', function(e) {
	//e.preventDefault();

	/* Handling quantity text */
	if(isNaN(parseFloat($(this).val()))) {
		$(this).val(0);
	}

	var stock = $(this).parent().parent().parent().find(".stock_transfer-table-line-stock")[0];
	var selected_stock = $('option:selected', stock).attr("value");

	var quantity = $(this).parent().parent().parent().find(".stock_transfer-table-line-quantity")[0];

	var stock = $(".stock_transfer-table").find('tbody tr');
	/* Counting total of quantity of current product */
	var selected_stock_quantity = 0;
	for (var i = 0; i < stock.length; i++) {
		var row = stock[i];
		var quantity = $($(row).find(".stock_transfer-table-line-quantity")[0]).val();
		var stock_id = $('option:selected', $(row).find(".stock_transfer-table-line-stock")[0]).attr("value");

		if(selected_stock == stock_id) {
			selected_stock_quantity += (quantity) ? parseFloat(quantity) : 0;
		}
	}
	for (var i = 0; i < stock.length; i++) {
		var row = stock[i];

		var stock_id = $('option:selected', $(row).find(".stock_transfer-table-line-stock")[0]).attr("value");

		if(selected_stock == stock_id) {
			/* Stock available update */
			var stock_av = $(row).find(".stock_transfer-table-line-stock-available")[0];
			var stock_available = $('option:selected', $(row).find(".stock_transfer-table-line-stock")[0]).attr("stock");
			
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
	}
});

/* Add line to table */
$(document).on('click', '.stock_transfer-table-add-line', function(e) {
	e.preventDefault();
	add_to_table_stock_transfer(window.stock_transfer_table_line);
	$(".ui.dropdown").dropdown({ on: "click" });
});

/* Remove line from table */
$(document).on('click', '.stock_transfer-table-remove-line', function(e) {
	e.preventDefault();
	remove_from_table_stock_transfer($(this));
});