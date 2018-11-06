<?php
$id=$_GET['id'];
require 'db/config.php';


$sql="DELETE FROM gallery WHERE id='$id'";
mysqli_query($conn,$sql);


header('location:view_images.php');


?>