<?php
$serveur = "localhost";
$dbname = "javahiste_base";
$user = "root";
$pass = "";

$dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/* $sql =  'SELECT user_pseudo FROM utilisateur';
foreach($conn->query($sql) as $row) {
print($row['user_pseudo']."\t");
} */
?>