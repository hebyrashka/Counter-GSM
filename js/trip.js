document.addEventListener("DOMContentLoaded", function() {
	if ($("input[name='auto']").prop("checked") == true) {
		$("input[name='end_pos']").attr("disabled", "disabled");
		$("input[name='end_pos']").val(null);
	}
	if ($("input[name='auto']").prop("checked") == false) {
		$("input[name='end_pos']").removeAttr("disabled");
	}
	$.ajax({
		url: '../php/ajax/result_show.php',
		type: 'POST',
		data: {'form2': $('form').serialize()},
		dataType: "html",
		success: function(data) {
			if (data != '') {
				$('.km').html(data + " км.");
			}
		}
	});
	$.ajax({
		url: '../php/ajax/litr_gsm.php',
		type: 'POST',
		data: {'form3': $('form').serialize()},
		dataType: "html",
		success: function(data) {
			if (data != '') {
				$('.litr').html(data + " л.");
			}
		}
	});
	$.ajax({
		url: '../php/ajax/ost_litr_gsm.php',
		type: 'POST',
		data: {'form4': $('form').serialize()},
		dataType: "html",
		success: function(data) {
			if (data != '') {
				$('.ost-litr').html(data + " л.");
			}
		}
	});
});
$('.routes-select').change(function() {
	$.ajax({
		url: '../php/ajax/result_show.php',
		type: 'POST',
		data: {'form2': $('form').serialize()},
		dataType: "html",
		success: function(data) {
			if (data != null) {
				$('.km').html(data + " км.");
			}
		}
	});
	$.ajax({
		url: '../php/ajax/litr_gsm.php',
		type: 'POST',
		data: {'form3': $('form').serialize()},
		dataType: "html",
		success: function(data) {
			if (data != null) {
				$('.litr').html(data + " л.");
			}
		}
	});
	$.ajax({
		url: '../php/ajax/ost_litr_gsm.php',
		type: 'POST',
		data: {'form4': $('form').serialize()},
		dataType: "html",
		success: function(data) {
			if (data != null) {
				$('.ost-litr').html(data + " л.");
			}
		}
	});
});
$('#submit-trip').click(function() {
	let dateTrip = $('#date_trip').val();
	let startPos = $('#start_pos').val();
	let endPos = $('#end_pos').val();
	let route = $('#route').val();
	let numberQuery = $('#number_query').val();
	let dateCheck = $('#date_check').val();
	let howLitr = $('#how_litr').val();
	let summa = $('#summa').val();

	let customFile = document.getElementById('customFile');

	let auto = $('#auto').prop("checked");
	if (auto == true) {
		if (dateTrip != "" && startPos != "" && route != "" && numberQuery != "" && dateCheck != "" && howLitr != "" && summa != "") {
			if (customFile.files.length <= 2) {
				$('#form-trip').submit();
			}
		}
		if (dateTrip == "" || startPos == "" || route == "" || numberQuery == "" || dateCheck == "" || howLitr == "" || summa == "") {
			if (dateTrip == "") {
				$('#date_trip').addClass('is-invalid');
			}
			if (startPos == "") {
				$('#start_pos').addClass('is-invalid');
			}
			if (numberQuery == "") {
				$('#number_query').addClass('is-invalid');
			}
			if (dateCheck == "") {
				$('#date_check').addClass('is-invalid');
			}
			if (howLitr == "") {
				$('#how_litr').addClass('is-invalid');
			}
			if (summa == "") {
				$('#summa').addClass('is-invalid');
			}
		}
	}
	if (auto == false) {
		if (dateTrip != "" && startPos != "" && endPos != "" && route != "" && numberQuery != "" && dateCheck != "" && howLitr != "" && summa != "") {
			if (customFile.files.length <= 2) {
				$('#form-trip').submit();
			}
		}
		if (dateTrip != "" || startPos != "" || endPos != "" || route != "" || numberQuery != "" || dateCheck != "" || howLitr != "" || summa != "") {
			if (dateTrip == "") {
				$('#date_trip').addClass('is-invalid');
			}
			if (startPos == "") {
				$('#start_pos').addClass('is-invalid');
			}
			if (endPos == "") {
				$('#end_pos').addClass('is-invalid');
			}
			if (numberQuery == "") {
				$('#number_query').addClass('is-invalid');
			}
			if (dateCheck == "") {
				$('#date_check').addClass('is-invalid');
			}
			if (howLitr == "") {
				$('#how_litr').addClass('is-invalid');
			}
			if (summa == "") {
				$('#summa').addClass('is-invalid');
			}
		}
	}
});
$( document ).on("click", ".deleteButton", function (event) {
	$(event.target).parent().parent().addClass('nowElement');
	$.ajax({
		url: '../php/ajax/add_route.php',
		type: 'POST',
		data: {'form': $('form').serialize()},
		dataType: "html",
		success: function(data) {				
			$('.nowElement').append(data);
			$('.nowElement > .selectRoutes > .deleteButton').not(':last').remove();
			$('.nowElement > .selectRoutes > .removeButton').not(':last').remove();
			$('.nowElement > .selectRoutes > .routes-select').not(':last').attr('readonly', '');
			$.ajax({
				url: '../php/ajax/result_show.php',
				type: 'POST',
				data: {'form2': $('form').serialize()},
				dataType: "html",
				success: function(data) {
					if (data != null) {
						$('.km').html(data + " км.");
					}
				}
			});
			$.ajax({
				url: '../php/ajax/litr_gsm.php',
				type: 'POST',
				data: {'form3': $('form').serialize()},
				dataType: "html",
				success: function(data) {
					if (data != null) {
						$('.litr').html(data + " л.");
					}
				}
			});
			$.ajax({
				url: '../php/ajax/ost_litr_gsm.php',
				type: 'POST',
				data: {'form4': $('form').serialize()},
				dataType: "html",
				success: function(data) {
					if (data != null) {
						$('.ost-litr').html(data + " л.");
					}
				}
			});
		}
	});
});
$( document ).on("click", ".removeButton", function (event) {
	$('.selectRoutes:last').remove();
	$('.selectRoutes:last').append("<button type='button' class='btn btn-primary ml-1 deleteButton'>+</button>");
	if ( $('.selectRoutes').length > 1 ) {
		$('.selectRoutes:last').append("<button type='button' class='btn btn-primary ml-1 removeButton'>-</button>");
	}
	$('.routes-select:last').removeAttr('readonly');
});
	/*function addNewRoute() {
		$.ajax({
			url: '../php/ajax/add_route.php',
			type: 'POST',
			data: {'form': $('form').serialize()},
			dataType: "html",
			success: function(data) {
				$('#routes').append(data);
				$('.deleteButton').not(':last').remove();
				$('.removeButton').not(':last').remove();
				$('.routes-select').not(':last').attr('readonly', '');
				$.ajax({
					url: '../php/ajax/result_show.php',
					type: 'POST',
					data: {'form2': $('form').serialize()},
					dataType: "html",
					success: function(data) {
						$('.km').html(data + " км.");
					}
				});
				$.ajax({
					url: '../php/ajax/litr_gsm.php',
					type: 'POST',
					data: {'form3': $('form').serialize()},
					dataType: "html",
					success: function(data) {
						$('.litr').html(data + " л.");
					}
				});
				$.ajax({
					url: '../php/ajax/ost_litr_gsm.php',
					type: 'POST',
					data: {'form4': $('form').serialize()},
					dataType: "html",
					success: function(data) {
						$('.ost-litr').html(data + " л.");
					}
				});
			}
		});
	}*/
	function deleteRoute() {
		$('.selectRoutes:last').remove();
		$('.selectRoutes:last').append("<button type='button' onclick='addNewRoute()' class='btn btn-primary ml-1 deleteButton'>+</button>");
		if ( $('.selectRoutes').length > 1 ) {
			$('.selectRoutes:last').append("<button type='button' onclick='deleteRoute()' class='btn btn-primary ml-1 removeButton'>-</button>");
		}
		$('.routes-select:last').removeAttr('readonly');
	}
	$("input[name='auto']").change(function() {
		if ($("input[name='auto']").prop("checked") == true) {
			$("input[name='end_pos']").attr("disabled", "disabled");
			$("input[name='end_pos']").val(null);
		}
		if ($("input[name='auto']").prop("checked") == false) {
			$("input[name='end_pos']").removeAttr("disabled");
		}
	});