//  Display progress loader on screen
var progress_loading = function(xhr) {
	$(".mdl-spinner.mdl-js-spinner").addClass('is-active');
};

//  Remove the progress loader
var progress_loaded = function(xhr) {
	setTimeout(function() {
		$(".mdl-spinner.mdl-js-spinner").removeClass('is-active');
	}, 1000);
	UIkit.offcanvas('#mobile_sidebar').hide();
};

// When application initializes
var init = function() {
	if(!window.location.href.endsWith('authentication') && !window.location.href.endsWith('authentication/')) {
		change_content({}, 'user/home');
		startTime();
		setTimeout(function() {
			$('.splashscreen').fadeOut();
		}, 3000);
	}
};

var home_url = $("#znbox").attr("href");

// Function to change the content
var change_content = function(data, href) {
	$.ajax({
		url: href,
		type: 'GET',
		dataType: 'html',
		data: data,
		beforeSend: function() {
			progress_loading();
		},
		success: function(response) {
			$('#content').html(response);
			progress_loaded();
		},
		error: function(error) {
			progress_loaded();
			UIkit.notification({
			    message: 'Falha ao enviar pedido! Verifique a tua conexão a internet!',
			    status: 'danger',
			    pos: 'top-right',
			    timeout: 3000,
			});
		}
	});
};

