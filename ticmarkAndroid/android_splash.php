<?php

include 'android_connection.php';




$query= mysqli_query($conn,"SELECT * FROM video_advertisment");
 

if(mysqli_num_rows($query) > 0){

$row=mysqli_fetch_assoc($query);
$output['Video']=$row;


}

else
{
	$output['Video']="No Video";
}

$pass=$output;

print(json_encode($pass));

?>

