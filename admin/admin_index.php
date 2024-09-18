<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location:../login/login.html");
    exit();
}

echo "Xin chào Admin, " . $_SESSION['user_name'];
?>
