<?php

include 'android_connection.php';

$username = $_POST['username'];
$password = md5($_POST['password']);



$check="SELECT * FROM users WHERE 	mobile='$username' AND password='$password'";
$result=mysqli_query($conn,$check);
$row=mysqli_fetch_assoc($result);
if(mysqli_num_rows($result)>0)

{
    
$block=$row['block'];

if($block==0)
{
    
$id=$row['user_id'];
echo $id;

    
}
else
{

echo -2;    
    
}

}

else{

echo -1;

}

?>