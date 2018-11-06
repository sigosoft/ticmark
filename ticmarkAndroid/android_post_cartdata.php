<?php 

include 'android_connection.php';

$user=$_POST['user_id'];
$CustomerName=$_POST['CustomerName'];
$CustomerMobileNo=$_POST['CustomerMobileNo'];
$CurrentDate=$_POST['CurrentDate'];
$CustomerPlace=$_POST['CustomerPlace'];
$InvoiceNo=$_POST['InvoiceNo'];
$CurrentTime=$_POST['CurrentTime'];
$data=$_POST['json'];


$json = json_decode($data, true);

$elementCount  = count($json);

$totalvolume=0;

for ($i=0;$i < $elementCount; $i++) 
{





$itemname = $json[$i]['itemname'];
$qty = $json[$i]['qty'];
$price = $json[$i]['price'];

$sql="SELECT * FROM products WHERE product_name='$itemname'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$volume = $row['volume'];

$tv=$volume*$qty;

$totalvolume = $totalvolume+$tv;

mysqli_query($conn,"INSERT INTO user_sale  
SET   
user_id =  $user,
product= '$itemname',
qty = '$qty',
price = '$price',
invoice_number = '$InvoiceNo',  
customer_name = '$CustomerName',  
customer_number = '$CustomerMobileNo',  
customer_place = '$CustomerPlace',  
c_date = '$CurrentDate',  
c_time = '$CurrentTime',
volume = '$volume'
");   

$inventory="UPDATE user_stock SET stock=stock-'$qty' WHERE product_name='$itemname' AND user_id='$user'";
mysqli_query($conn,$inventory);


}



echo "success";

?>