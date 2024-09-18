<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'designer') {
    header("Location:../login/login.html");
    exit();
}

echo "Xin chào Designer, " . $_SESSION['user_name'];
?>
