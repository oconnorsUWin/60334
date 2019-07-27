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

   if(isset($_POST['LoginButton'])){
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT userCode FROM userData WHERE username = '$myusername' and userpass = '$mypassword'";
      $result = $conn->query($sql);
      $row = mysqli_fetch_assoc($result);
      if( $row['userCode']=="1"){header('Location: homeAdmin.php'); }   //MAKE THIS GO TO ADMIN VERSION
      if( $row['userCode']=="2"){header('Location: home.php'); }   //MAKE THIS GO TO GUEST VERSION
   }
?>
  <div class="w3-black w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
<form action = "loginPage.php" method = "post">
 <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
 <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
 <input type = "submit" value = " Submit " name="LoginButton"/><br />
</form>
  </div>

<?php
  $result->close();
  $conn->close();
?>
</body>
</html>