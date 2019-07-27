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

  $resultRoom = $conn->query("SELECT * FROM rooms");


if (isset($_POST['numGuests'])   &&
    isset($_POST['inDate'])      &&
    isset($_POST['outDate'])     &&
    isset($_POST['paymentType']) &&
    isset($_POST['guestName'])   &&
    !empty($_POST["numGuests"])  &&
    !empty($_POST["inDate"])     &&
    !empty($_POST["outDate"])    &&
    !empty($_POST["paymentType"])&&
    !empty($_POST["numGuests"]))
  {
    $numGuests   = mysqli_real_escape_string($conn, $_POST['numGuests']);
    $inDate      = mysqli_real_escape_string($conn, $_POST['inDate']);
    $outDate     = mysqli_real_escape_string($conn, $_POST['outDate']);
    $paymentType = mysqli_real_escape_string($conn, $_POST['paymentType']);
    $guestName   = mysqli_real_escape_string($conn, $_POST['guestName']);
    $query       = "INSERT INTO bookingData (numGuests, inDate, outDate, inStatus, paymentType, discount, guestName) VALUES" .
      "('$numGuests', '$inDate', '$outDate', 'No', '$paymentType', 'No', '$guestName')";
    $result   = $conn->query($query);

  	if (!$result) echo "<br><br>INSERT failed: $query<br>" .
      $conn->error . "<br><br>";
  }

if (isset($_POST['bookingCode'])   &&
    isset($_POST['bookingCode'])   &&
    !empty($_POST["guestName2"])  &&
    !empty($_POST["guestName2"]))
  {
    $bookingCode   = mysqli_real_escape_string($conn, $_POST['bookingCode']);
    $guestName2   = mysqli_real_escape_string($conn, $_POST['guestName2']);
    $query2       = "SELECT * FROM bookingData WHERE bookingData.bookingCode ='". $bookingCode. "' AND bookingData.guestName ='". $guestName2. "'";
    $result2   = $conn->query($query2);

  	if (!$result2) echo "<br><br>Select failed: $query2<br>" .
      $conn->error . "<br><br>";
  }
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
    <p class="w3-opacity"><i>Book a room!</i></p>
    <p class="w3-justify">We're here to help you book a room! Input your information and we'll book the room for you right away! Thanks for choosing us for your stay!</p>

  <form action="reservation.php" method="post"><pre>
      Number of Guests: <input type="text" name="numGuests">
      Check in date:    <input type="text" name="inDate">
      Check out date:   <input type="text" name="outDate">
      Payment Type:     <input type="text" name="paymentType">
      Guest Name:       <input type="text" name="guestName">
                        <input type="submit" value="Book reservation">
  </pre></form>

</div>

  <div class="w3-black" id="tour">
    <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
      <h2 class="w3-wide w3-center">Check a reservation</h2>
      <p class="w3-opacity w3-center"><i>Input your booking number and name, and we'll let you know the details about your stay!</i></p><br>
    <form action="reservation.php" method="post"><pre>
      Booking Code: <input type="text" name="bookingCode">
      Guest Name:   <input type="text" name="guestName2">
                    <input type="submit" value="Search booking">
    </pre></form>

<?php
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        echo "Booking Code: " . $row["bookingCode"]. "<br>   Number of Guests: " . $row["numGuests"]. "<br>   Check in Date: " . $row["inDate"]. "<br>   Check out Date: " . $row["outDate"].
                            "<br>   Check in Status: " . $row["inStatus"]. "<br>   Payment Type: " . $row["paymentType"]. "<br>   Discount: " . $row["discount"]. "<br>   Name: " . $row["guestName"]."<br>";
    }
} else {
    echo "0 results";
}
?>

    </div>
    </div>
  </div>

 <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
    <h2 class="w3-wide">Spartan Hotels</h2>
    <p class="w3-opacity"><i>Select a room type and we'll show you what is not booked!</i></p>

  <form action="reservation.php" method="post"><pre>
    Room Type: <select name="roomType">
   <?php
        while($rows=$resultRoom->fetch_assoc())
        {
           $roomType=$rows['roomType'];
           echo"<option value='$roomType'>$roomType</option>";
        }
   ?>
               </select>
               <input type="submit" value="Search open rooms">
  </pre></form>

<?php
if (isset($_POST['roomType'])   &&
    !empty($_POST["roomType"]))
  {
    $roomType   = mysqli_real_escape_string($conn, $_POST['roomType']);
    $query3       = "SELECT * FROM rooms WHERE NOT EXISTS (SELECT * FROM bookings WHERE bookings.roomNum = rooms.roomNum) AND roomType= '$roomType'";
    $result3   = $conn->query($query3);

  	if (!$result3) echo "<br><br>Select failed: $query3<br>" .
      $conn->error . "<br><br>";
if ($result3->num_rows > 0) {
    while($row2 = $result3->fetch_assoc()) {
        echo "Room Number: " . $row2["roomNum"]. "<br>   Room Type: " . $row2["roomType"]. "<br>   Max Guests: " . $row2["maxGuests"]. "<br>   Cleaner: " . $row2["cleaner"].
                            "<br>   Cost: " . $row2["cost"]. "<br><br>";
    }
} else {
    echo "0 results";
}
  }
?>
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
  $resultRoom->close();
  $result2->close();
  $result3->close();
  $conn->close();
?>
</body>
</html>