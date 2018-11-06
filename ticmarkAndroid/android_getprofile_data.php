<?php

include 'android_connection.php';



$user_id = $_POST['user_id'];
$profile_id = $_POST['profile_id'];



//$check="SELECT * FROM users WHERE 	reffered_by='$user_id' AND user_level='$profile_id'";
$result=mysqli_query($conn,"SELECT * FROM users WHERE reffered_by='$user_id' AND user_level='$profile_id'");

if(mysqli_num_rows($result)>0)
{

while($row=mysqli_fetch_assoc($result))

$output[]=$row;
print(json_encode($output));




}


else{
	echo -1;
}




?>

