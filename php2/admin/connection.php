<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "db_btl";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
mysqli_set_charset($conn,"utf8");
?>