<?php
session_start();


unset($_SESSION['outlet']);

header('location:index.php');

?>