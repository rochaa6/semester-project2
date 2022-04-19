<?php
session_start();
// destroy the session by setting username to null (stay logged into demo)
$_SESSION['username'] = null;
header("location: Index.php"); 
?>