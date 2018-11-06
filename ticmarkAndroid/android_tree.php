<?php

include 'android_connection.php';


$output=array();
$user_id = $_POST['user_id'];

$under="SELECT 	username,user_id,mobile FROM users WHERE reffered_by='$user_id'";
$u_result=mysqli_query($conn,$under);

if(mysqli_num_rows($u_result)>0)
{

while($u_list=mysqli_fetch_assoc($u_result))
{
   $output[]=$u_list;
}

}

else
{
	$output[]="null";
}

$pass['tree']=$output;

print_r(json_encode($pass));

?>