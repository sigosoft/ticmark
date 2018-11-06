<?php
session_start();
if(!isset($_SESSION['outlet']))
 {
   header('location:index.php');
 };

date_default_timezone_set('Asia/Kolkata');

$outlet=$_SESSION['outlet'];
$outlet_id=$outlet['id'];

require 'db/config.php';
    $key=$_GET['key'];
    
    $array = array();
    
    $query=mysqli_query($conn,"select * from products where product_name LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['product_name'];
    }
    echo json_encode($array);
?>
