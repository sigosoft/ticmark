<?php


$conn = new mysqli("localhost","works_ticmark","ticmark2018","works_ticmark");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>
