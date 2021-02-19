window.addEventListener("load", function(){
  let earnings = document.querySelector("#earnings");
  let payoutsubmit = document.querySelector("#payout-submit");
  if (earnings.value == 0) {
    payoutsubmit.style.display = "none";
  }else{
    payoutsubmit.style.display = "initial";
  }
});