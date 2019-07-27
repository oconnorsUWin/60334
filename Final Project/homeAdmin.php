<!DOCTYPE html>
<html lang="en">
<title>Spartan Hotels</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {font-family: "Lato", sans-serif}
.mySlides {display: none}
</style>
<body>

<?php
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
   include('session.php');

?>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-black w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="homeAdmin.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Home</a>
    <a href="roomAdmin.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Room</a>
    <a href="reservationAdmin.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Reservation</a>
    <a href="administrationAdmin.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Administration</a>
    </div>
    
  </div>
</div>

<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
  <a href="homeAdmin.php" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">Home</a>
  <a href="roomAdmin.php" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">Room</a>
  <a href="reservationAdmin.php" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">Reservation</a>
  <a href="administrationAdmin.php" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">Administration</a>
</div>

<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">
  <!-- Automatic Slideshow Images -->
  <div class="mySlides w3-display-container w3-center">
    <img src="pics/spartan.jpg" width=70% height=42%>
  </div>
  <div class="mySlides w3-display-container w3-center">
    <img src="pics/room1.jpg" width=70% height=42%>
  </div>
  <div class="mySlides w3-display-container w3-center">
        <img src="pics/room2.jpg" width=70% height=42%>
  </div>

  <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
    <h2 class="w3-wide">Spartan Hotels</h2>
    <p class="w3-opacity"><i>We love hospitality</i></p>
    <p class="w3-justify">We have created a revolutionary hotel. We are created for the modern human, fast paced, progressive and willing to do what it takes.
                          We hope you will stay with us soon, and experience what our hotel has to offer, different than anyone else.
                          Please contact us, or use our website to book a room!</p>
  </div>

  <div class="w3-black" id="tour">
    <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
      <h2 class="w3-wide w3-center">Events</h2>
      <p class="w3-opacity w3-center"><i>Check out our community events!</i></p><br>

      <div class="w3-row-padding w3-padding-32" style="margin:0 -16px">
        <div class="w3-third w3-margin-bottom">
          <div class="w3-container w3-white">
            <p><b>Fun run</b></p>
            <p class="w3-opacity">Fri 16 Aug 2019</p>
            <p>Fun run, supporting local charities! Get out and run with us!</p>
          </div>
        </div>

        <div class="w3-third w3-margin-bottom">
          <div class="w3-container w3-white">
            <p><b>80's dance night</b></p>
            <p class="w3-opacity">Sat 17 Aug 2019</p>
            <p>Get down and boogie! Join us for a night of 80's themed dancing, drinking and good times!</p>
          </div>
        </div>

        <div class="w3-third w3-margin-bottom">
          <div class="w3-container w3-white">
            <p><b>Brunch</b></p>
            <p class="w3-opacity">Sun 18 Aug 2019</p>
            <p>Come enjoy a mid-day brunch with your family. Plenty of delicious food for all!</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="ticketModal" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4">
      <header class="w3-container w3-teal w3-center w3-padding-32"> 
        <span onclick="document.getElementById('ticketModal').style.display='none'" 
       class="w3-button w3-teal w3-xlarge w3-display-topright">×</span>
        <h2 class="w3-wide"><i class="fa fa-suitcase w3-margin-right"></i>Tickets</h2>
      </header>
      <div class="w3-container">
        <p><label><i class="fa fa-shopping-cart"></i> Tickets, $15 per person</label></p>
        <input class="w3-input w3-border" type="text" placeholder="How many?">
        <p><label><i class="fa fa-user"></i> Send To</label></p>
        <input class="w3-input w3-border" type="text" placeholder="Enter email">
        <button class="w3-button w3-block w3-teal w3-padding-16 w3-section w3-right">PAY <i class="fa fa-check"></i></button>
        <button class="w3-button w3-red w3-section" onclick="document.getElementById('ticketModal').style.display='none'">Close <i class="fa fa-remove"></i></button>
        <p class="w3-right">Need <a href="#" class="w3-text-blue">help?</a></p>
      </div>
    </div>
  </div>


  <div class="w3-container w3-content w3-padding-64" style="max-width:800px" id="contact">
    <h2 class="w3-wide w3-center">CONTACT</h2>
    <p class="w3-opacity w3-center"><i>Feedback? Drop a note!</i></p>
    <div class="w3-row w3-padding-32">
      <div class="w3-col m6 w3-large w3-margin-bottom">
        <i class="fa fa-map-marker" style="width:30px"></i> Windsor ON, Canada<br>
        <i class="fa fa-phone" style="width:30px"></i> Phone: +519-012-3456<br>
        <i class="fa fa-envelope" style="width:30px"> </i> Email: spartan334@mail.com<br>
      </div>
    </div>
  </div>
  
<!-- End Page Content -->
</div>


<script>
// Automatic Slideshow - change image every 4 seconds
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 4000);    
}

function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}

// When the user clicks anywhere outside of the modal, close it
var modal = document.getElementById('ticketModal');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

<?php
  $result->close();
  $conn->close();
?>
</body>
</html>