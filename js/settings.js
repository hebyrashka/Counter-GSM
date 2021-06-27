let idChange;
let openModal = false;

$(".idChange").click(function(event) {
    console.log($(event.target).val());
    idChange = $(event.target).val();
});
$('.btn-delete-route').click(function () {
    $.ajax({
        url: '../php/ajax/delete_route.php',
        type: 'POST',
        data: {'id': idChange},
        dataType: "html",
        success: function(data) {
            location.reload() // window.location.reload()
        }
    });
});
$('#btn-modal-open-route').click(function () {
    switch  (openModal) {
        case true: 
        $('.modal-wrapper').attr('style', '');
        openModal = false;
            break;
        case false: 
        $('.modal-wrapper').attr('style', 'display: flex;');
        openModal = true;
            break;
    }
});
$('.modal-header h4:nth-child(2)').click(function () {
    switch  (openModal) {
        case true: 
        $('.modal-wrapper').attr('style', '');
        openModal = false;
            break;
        case false: 
        $('.modal-wrapper').attr('style', 'display: flex;');
        openModal = true;
            break;
    }
});