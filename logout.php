<?php
session_start();

$_SESSION = [];

session_destroy();
session_start(); 
$_SESSION['success'] = "  loged out   ";

header("Location: login.php");
exit();

?>
