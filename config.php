<?php 

$host = "localhost";
$username = "root";
$password = "";
$db = "booking";

$conn = mysqli_connect($host,$username,$password,$db);

if(!$conn){

    echo "error in database connection ";
}
?>