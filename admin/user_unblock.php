<?php


$user_id=$_GET['id'];
require 'db/config.php';

$update=mysqli_query($conn, "UPDATE users SET block=0 WHERE user_id='$user_id'");
header('location:blocked_user.php');



?>