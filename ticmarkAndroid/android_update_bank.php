<?php
include 'android_connection.php';



$output=array();

$UserID=$_POST['UserID'];
$AccountHolder=$_POST['AccountHolder'];
$BankName=$_POST['BankName'];
$account_no=$_POST['account_no'];
$IFSCCode=$_POST['IFSCCode'];



$sql= "UPDATE users SET AccountHolder='$AccountHolder', BankName='$BankName', account_no='$account_no',  IFSCCode='$IFSCCode' WHERE user_id='$UserID'";

 


if (mysqli_query($conn, $sql))
 {

 $pass['Status']="Success";
 
 }
 else
 {
   echo mysqli_error($conn);
 $pass['Status']="Failed";
   
  }


  print_r(json_encode($pass));


?>

