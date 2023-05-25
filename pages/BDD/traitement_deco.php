<?php
session_start();


$_SESSION['user'] = false;
$_SESSION['user_name'] = "";
header("Location:../../index.php");


?>