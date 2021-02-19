window.addEventListener("load", function(){
	let submit = document.querySelector("#login-submit");
	let username = document.querySelector("#username");
	let username_error = document.querySelector(".username_error");
	let password = document.querySelector("#password");
	let password_error = document.querySelector(".password_error");
	let passwordre = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/;
	let usernamere = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	submit.addEventListener("click", function(event){
		username_error.textContent = "";
		password_error.textContent = "";
		// username validation
		if (username.value == "") {
			username_error.textContent = "A username is required.";
		}else{
			// check if username only contains letters and spaces
			if (!usernamere.test(username.value)) {
				username_error.textContent = "Invalid username entered.";
			}
		}
		// password validation
		if (password.value == "") {
			password_error.textContent = "A password is required.";
		}else{
			// check if password only contains letters and spaces
			if (!passwordre.test(password.value)) {
				password_error.textContent = "Invalid password entered.";
			}
		}
		if(!(username_error.textContent == "" && password_error.textContent == "")){
			event.preventDefault();
		}
	});
});