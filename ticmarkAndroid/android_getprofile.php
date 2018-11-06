<?php

include 'android_connection.php';


$output=array();
$user_id = $_POST['user_id'];



$check="SELECT * FROM users WHERE user_id='$user_id'";
$result=mysqli_query($conn,$check);

$row=mysqli_fetch_assoc($result);
if(mysqli_num_rows($result)>0)

{

$pass['name']=$row['Name'];
$pass['details']=$row;

$lvl=$row['user_level'];
$user=$row['user_id'];
$level="SELECT * FROM user_level WHERE id='$lvl'";
$lr=mysqli_query($conn,$level);
$lev=mysqli_fetch_assoc($lr);
$pass['level']=$lev['name'];


$volume="SELECT * FROM user_volume WHERE user_id='$user'";
$voler=mysqli_query($conn,$volume);
$vol=mysqli_fetch_assoc($voler);
$pass['volume']=$vol['volume'];

$count=mysqli_query($conn,"SELECT (SELECT COUNT(*) FROM users WHERE reffered_by='$user') AS count");
$c_r=mysqli_fetch_assoc($count);
$no=$c_r['count'];
$pass['count']=$no;


$under="SELECT 	Name,user_id,mobile FROM users WHERE reffered_by='$user'";
$u_result=mysqli_query($conn,$under);
while($u_list=mysqli_fetch_assoc($u_result))
{
   $output[]=$u_list;
}


$pass['under']=$output;



$upgrade="SELECT * FROM users WHERE user_level='$lvl' AND reffered_by='$user_id'";
$u_result=mysqli_query($conn,$upgrade);
if(mysqli_num_rows($u_result)==3)
{

	
	$pass['upgrade']="true";

}
else
{
	$pass['upgrade']="False";
}








print_r(json_encode($pass));
}



else{


echo -1;


}


?>

