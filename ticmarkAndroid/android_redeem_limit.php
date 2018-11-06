<?php


include 'android_connection.php';

$query=mysqli_query($conn,"SELECT redeem_points FROM redeem_limit WHERE id=1");
$qrow=mysqli_fetch_assoc($query);
$limited=$qrow['redeem_points'];



 $pass['Points']=$limited;
  
 print_r(json_encode($pass));




?>