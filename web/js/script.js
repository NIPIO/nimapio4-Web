      $('#notificacion').hide()

// Modal Image Gallery
function onClick(element, href) {
    document.getElementById("modal01").style.display = "block";
    document.getElementById("img01").src = element.src;
    if(!href) {
      $("#href01").removeAttr("href");
    } else {
      document.getElementById("href01").href = href;      
    }
    var captionText = document.getElementById("caption");
    var descriptionText = document.getElementById("description");
    captionText.innerHTML = element.title;
    descriptionText.innerHTML =element.alt;
}

// Change style of navbar on scroll
window.onscroll = function() {myFunction()};
function myFunction() {
    var navbar = document.getElementById("myNavbar");
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        navbar.className = "w3-bar" + " w3-card" + " w3-animate-top" + " w3-white";
    } else {
        navbar.className = navbar.className.replace(" w3-card w3-animate-top w3-white", "");
    }
}

// Used to toggle the menu on small screens when clicking on the menu button
function toggleFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
$('#contactform').on('submit', function (e) {
  button = $("input[type=submit]")[0]
  e.preventDefault();
  $.ajax({
     url:"/enviarCorreo",
     type: "POST",
     data: $('form').serialize(),
     async: true,
     success: function (data)
     {
      button.value = 'Enviado!'
      button.style.backgroundColor = '#a6e22e'
      button.style.color = 'black';
     }
  });
  setTimeout(function(){ 
     button.style.display = 'none'
  }, 3000);
})


