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
});
$('.routes-select').change(function() {
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
});
$('#submit-trip').click(function() {
	
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
			}
		});
	});
	$( document ).on("click", ".removeButton", function (event) {
		$(event.target).parent().parent().addClass('nowElement');
		$('.selectRoutes:last').remove();
		$('.selectRoutes:last').append("<button type='button' onclick='addNewRoute()' class='btn btn-primary ml-1 deleteButton'>+</button>");
		if ( $('.selectRoutes').length > 1 ) {
			$('.selectRoutes:last').append("<button type='button' onclick='deleteRoute()' class='btn btn-primary ml-1 removeButton'>-</button>");
		}
		$('.routes-select:last').removeAttr('readonly');
	});
	$("input[name='auto']").change(function() {
		if ($("input[name='auto']").prop("checked") == true) {
			$("input[name='end_pos']").attr("disabled", "disabled");
			$("input[name='end_pos']").val(null);
		}
		if ($("input[name='auto']").prop("checked") == false) {
			$("input[name='end_pos']").removeAttr("disabled");
		}
	});