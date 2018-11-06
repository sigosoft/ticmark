<?php
$id=$_GET['id'];
require 'db/config.php';

$sql="DELETE FROM slider WHERE id='$id'";
mysqli_query($conn,$sql);
header('location:view_slider.php');


?>