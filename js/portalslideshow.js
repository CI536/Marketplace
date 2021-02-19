window.addEventListener("load", function(){
  let dots = document.querySelectorAll(".dot");
  let next = document.querySelector(".next");
  let prev = document.querySelector(".prev");
  let marketplaceID = document.querySelectorAll('[data-marketplaceID]');
  let ID;
  let replaceurl;
  let attributes = new Array;
  for (g = 0; g < marketplaceID.length; g++) {
    attributes.push(marketplaceID[g].getAttribute("data-marketplaceID"));
  }
  if (window.location.href.indexOf("www") !== -1) {
    replaceurl = "placeholderURL/php/studentportal.php?marketplaceIndex=";
  }else{
    replaceurl = "placeholderURL/php/studentportal.php?marketplaceIndex=";
  }
  let removedURL = window.location.href.replace(replaceurl,'');
  let url = removedURL.replace("#portalmarketplacetitle", "");
  let counter = attributes.indexOf(url) == -1 ? 0 : attributes.indexOf(url);
  var slideIndex = attributes.indexOf(url) == -1 ? 1 : attributes.indexOf(url) +1;
  showSlides(slideIndex);

  // Next/previous controls
  next.addEventListener("click", function plusSlides(){
    showSlides(slideIndex += 1);
    counter = (counter+1) % marketplaceID.length;
    console.log(counter);
    ID = marketplaceID[counter].getAttribute("data-marketplaceID");
    window.location.href = "studentportal.php?marketplaceIndex="+ID+"#portalmarketplacetitle";
  });
  prev.addEventListener("click", function plusSlides(){
    showSlides(slideIndex += -1);
    counter = counter == 0 ? marketplaceID.length -1 : counter - 1;
    console.log(counter);
    ID = marketplaceID[counter].getAttribute("data-marketplaceID");
    window.location.href = "studentportal.php?marketplaceIndex="+ID+"#portalmarketplacetitle";
  });

  // Thumbnail image controls
  dots.forEach(function(dot, i){
    dot.addEventListener("click", function currentSlide(){
      showSlides(slideIndex = i+1);
      ID = marketplaceID[i].getAttribute("data-marketplaceID");
      window.location.href = "studentportal.php?marketplaceIndex="+ID+"#portalmarketplacetitle";
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