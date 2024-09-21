<?php
session_start();
include("../config/db.php");


// Kiểm tra quyền truy cập
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login/login.php");
    exit();
}

include("../admin/header.php");



?>
