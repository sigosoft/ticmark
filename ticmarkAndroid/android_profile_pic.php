<?php
 include 'android_connection.php';


 if($_SERVER['REQUEST_METHOD']=='POST')
 {
 
 $UserImageP = $_POST['UserImageP'];
 $UserID = $_POST['UserID'];   

 $usercon="U";
 $UserImage=$usercon.time();
 
 $userpath = "../outlets/uploads/user/$UserImage.png";

 

 
   
 $sql = "UPDATE users SET UserImage='$UserImage.png' WHERE user_id='$UserID'";
 if(mysqli_query($conn,$sql)){

 file_put_contents($userpath,base64_decode($UserImageP));
 $pass['Status']="Success"; 

 }
 else
 {

  $pass['Status']="Failed"; 

 }

 }

 else
 {

  $pass['Status']="Failed"; 

 }

 print(json_encode($pass));
 
?>