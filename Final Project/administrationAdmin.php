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
if (isset($_POST['bookingCodeIn'])   &&
    isset($_POST['roomNumIn'])      &&
    !empty($_POST["bookingCodeIn"])&&
    !empty($_POST["roomNumIn"]))
  {
    $bookingCodeIn   = mysqli_real_escape_string($conn, $_POST['bookingCodeIn']);
    $roomNumIn      = mysqli_real_escape_string($conn, $_POST['roomNumIn']);
    $query5       = "INSERT INTO bookings (roomNum, bookingCode) VALUES" . "('$roomNumIn', '$bookingCodeIn')";
    $result5   = $conn->query($query5);

  	if (!$result5) echo "<br><br>INSERT failed: $query5<br>" .
      $conn->error . "<br><br>";
  }


if (isset($_POST['bookingCodeUp'])   &&
    isset($_POST['inStatusUp'])      &&
    !empty($_POST["bookingCodeUp"])&&
    !empty($_POST["inStatusUp"]))
  {
    $bookingCodeUp= mysqli_real_escape_string($conn, $_POST['bookingCodeUp']);
    $inStatusUp   = mysqli_real_escape_string($conn, $_POST['inStatusUp']);
    $query7       = "UPDATE bookingData SET inStatus = '$inStatusUp' WHERE bookingCode = '$bookingCodeUp'";
    $result7   = $conn->query($query7);

  	if (!$result7) echo "<br><br>UPDATE failed: $query7<br>" .
      $conn->error . "<br><br>";
  }


if (isset($_POST['bookingCodeUp'])   &&
    isset($_POST['discountUp'])      &&
    !empty($_POST["bookingCodeUp"])&&
    !empty($_POST["discountUp"]))
  {
    $bookingCodeUp= mysqli_real_escape_string($conn, $_POST['bookingCodeUp']);
    $discountUp      = mysqli_real_escape_string($conn, $_POST['discountUp']);
    $query6       = "UPDATE bookingData SET discount = '$discountUp' WHERE bookingCode = '$bookingCodeUp'";
    $result6   = $conn->query($query6);

  	if (!$result6) echo "<br><br>UPDATE failed: $query6<br>" .
      $conn->error . "<br><br>";
  }

if (isset($_POST['bookingCodeDel'])   &&
    !empty($_POST["bookingCodeDel"]))
  {
    $bookingCodeDel= mysqli_real_escape_string($conn, $_POST['bookingCodeDel']);
    $query9       = "Delete from bookings where bookingCode = '$bookingCodeDel'";
    $result9   = $conn->query($query9);
  	if (!$result9) echo "<br><br>Delete failed: $query9<br>" .
      $conn->error . "<br><br>";

    $query8       = "Delete from bookingData where bookingCode = '$bookingCodeDel'";
    $result8   = $conn->query($query8);
  	if (!$result8) echo "<br><br>Delete failed: $query8<br>" .
      $conn->error . "<br><br>";
  }

  $query = "select * from bookingData left join bookings on bookingData.bookingCode = bookings.bookingCode where bookings.roomNum is not null";
  $result = $conn->query($query);
  $queryTwo = "Select * from rooms";
  $resultTwo = $conn->query($queryTwo);
  $query3 = "SELECT * FROM bookingData WHERE NOT EXISTS (SELECT * FROM bookings WHERE bookings.bookingCode = bookingData.bookingCode)";
  $result3 = $conn->query($query3);
  $query4 = "SELECT * FROM rooms WHERE NOT EXISTS (SELECT * FROM bookings WHERE bookings.roomNum = rooms.roomNum)";
  $result4 = $conn->query($query4);
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

  <!-- The Band Section -->
  <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
    <h2 class="w3-wide">Check/update booking data</h2>
    <p class="w3-opacity"><i>Administrative use only, see all current completed bookings, update discount and check-in status</i></p>
