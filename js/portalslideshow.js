window.addEventListener("load", function(){
  let dots = document.querySelectorAll(".dot");
  let next = document.querySelector(".next");
  let prev = document.querySelector(".prev");
  let listingID = document.querySelectorAll('[data-listingID]');
  let ID;
  let replaceurl;
  let attributes = new Array;
  for (g = 0; g < listingID.length; g++) {
    attributes.push(listingID[g].getAttribute("data-listingID"));
  }
  if (window.location.href.indexOf("www") !== -1) {
    replaceurl = "placeholderURL/php/studentportal.php?listingIndex=";
  }else{
    replaceurl = "placeholderURL/php/studentportal.php?listingIndex=";
  }
  let removedURL = window.location.href.replace(replaceurl,'');
  let url = removedURL.replace("#portalmarketplacetitle", "");
  let counter = attributes.indexOf(url) == -1 ? 0 : attributes.indexOf(url);
  var slideIndex = attributes.indexOf(url) == -1 ? 1 : attributes.indexOf(url) +1;
  showSlides(slideIndex);

  // Next/previous controls
  next.addEventListener("click", function plusSlides(){
    showSlides(slideIndex += 1);
    counter = (counter+1) % listingID.length;
    console.log(counter);
    ID = listingID[counter].getAttribute("data-listingID");
    window.location.href = "studentportal.php?listingIndex="+ID+"#portalmarketplacetitle";
  });
  prev.addEventListener("click", function plusSlides(){
    showSlides(slideIndex += -1);
    counter = counter == 0 ? listingID.length -1 : counter - 1;
    console.log(counter);
    ID = listingID[counter].getAttribute("data-listingID");
    window.location.href = "studentportal.php?listingIndex="+ID+"#portalmarketplacetitle";
  });

  // Thumbnail image controls
  dots.forEach(function(dot, i){
    dot.addEventListener("click", function currentSlide(){
      showSlides(slideIndex = i+1);
      ID = listingID[i].getAttribute("data-listingID");
      window.location.href = "studentportal.php?listingIndex="+ID+"#portalmarketplacetitle";
    });
  });

  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
  } 
});