/* Request send */
var send_request = function(_method, _type, _data, href, callback) {
	$.ajax({
		url: href,
		type: _method,
		dataType: _type,
		beforeSend: function() {
			progress_loading();
		},
		data: _data,
	})
	.done(function(response) {
		callback(response);
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
}

// Function to change the content
var submit_simple_data = function(data, href) {
	$.ajax({
		url: href,
		type: 'POST',
		dataType: 'json',
		data: data,
		beforeSend: function() {
			progress_loading();
		},
		success: function(response) {
			if(response == 'reload') { window.location.reload(); };
			UIkit.notification({
			    message: response.message,
			    status: response.status,
			    pos: 'top-right',
			    timeout: 3000,
			});
			progress_loaded();
			get_line();	// From sales.js to update itens line
			getPurchaseLine();
		}
	}).fail(function(error) {
		if(error.status == 200) {
			if(error.responseText == 'reload') { window.location.reload(); };
		} else {
			UIkit.notification({
			    message: 'Falha ao enviar pedido! Verifique a tua conexão a internet!',
			    status: 'danger',
			    pos: 'top-right',
			    timeout: 3000,
			});
		}
		progress_loaded();
	});
};

// Function to open dialog
var open_dialog = function(data, href) {
	$.ajax({
		url: href,
		type: 'GET',
		dataType: 'html',
		data: data,
		beforeSend: function() {
			progress_loading();
		},
		success: function(response) {
			window.dialog = $(response).modal({
				blurring: false,
				autofocus: false,
				inverted: true,
				observeChanges: true,
				closable: false,
				duration: 300,
				allowMultiple: false,
			}).modal('show');
			progress_loaded();
		},
		error: function(error) {
			progress_loaded();
			UIkit.notification({
			    message: 'Falha ao enviar pedido! Verifique a tua conexão a internet!',
			    status: 'danger',
			    pos: 'top-right',
			    timeout: 3000,
			});
		}
	});
};

// Navegate changing the content
$(document).on('click', '.zn-link', function(event) {
	var _this = $(this);
	var data = (_this.attr('data') != "") ? { id: _this.attr('data')} : {};
	change_content(data, _this.attr('href'));
	get_line();	// From sales.js to update itens line
	getPurchaseLine();
	return false;
});

// Navegate opening dialogs
$(document).on('click', '.zn-link-dialog', function(event) {
	var _this = $(this);
	var data = (_this.attr('data') != "") ? { id: _this.attr('data')} : {};
	open_dialog(data, _this.attr('href'));
	get_line();	// From sales.js to update itens line
	getPurchaseLine();
	return false;
});

// Submitting complex forms
$(document).on('submit', 'form.zn-form-complex', function(event) {
	var _this = $(this);
	$.ajax({
		url: $(this).attr('action'),
		type: 'POST',
		dataType: 'json',
		processData: false,
		data: new FormData(_this[0]),
		cache: false,
		contentType: false,
		enctype: 'multipart/form-data',
		beforeSend: function() {
			_this.addClass('loading');
		},
		success: function(response) {
			if(response.status ==  'success') {
				if(!window.location.href.endsWith('authentication') && !window.location.href.endsWith('authentication/')) {
					UIkit.notification({
					    message: response.message,
					    status: response.status,
					    pos: 'top-right',
					    timeout: 3000,
					});

					change_content(response.data, response.href);
					get_line();	// From sales.js to update itens line
					getPurchaseLine();
					if(window.dialog) {
						window.dialog.modal('hide');
					}
				} else {
					window.location.href = home_url;
				}
			} else {
				UIkit.notification({
				    message: response.message,
				    status: response.status,
				    pos: 'top-right',
				    timeout: 3000,
				});
			}
			_this.removeClass('loading');
		},
		error: function(error) {
			_this.removeClass('loading');
			UIkit.notification({
			    message: 'Failed to send request! Please check your internet connection!',
			    status: 'danger',
			    pos: 'top-right',
			    timeout: 3000,
			});
		}
	});
	return false;
});

// Submitting normal forms
$(document).on('submit', 'form.zn-form', function(event) {
	var _this = $(this);
	$.ajax({
		url: $(this).attr('action') + ($(this).attr('data') ? '?id=' + $(this).attr('data') : ''),
		type: 'POST',
		dataType: 'json',
		data: $(this).serialize(),
		beforeSend: function() {
			_this.addClass('loading');
		},
		success: function(response) {
			if(response.status ==  'success') {
				if(!window.location.href.endsWith('authentication') && !window.location.href.endsWith('authentication/')) {
					UIkit.notification({
					    message: response.message,
					    status: response.status,
					    pos: 'top-right',
					    timeout: 3000,
					});

					change_content(response.data, response.href);
					get_line();	// From sales.js to update itens line
					getPurchaseLine();
					if(window.dialog) {
						window.dialog.modal('hide');
					}
				} else {
					window.location.href = home_url;
				}
			} else {
				UIkit.notification({
				    message: response.message,
				    status: response.status,
				    pos: 'top-right',
				    timeout: 3000,
				});
			}
			_this.removeClass('loading');
		},
		error: function(error) {
			_this.removeClass('loading');
			UIkit.notification({
			    message: 'Failed to send request! Please check your internet connection!',
			    status: 'danger',
			    pos: 'top-right',
			    timeout: 3000,
			});
		}
	});
	return false;
});

// Submitting form update
$(document).on('submit', 'form.zn-form-update', function(event) {
	var _this = $(this);
	$.ajax({
		url: $(this).attr('action'),
		type: 'POST',
		dataType: 'json',
		data: $(this).serialize() + '&id=' + $(this).attr('data'),
		beforeSend: function() {
			_this.addClass('loading');
		},
		success: function(response) {
			if(response.status ==  'success') {
				if(!window.location.href.endsWith('authentication') && !window.location.href.endsWith('authentication/')) {
					UIkit.notification({
					    message: response.message,
					    status: response.status,
					    pos: 'top-right',
					    timeout: 3000,
					});

					change_content(response.data, response.href);
					if(window.dialog) {
						window.dialog.modal('hide');
					}
				} else {
					window.location.href = home_url;
				}
			} else {
				UIkit.notification({
				    message: response.message,
				    status: response.status,
				    pos: 'top-right',
				    timeout: 3000,
				});
			}
			_this.removeClass('loading');
		},
		error: function(error) {
			_this.removeClass('loading');
			UIkit.notification({
			    message: 'Failed to send request! Please check your internet connection!',
			    status: 'danger',
			    pos: 'top-right',
			    timeout: 3000,
			});
		}
	});
	return false;
});

// Submitting form update
$(document).on('submit', 'form.zn-form-complex-update', function(event) {
	var _this = $(this);
	var fd = new FormData(_this[0]);
	fd.append('id', $(this).attr('data'));
	$.ajax({
		url: $(this).attr('action'),
		type: 'POST',
		dataType: 'json',
		processData: false,
		data: fd,
		cache: false,
		contentType: false,
		enctype: 'multipart/form-data',
		beforeSend: function() {
			_this.addClass('loading');
		},
		success: function(response) {
			if(response.status ==  'success') {
				if(!window.location.href.endsWith('authentication') && !window.location.href.endsWith('authentication/')) {
					UIkit.notification({
					    message: response.message,
					    status: response.status,
					    pos: 'top-right',
					    timeout: 3000,
					});

					change_content(response.data, response.href);
					get_line();	// From sales.js to update itens line
					getPurchaseLine();
					if(window.dialog) {
						window.dialog.modal('hide');
					}
				} else {
					window.location.href = home_url;
				}
			} else {
				UIkit.notification({
				    message: response.message,
				    status: response.status,
				    pos: 'top-right',
				    timeout: 3000,
				});
			}
			_this.removeClass('loading');
		},
		error: function(error) {
			_this.removeClass('loading');
			UIkit.notification({
			    message: 'Failed to send request! Please check your internet connection!',
			    status: 'danger',
			    pos: 'top-right',
			    timeout: 3000,
			});
		}
	});
	return false;
});

// Switch button Change
$(document).on('change', '.zn-switch-button', function(e) {
	if($(this).is(':checked')) { $(this).attr('value', 1) }
	if(!$(this).is(':checked')) { $(this).attr('value', 0) }

	submit_simple_data({
		status: $(this).val(),
		id: $(this).attr('data'),
	}, $(this).attr('href'));
});

// Dropdown Change
$(document).on('change', 'select[dropdown=zn-dropdown]', function(e) {
	submit_simple_data({
		status: $(this).val(),
		id: $(this).attr('data'),
	}, $(this).attr('href'));
});

/* Change language */
$(document).on('change', 'input[id=pt]', function(event) {
	submit_simple_data({
		status: $(this).val(),
		lang: 'pt',
	}, $(this).attr('href'));
});
$(document).on('change', 'input[id=eng]', function(event) {
	submit_simple_data({
		status: $(this).val(),
		lang: 'eng',
	}, $(this).attr('href'));
});

$(document).on('change', '.zn-radiobox', function(event) {
	submit_simple_data({
		status: ($(this).is(':checked') ? 1 : 0),
		id: $(this).attr('data'),
	}, $(this).attr('href'));
});

/* Print document */
$(document).on('click', '.zn-link-print', function(event) {
	event.preventDefault();
	var link = $(this).attr('data-href');
	var print = window.open(link);
	print.focus();
});

/* Time counter */
function startTime() {
	var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    
    if(h == 0){
        h = 12;
    }
    
    if(h > 12){
        h = h - 12;
        session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var time = h + ":" + m + ":" + s + " " + session;
    $('.zn-clock').html(time);
    
    setTimeout(startTime, 1000);
}
function checkTime(i) {
	if (i < 10) { i = "0" + i };  // add zero in front of numbers < 10
	return i;
}


/* Logout session */

var session_time = 1000;
var warning_time = 30;

window.__time = session_time;

var logout = function() {
	window.location.href = 'authentication';
};

var reset_time = function() {
	window.__time = session_time;
	$('#session_warning').modal('hide');
};

window.__time_progress = $(".session_warning_progress").progress({
	total : warning_time,
	autoSuccess : false,
});

var time_counter_interval = setInterval(function() {
	if(!window.location.pathname.endsWith('/home')) {
		clearInterval(time_counter_interval);
	}

	if(window.__time > 0) {
		window.__time -= 1;
	}
	if(window.__time == warning_time) {
		$('#session_warning').modal('show');
	}
	if(window.__time <= 0) {
		clearInterval(time_counter_interval);
		logout();
	}

	if(window.__time <= warning_time) {
		window.__time_progress.progress({
			percent : window.__time * 100 / warning_time
		});
	}
	if(window.__time > 0 ) {
		$('.left_seconds').html('<span class="uk-animation-scale-down">' + window.__time + '</span>');
	}

}, 1000);

$(document).bind('click mousemove keyup mousedown onscroll keypress touchmove', function(event) {
	reset_time();
});


/* Initialize the application */
init();
/* End initialize */