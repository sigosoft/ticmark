<?php

include 'android_connection.php';


$output=array();
$user_id = $_POST['user_id'];





	$level=mysqli_query($conn,"UPDATE users SET user_level=user_level+1 WHERE user_id='$user_id'");

	echo "Success";




?>

