<?php
// Bắt đầu session
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn để kiểm tra username và password
    $sql = "SELECT * FROM user WHERE user_name='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Lấy dữ liệu người dùng
        $row = $result->fetch_assoc();
        $_SESSION['user_name'] = $username;
        $_SESSION['role'] = $row['role'];

        // Điều hướng theo vai trò
        if ($row['role'] == 'admin') {
            header("Location: ../admin/admin_index.php");
        } elseif ($row['role'] == 'user') {
            header("Location: ../user/user_index.php");
        } elseif ($row['role'] == 'designer') {
            header("Location: ../designer/designer_index.php");
        }
    } else {
        echo "Tên đăng nhập hoặc mật khẩu sai!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>
<body>
    <form method="POST" action="">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Mật khẩu:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Đăng nhập">
    </form>
</body>
</html>
