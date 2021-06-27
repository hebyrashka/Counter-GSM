let idChange;

$(".idChange").click(function(event) {
	idChange = $(event.target).val();
});
$("#btn-delete").click(function(event) {
	console.log($(event.target).val());
	$.ajax({
		url: '/php/ajax/delete_trip.php',
		type: 'POST',
		data: {'id': idChange},
		dataType: "html",
		success: function(data) {
			location.reload() // window.location.reload()
		}
	});
});
$(".btn-excel-card").click(function() {
	$('#excel-action').attr('value', "card");
	$('.form-excel').submit();
});
$(".btn-excel-list").click(function() {
	$('#excel-action').attr('value', "list");
	$('.form-excel').submit();
});