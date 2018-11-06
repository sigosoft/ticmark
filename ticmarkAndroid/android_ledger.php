<?php
include 'android_connection.php';



$output=array();

$UserID=$_POST['UserID'];



$sql= mysqli_query($conn,"SELECT * FROM user_ledger WHERE user_id='$UserID' ORDER BY id DESC");
 

if(mysqli_num_rows($sql) > 0){

while($row=mysqli_fetch_assoc($sql))
{

$ledger[]=$row;

}



}

else{

$ledger[]="No Data";

}


$output['ledger']=$ledger;





$pass=$output;


print(json_encode($output));


?>

