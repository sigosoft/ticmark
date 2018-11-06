<?php
session_start();
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
