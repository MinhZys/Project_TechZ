<?php
session_start();
include("../config/db.php");

// Kiểm tra quyền truy cập
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login/login.php");
    exit();
}

// Hiển thị thông tin chào mừng
echo "Xin chào Admin, " . htmlspecialchars($_SESSION['username']);

// Liên kết đến trang quản lý người dùng
echo '<br><br>';
echo '<a href="manage_users.php">Quản Lý Người Dùng</a> <br>';
echo '<a href="productM/listP.php">Quản Lý SP</a>';

?>
