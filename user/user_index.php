<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location:../login/login.html");
    exit();
}

echo "Xin chào User, " . $_SESSION['user_name'];
?>
