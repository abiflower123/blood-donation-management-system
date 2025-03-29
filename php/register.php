<?php

$username=$_POST['username'];
$password=$_POST['password'];
$blood=$_POST['blood'];
$place=$_POST['place'];
$gender=$_POST['gender'];
$phoneno=$_POST['phoneno'];
$email=$_POST['email'];




if (!empty($username)||!empty($password)||!empty($blood)||!empty(place)||!empty($gender)||!empty($phoneno)||!empty($email))

{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "mini";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From register Where email = ? Limit 1";
  $INSERT = "INSERT Into register (username, password ,blood, place,gender,phoneno,email)values(?,?,?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssssis", $username,$password,$blood,$place,$gender,$phoneno,$email);
      $stmt->execute();
      echo "New user registered sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>