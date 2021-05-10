window.addEventListener("load", function(){
	let submit = document.querySelector("#signup-submit");
	let name = document.querySelector("#name");
	let name_error = document.querySelector(".name_error");
	let username = document.querySelector("#username");
	let username_error = document.querySelector(".username_error");
	let studentNO = document.querySelector("#studentNO");
	let studentNO_error = document.querySelector(".studentNO_error");

	let password = document.querySelector("#password");
	let password_error = document.querySelector(".password_error");
	let password2 = document.querySelector("#password2");
	let password2_error = document.querySelector(".password2_error");
	let passwordre = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/;
	let usernamere = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	let studentNOre = /[0-9]/;
	submit.addEventListener("click", function(event){
		name_error.textContent = "";
		username_error.textContent = "";
		password_error.textContent = "";
		password2_error.textContent = "";
		studentNO_error.textContent = "";
		// name validation
		if (name.value === "") {
			name_error.textContent = "A name is required.";
		}else{
			// check if username only contains letters and spaces
			if (!usernamere.test(username.value)) {
				username_error.textContent = "Invalid username entered.";
			}
		}
		// username validation
		if (username.value === "") {
			username_error.textContent = "A username is required.";
		}else{
			// check if username only contains letters and spaces
			if (!usernamere.test(username.value)) {
				username_error.textContent = "Invalid username entered.";
			}
		}
		// studentNO validation
		if (studentNO.value === "") {
			studentNO_error.textContent = "A student number is required.";
		}else{
			// check if StudentNO only contains letters and spaces
			if (!studentNOre.test(studentNO.value)) {
				studentNO_error.textContent = "Invalid student number entered.";
			}
		}
		

		// password validation
		if (password.value === "") {
			password_error.textContent = "A password is required.";
		}else{
			// check if password only contains letters and spaces
			if (!passwordre.test(password.value)) {
				password_error.textContent = "Invalid password entered.";
			}
		}
		// password repeat validation
		if (password2.value === "") {
			password2_error.textContent = "A password is required.";
		}else{
			// check if password only contains letters and spaces
			if (!passwordre.test(password2.value)) {
				password2_error.textContent = "Invalid password entered.";
			}
		}
		if(!(username_error.textContent === "" && name_error.textContent === "" && password_error.textContent === "" && password2_error.textContent === ""&& studentNO_error.textContent === "")){
			event.preventDefault();
		}
	});
});