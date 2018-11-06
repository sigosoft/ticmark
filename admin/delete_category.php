<?php
session_start();
if(!isset($_SESSION['admin']))
 {
   header('location:index.php');
 };
require 'db/config.php';

$id=$_GET['id'];

$sql="DELETE FROM category WHERE id=$id";
mysqli_query($conn,$sql);
header('location:view_category.php');


?>



