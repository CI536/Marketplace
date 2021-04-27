window.addEventListener("load", function(){
	let listingsubmit = document.querySelector("#newlisting-submit");
	listingsubmit.addEventListener("click", function (e){
		e.preventDefault();
		window.location.href = "studentportal.php?marketplacenewprod";
		let modalbg = document.querySelector(".bg-modal");
		let profileupdate = document.querySelector(".profileupdate");
		let bioupdate = document.querySelector(".bioupdate");
		let listingupdate = document.querySelector(".listingupdate");
		modalbg.style.display = 'flex';
		profileupdate.style.display = 'none';
		bioupdate.style.display = 'none';
		listingupdate.style.display = 'none';
	});
});