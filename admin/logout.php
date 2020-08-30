<?php
session_start();
unset($_SESSION['admin-login']);
unset($_SESSION['admin-username']);
header('location:login.php');
die();
?>