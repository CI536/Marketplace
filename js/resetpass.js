window.addEventListener("load", function(){
	let submit = document.querySelector("#resetpass-submit");
	let email = document.querySelector("#username");
	let email_error = document.querySelector(".email_error");
	let emailre = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	let resetconfirmation = document.querySelector(".resetconfirmation");
	submit.addEventListener("click", function(event){
		email_error.textContent = "";
		// email validation
		if (email.value == "") {
			email_error.textContent = "An email is required.";
		}else{
			// check if email only contains letters and spaces
			if (!emailre.test(email.value)) {
				email_error.textContent = "Invalid email address.";
			}
		}
		if(!(email_error.textContent == "")){
			event.preventDefault();
		}
	});
	if (window.location.href.indexOf("www") !== -1) {
    	reseturl = "placeholderURL/resetpass.html?resetrequest=success";
	}else{
		reseturl = "placeholderURL/resetpass.html?resetrequest=success";
	}
	if(window.location.href == reseturl){
    resetconfirmation.style.display = 'block';
    resetconfirmation.style.backgroundColor = "#BADA55";
    resetconfirmation.innerHTML = 'Password change request sent to your email!';
    setTimeout(function(){resetconfirmation.style.display = 'none'},3000);
  }
});