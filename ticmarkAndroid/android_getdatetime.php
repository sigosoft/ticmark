<?php

include 'android_connection.php';

$user_id=$_POST['user_id'];

date_default_timezone_set('Asia/Kolkata');
$date = date('Y/m/d');
$time = date('H:i:s');
$invoiceno = $user_id.time();
echo $date." ".$time." ".$invoiceno;

?>