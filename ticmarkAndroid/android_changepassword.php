<?php

include 'android_connection.php';

$user_id = $_POST['user_id'];
$old_password =md5($_POST['old_password']);
$new_password = md5($_POST['new_password']);


$check="SELECT * FROM users WHERE user_id='$user_id' AND password='$old_password'";
$result=mysqli_query($conn,$check);
$row=mysqli_fetch_assoc($result);
if(mysqli_num_rows($result)==1)

{
	
$checkk=mysqli_query($conn,"UPDATE users set password='$new_password' WHERE user_id='$user_id'");

echo 1;

}

else{

echo -2;

}

?>