window.addEventListener("load", function(){
	let submit = document.querySelector("#contact-submit");
	let name = document.querySelector("#fullname");
	let name_error = document.querySelector(".name_error");
	let email = document.querySelector("#email");
	let email_error = document.querySelector(".email_error");
	let subject = document.querySelector("#subject");
	let subject_error = document.querySelector(".subject_error");
	let message = document.querySelector("#query");
	let message_error = document.querySelector(".message_error");
	let namere = /^[a-zA-Z ]*$/;
	let emailre = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	submit.addEventListener("click", function(event){
		name_error.textContent = "";
		email_error.textContent = "";
		subject_error.textContent = "";
		message_error.textContent = "";
		// name validation
		if (name.value == "") {
			name_error.textContent = "A name is required.";
		}else{
			// check if name only contains letters and spaces
			if (!namere.test(name.value)) {
				name_error.textContent = "Only letters and spaces allowed.";
			}
		}
		// email validation
		if (email.value == "") {
			email_error.textContent = "An email is required.";
		}else{
			// check if email only contains letters and spaces
			if (!emailre.test(email.value)) {
				email_error.textContent = "Invalid email address.";
			}
		}
		// subject validation
		if (subject.value == "") {
			subject_error.textContent = "a subject is required.";
		}
		// message validation
		if (message.value == "") {
			message_error.textContent = "A message is required.";
		}
		if(!(message_error.textContent == "" && subject_error.textContent == "" && name_error.textContent == "" && email_error.textContent == "")){
			event.preventDefault();
		}
	});
});