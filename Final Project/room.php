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

  $query  = "SELECT roomType, count(*) as cnt FROM rooms WHERE NOT EXISTS (SELECT * FROM bookings WHERE bookings.roomNum = rooms.roomNum) group by roomType";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);

?>


<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-black w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
     <a href="home.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Home</a>
    <a href="room.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Room</a>
    <a href="reservation.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Reservation</a>
    </div>
  </div>
</div>


<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
  <a href="home.php" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">Home</a>
  <a href="room.php" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">Room</a>
  <a href="reservation.php" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">Reservation</a>
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

  <div class="w3-container w3-content w3-center w3-padding-64 w3-black" style="max-width:800px" id="band">
    <h2 class="w3-wide">Spartan Hotels - Our Rooms</h2>
    <p class="w3-opacity"><i>Our Rooms Rock</i></p>
    <p class="w3-justify">We have three different types of rooms available for all budgets. Our Economy rooms are budget sensitive, intended for those looking for a short stay on a budget.
                          Our General rooms are perfect for a people looking to stay a few nights in a beautiful hotel room without breaking the bank.
                          Our Luxury rooms are beautiful, and are available for anyone looking to upgrade their stay, and to enjoy all of our amenities.</p>
    <div class="w3-row w3-padding-32">
      <div class="w3-third">
        <p>Economy</p>
        <p>Cheapest option<br>
           Variety of room sizes<br>
           Shower and bathtub<br>
           Free unlimited wifi<br>
           Free cable TV</p>
      </div>
      <div class="w3-third">
        <p>General</p>
        <p>Middle priced option<br>
           Variety of room sizes<br>
           Shower, bathtub and bidet<br>
           Half kitchen<br>
           Access to all basic hotel amenities<br>
           Free unlimited high speed wifi<br>
           Free cable TV and a selection of movies</p>     
      </div>
      <div class="w3-third">
        <p>Luxury</p>
        <p>Most expensive option<br>
           Variety of room sizes<br>
           Shower, bathtub, bidet, hot tub<br>
           Complimentary room service<br>
           Full kitchen<br>
           Access to all basic and premium hotel amenities<br>
           Free unlimited high speed wifi<br>
           Free cable TV and all premium movies</p>        
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


  <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
    <h2 class="w3-wide">Spartan Hotels</h2>
    <p class="w3-opacity"><i>See our room types!</i></p>
    <p class="w3-justify">All of our currently available rooms</p>
  <div id="visualization" style="width: 600px; height: 400px;"></div>
<?php
  $rows = $result->num_rows;
  if( $rows > 0){
?>

<!-- load api -->
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        
        <script type="text/javascript">
            //load package
            google.load('visualization', '1', {packages: ['corechart']});
        </script>
 
        <script type="text/javascript">
            function drawVisualization() {
                // Create and populate the data table.
                var data = google.visualization.arrayToDataTable([
                    ['Room Type', 'Cnt'],
                    <?php
                    while( $row = $result->fetch_assoc() ){
                        extract($row);
                        echo "['{$roomType}', {$cnt}],";
                    }
                    ?>
                ]);
 
                // Create and draw the visualization.
                new google.visualization.PieChart(document.getElementById('visualization')).
                draw(data, {title:"Available room types"});
            }
 
            google.setOnLoadCallback(drawVisualization);
        </script>
    <?php
    }else{
        echo "<br><br>Nothing found.";
    }
    ?>
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
  <div id="piechart"></div>
</body>
</html>