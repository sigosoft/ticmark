<?php

include 'android_connection.php';

// $category_id = $_POST['category_id'];
// $user_id = $_POST['user_id'];


$st= mysqli_query($conn,"SELECT * FROM news");
 

if(mysqli_num_rows($st) > 0){
while($row=mysqli_fetch_array($st))
$output[]=$row;
print(json_encode($output));
}
else{
	print("no_data");
}



?>

