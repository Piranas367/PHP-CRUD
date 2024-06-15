<?php
$servername = "mysql";
$username = "root";
$password = "password";
$dbname = "school";


 //Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


 //Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else{
  //echo "Connected successfully";
}
?>