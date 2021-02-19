window.addEventListener("load", function(){
  //MODAL
  let changeprofile = document.querySelector("#changeprofile");
  let profileupdate = document.querySelector(".profileupdate");
  let changebio = document.querySelector("#changebio");
  let bioupdate = document.querySelector(".bioupdate");
  let modalbg = document.querySelector(".bg-modal");
  let close = document.querySelector(".modal-close");
  let changemarketplace = document.querySelectorAll("#changemarketplace");
  let marketplaceupdate = document.querySelector(".marketplaceupdate");
  if (window.location.href.indexOf("www") !== -1) {
    replaceurl = "placeholderURL/php/studentportal.php?marketplaceIndex=";
    senturl = "placeholderURL/php/studentportal.php?sent";
    biourl = "placeholderURL/php/studentportal.php?emptybio";
    profileurl = "placeholderURL/php/studentportal.php?emptyprofile";
    marketplaceurl = "placeholderURL/php/studentportal.php?emptymarketplace";
  }else{
    replaceurl = "placeholderURL/php/studentportal.php?marketplaceIndex=";
    senturl = "placeholderURL/php/studentportal.php?sent";
    biourl = "placeholderURL/php/studentportal.php?emptybio";
    profileurl = "placeholderURL/php/studentportal.php?emptyprofile";
    marketplaceurl = "placeholderURL/php/studentportal.php?emptymarketplace";
  }
  let marketplaceID = document.querySelectorAll('[data-marketplaceID]');
  let removedURL = window.location.href.replace(replaceurl,'');
  let url = removedURL.replace("#portalmarketplacetitle", "");
  let ID;
  let attributes = new Array;
  for (g = 0; g < marketplaceID.length; g++) {
    attributes.push(marketplaceID[g].getAttribute("data-marketplaceID"));
  }
  let index = attributes.indexOf(url) == -1 ? 0 : attributes.indexOf(url);
  ID = marketplaceID[index].getAttribute("data-marketplaceID");
  for (i=0; i < changemarketplace.length; i++) {
    changemarketplace[i].addEventListener("click", function(){
      window.history.pushState("object", "changemarketplace", "?marketplaceIndex="+ID);
      modalbg.style.display = 'flex';
      profileupdate.style.display = 'none';
      bioupdate.style.display = 'none';
    });
  }
  changeprofile.addEventListener("click", function(){
    window.history.pushState("string", "changeprofile", "?changeprofile");
    modalbg.style.display = 'flex';
    marketplaceupdate.style.display = 'none';
    bioupdate.style.display = 'none';
  });

  changebio.addEventListener("click", function(){
    window.history.pushState("string", "changeimage", "?changebio");
    modalbg.style.display = 'flex';
    profileupdate.style.display = 'none';
    marketplaceupdate.style.display = 'none';
  });

  close.addEventListener("click", function(){
    modalbg.style.display = 'none';
    window.history.pushState("object", "reverturl", "?marketplaceIndex="+ID);
    profileupdate.style.display = 'initial';
    marketplaceupdate.style.display = 'initial';
    bioupdate.style.display = 'initial';
  });
  let sentconfirmation = document.querySelector(".sentconfirmation");
  if(window.location.href == senturl){
    sentconfirmation.style.display = 'block';
    sentconfirmation.style.backgroundColor = "#BADA55";
    sentconfirmation.innerHTML = 'Changes Sent!';
    setTimeout(function(){sentconfirmation.style.display = 'none'},3000);
  }
  if(window.location.href == biourl){
    sentconfirmation.style.display = 'block';
    sentconfirmation.style.backgroundColor = "#D6000D";
    sentconfirmation.innerHTML = 'Changes Not Sent: Bio was empty!';
    setTimeout(function(){sentconfirmation.style.display = 'none'},3000);
  }
  if(window.location.href == profileurl){
    sentconfirmation.style.display = 'block';
    sentconfirmation.style.backgroundColor = "#D6000D";
    sentconfirmation.innerHTML = 'Changes Not Sent: Profile Image was empty!';
    setTimeout(function(){sentconfirmation.style.display = 'none'},3000);
  }
  if(window.location.href == marketplaceurl){
    sentconfirmation.style.display = 'block';
    sentconfirmation.style.backgroundColor = "#D6000D";
    sentconfirmation.innerHTML = 'Changes Not Sent: Profile Image and Bio were empty!';
    setTimeout(function(){sentconfirmation.style.display = 'none'},3000);
  }
});