<table>
<tr bgcolor=#f5edd7>
<td>Booking Code</td>
<td>Room Number</td>
<td>Number of Guests</td>
<td>In Date</td>
<td>Out Date</td>
<td>In Status</td>
<td>Payment Type</td>
<td>Discount</td>
<td>Guest Name</td>
</tr>
<?php
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>"; echo $row["bookingCode"]; echo "</td>";
echo "<td>"; echo $row["roomNum"]; echo "</td>";
echo "<td>"; echo $row["numGuests"]; echo "</td>";
echo "<td>"; echo $row["inDate"]; echo "</td>";
echo "<td>"; echo $row["outDate"]; echo "</td>";
echo "<td>"; echo $row["inStatus"]; echo "</td>";
echo "<td>"; echo $row["paymentType"]; echo "</td>";
echo "<td>"; echo $row["discount"]; echo "</td>";
echo "<td>"; echo $row["guestName"]; echo "</td>";
echo "</tr>";
}
echo "</table>";
?>
<form action="administrationAdmin.php" method="post"><pre>
      Booking Code:    <input type="text" name="bookingCodeUp">
      Discount:        <input type="text" name="discountUp">
      Check in Status: <input type="text" name="inStatusUp">
                       <input type="submit" value="Update Record">
  </pre></form>

  <form action="administrationAdmin.php" method="post"><pre>
      Booking Code to Remove:    <input type="text" name="bookingCodeDel">
                                 <input type="submit" value="Delete Booking Record">
  </pre></form>
    </div>
  </div>


  <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
    <h2 class="w3-wide">Assign room</h2>
    <p class="w3-opacity"><i>Administrative use only, MUST assign room to current booking</i></p>
<table>
<tr bgcolor=#f5edd7>
<td>Room Number</td>
<td>Room Type</td>
<td>Max Guests</td>
<td>Cleaner</td>
<td>Cost</td>
</tr>
<?php
while($rows = mysqli_fetch_array($result4))
{
echo "<tr>";
echo "<td>"; echo $rows["roomNum"]; echo "</td>";
echo "<td>"; echo $rows["roomType"]; echo "</td>";
echo "<td>"; echo $rows["maxGuests"]; echo "</td>";
echo "<td>"; echo $rows["cleaner"]; echo "</td>";
echo "<td>"; echo $rows["cost"]; echo "</td>";
echo "</tr>";
}
echo "</table>";
?>

<table>
<tr bgcolor=#f5edd7>
<td>Booking Code</td>
<td>Number of Guests</td>
<td>In Date</td>
<td>Out Date</td>
<td>In Status</td>
<td>Payment Type</td>
<td>Discount</td>
<td>Guest Name</td>
</tr>
<?php
while($row = mysqli_fetch_array($result3))
{
echo "<tr>";
echo "<td>"; echo $row["bookingCode"]; echo "</td>";
echo "<td>"; echo $row["numGuests"]; echo "</td>";
echo "<td>"; echo $row["inDate"]; echo "</td>";
echo "<td>"; echo $row["outDate"]; echo "</td>";
echo "<td>"; echo $row["inStatus"]; echo "</td>";
echo "<td>"; echo $row["paymentType"]; echo "</td>";
echo "<td>"; echo $row["discount"]; echo "</td>";
echo "<td>"; echo $row["guestName"]; echo "</td>";
echo "</tr>";
}
echo "</table>";
?>

  <form action="administrationAdmin.php" method="post"><pre>
      Booking Code:    <input type="text" name="bookingCodeIn">
      Room Number:     <input type="text" name="roomNumIn">
                       <input type="submit" value="Assign room">
  </pre></form>
  </div>

  <div class="w3-black" id="tour">
    <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
      <h2 class="w3-wide w3-center">Check all rooms</h2>
      <p class="w3-opacity w3-center"><i>Administrative use only, see all current rooms</i></p><br>
<table>
<tr bgcolor=#6e6d6d>
<td>Room Number</td>
<td>Room Type</td>
<td>Max Guests</td>
<td>Cleaner</td>
<td>Cost</td>
</tr>
<?php
while($rows = mysqli_fetch_array($resultTwo))
{
echo "<tr>";
echo "<td>"; echo $rows["roomNum"]; echo "</td>";
echo "<td>"; echo $rows["roomType"]; echo "</td>";
echo "<td>"; echo $rows["maxGuests"]; echo "</td>";
echo "<td>"; echo $rows["cleaner"]; echo "</td>";
echo "<td>"; echo $rows["cost"]; echo "</td>";
echo "</tr>";
}
echo "</table>";
?>

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
  $resultTwo->close();
$result3->close();
$result4->close();
$result5->close();
$result6->close();
$result7->close();
$result8->close();
$result9->close();
  $result->close();
  $conn->close();
?>
</body>
</html>