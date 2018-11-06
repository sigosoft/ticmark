<?php
include 'android_connection.php';



$output=array();

$UserID=$_POST['UserID'];


$sql= mysqli_query($conn,"SELECT * FROM payment_request WHERE UserID='$UserID' ORDER BY PaymentRequestID DESC");
 

if(mysqli_num_rows($sql) > 0){

while($row=mysqli_fetch_assoc($sql))
{

$Request[]=$row;

}



}

else{

$Request[]="No Request";

}


$output['Request']=$Request;





$pass=$output;


print(json_encode($output));


?>

