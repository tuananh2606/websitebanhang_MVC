<?php
session_start();

session_unset();
session_destroy();
unset($_SESSION['user']);

header("Location: /php2/admin/login.php");

?>