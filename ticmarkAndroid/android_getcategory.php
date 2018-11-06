

<?php 

include 'android_connection.php';

$st= mysqli_query($conn,"SELECT * FROM  category");
 

if(mysqli_num_rows($st) > 0){
while($row=mysqli_fetch_array($st))
$output[]=$row;
print(json_encode($output));
}
else{
	print("no_data");
}


?>