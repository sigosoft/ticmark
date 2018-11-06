<?php 

include 'android_connection.php';

//$output=array();

// $check="SELECT id FROM  brand_table";
// $result=mysqli_query($conn,$check);

// while($row=mysqli_fetch_assoc($result))
// {

// $output[]=$row;
// print(json_encode($output));

// }


$st= mysqli_query($conn,"SELECT * FROM  slider");
 

if(mysqli_num_rows($st) > 0){
while($row=mysqli_fetch_array($st))
$output[]=$row;
print(json_encode($output));
}
else{
	print("no_data");
}


?>