<?php
session_start();
require 'db/config.php';


      $inputJSON = file_get_contents('php://input');
      $input = json_decode($inputJSON, TRUE); 

      $product=$input['typeahead'];
    
    // $product=$_GET['q'];

    $array = array();
    
    $query=mysqli_query($conn,"select * from products where product_name='$product'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array['price'] = $row['price'];
    }
   
$tempData = $array;




$cleanData =  json_encode($tempData);
print_r($cleanData);


?>
