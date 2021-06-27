let inputLogin = $("#inputRegLogin");
let inputPassword = $("#inputRegPassword");
let inputAgainPassword = $("#inputRegAgainPassword");

let formRegistration = $("#form-registration");

let warning = $("#warning-again-password");

$('#registration-submit').click(function() {
	if ( inputLogin.val() != "" && inputPassword.val() != "" && inputAgainPassword.val() != "" ) {
		if ( inputPassword.val() == inputAgainPassword.val() ) {
			formRegistration.submit();
		}
		if ( inputPassword.val() != inputAgainPassword.val() ) {
			warning.text("Пароли не совпадают");
		}
	}
	if ( inputLogin.val() == "" ) {
		inputLogin.addClass("is-invalid");
	}
	if ( inputPassword.val() == "" ) {
		inputPassword.addClass("is-invalid");
	}
	if ( inputAgainPassword.val() == "" ) {
		inputAgainPassword.addClass("is-invalid");
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
inputAgainPassword.change(function() {
	if ( inputAgainPassword.val() != "" ) {
		inputAgainPassword.addClass("is-valid");
		inputAgainPassword.removeClass("is-invalid");
	}
	if ( inputAgainPassword.val() == "" ) {
		inputAgainPassword.removeClass("is-valid");
	}
});