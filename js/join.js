let inputLogin = $("#inputJoinLogin");
let inputPassword = $("#inputJoinPassword");

let formJoin = $("#form-join");

$('#join-submit').click(function() {
	if ( inputLogin.val() != "" && inputPassword.val() != "" ) {
		formJoin.submit();
	}
	if ( inputLogin.val() == "" ) {
		inputLogin.addClass("is-invalid");
	}
	if ( inputPassword.val() == "" ) {
		inputPassword.addClass("is-invalid");
	}
});
inputLogin.change(function() {
	if ( inputLogin.val() != "" ) {
		inputLogin.addClass("is-valid");
		inputLogin.removeClass("is-invalid");
	}
	if ( inputLogin.val() == "" ) {
		inputLogin.removeClass("is-valid");
	}
});
inputPassword.change(function() {
	if ( inputPassword.val() != "" ) {
		inputPassword.addClass("is-valid");
		inputPassword.removeClass("is-invalid");
	}
	if ( inputPassword.val() == "" ) {
		inputPassword.removeClass("is-valid");
	}
});