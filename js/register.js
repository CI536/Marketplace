window.addEventListener("load", function(){
	let submit = document.querySelector("#signup-submit");
	let studentNo = document.querySelector("#studentNo");
	let studentNo_error = document.querySelector(".studentNo_error");
	let email =document.querySelector("#email")
	let email_error = document.querySelector(".email_error");
	let password = document.querySelector("#pwd");
	let password_error = document.querySelector(".password_error");
	let passwordRepeat = document.querySelector("#pwd-repeat");
	let passwordRepeat_error = document.querySelector(".passwordRepeat_error");
	let studentNoRe = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	let passwordre = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/;
	let emailre = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	
	
	submit.addEventListener("click", function(event){
	    
	    studentNo_error.textContent = "";
		email_error.textContent = "";
		password_error.textContent = "";
		passwordRepeat_error.textContent = "";
		
		// student number validation
		if (studentNo.value == "") {
			studentNo_error.textContent = "A student number is required.";
		}else{
			// TODO: check if student number only contains numbers
			if (!studentNoRe.test(studentRe.value.trim)) {
				studentNo_error.textContent = "Invalid student number entered.";
			} else if (studentNo.value.length() != 8) {
			    studentNo_error.textContent = "Student number must be 8 digits long.";
			}
		}
		
		// email validation
		if (email.value == ""){
		    email_error.textContent = "A student email is required.";
		} else {
		    if(! email.value.includes("@uni.brighton.ac.uk")) {
		    	email_error.textContent = "Email must be a University of Brighton email.";
		    }
		}
		
		
		// password validation
		if (password.value == "") {
			password_error.textContent = "A password is required.";
		} else{
		    if (!passwordre.test(password.value)){
			// check if password only contains letters and spaces
			password_error.textContent = "Password must have at least 1 number, 1 special character and be 6 digits long";
	     	}
		} 
		
		// confirm password validation
		if (passwordRepeat.value == "") {
			passwordRepeat_error.textContent = "Confirm your password.";
		} else{
		    //check passwords match
		    if (passwordRepeat.value == password.value) {
			  passwordRepeat_error.textContent = "Passwords do not match.";
	    	}
		}
	
		
		if(!(studentNo_error.textContent == "" && email_error.textContent == "" && password_error.textContent == "" && passwordRepeat_error.textContent == "")){
			event.preventDefault();
		}
	});
});