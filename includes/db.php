<?php
$conn = mysqli_connect("localhost", "root", "", "eyendb");

if(!$conn){
    die("Database connection failed: " . mysqli_connect_error());
}
?>
