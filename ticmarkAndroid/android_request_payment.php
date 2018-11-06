<?php
include 'android_connection.php';



$output=array();

$UserID=$_POST['UserID'];
$Amount=$_POST['Amount'];
$Notes=$_POST['Notes'];

$block=mysqli_query($conn,"SELECT * FROM users WHERE UserID='$UserID' AND block=0");
if(mysqli_num_rows($block)>0)
{

$validate=mysqli_query($conn,"SELECT * FROM payment_request WHERE UserID='$UserID' AND Status='Waiting'");
if(mysqli_num_rows($validate)>0)
{

 $pass['Status']="Pending Request";
    
}
else
{


$sql= "INSERT INTO payment_request(UserID, Amount, Notes, Status) VALUES ('$UserID', '$Amount', '$Notes', 'Waiting')";
 

if (mysqli_query($conn, $sql))
 {

 $pass['Status']="Success";
 
 }
 else
 {
   
 $pass['Status']="Failed";
   
  }

}
}
else
{
    
  $pass['Status']="Blocked";   
    
}
  print_r(json_encode($pass));




?>

