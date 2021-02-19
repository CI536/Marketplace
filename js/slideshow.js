window.addEventListener("load", function(){
  var slideIndex = 1;
  showSlides(slideIndex);

  let dots = document.querySelectorAll(".dot");
  let next = document.querySelector(".next");
  let prev = document.querySelector(".prev");

  // Next/previous controls

  next.addEventListener("click", function plusSlides(){
    showSlides(slideIndex += 1);
  });
  prev.addEventListener("click", function plusSlides(){
    showSlides(slideIndex += -1);
  });

  // Thumbnail image controls
  dots.forEach(function(dot, i){
    dot.addEventListener("click", function currentSlide(){
      showSlides(slideIndex = i+1);
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