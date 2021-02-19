window.addEventListener("load", function(){
	let submit = document.querySelector("#newpass-submit");
	let passwordrepeat = document.querySelector("#passwordrepeat");
	let password = document.querySelector("#password");
	let password_error = document.querySelector(".password_error");
	let passwordrepeat_error = document.querySelector(".passwordrepeat_error");
	let passwordre = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/;
	submit.addEventListener("click", function(event){
		password_error.textContent = "";
		passwordrepeat_error.textContent = "";
		// password validation
		if (password.value == "") {
			password_error.textContent = "A password is required.";
		}else{
			// check if password only contains letters and spaces
			if (!passwordre.test(password.value)) {
				password_error.textContent = "Invalid password entered.";
			}
		}
		// password repeat validation
		if (passwordrepeat.value == "") {
			passwordrepeat_error.textContent = "A password is required.";
		}else{
			// check if password repeat only contains letters and spaces
			if (!passwordre.test(passwordrepeat.value)) {
				passwordrepeat_error.textContent = "Invalid password entered.";
			}
		}
		if (password.value !== passwordrepeat.value) {
			passwordrepeat_error.textContent = "Both Passwords must match.";
			password_error.textContent = "Both Passwords must match.";
		}
		if(!(password_error.textContent == "" && passwordrepeat_error.textContent == "")){
			event.preventDefault();
		}
	});
});