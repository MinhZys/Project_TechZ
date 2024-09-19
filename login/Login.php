<?php
session_start();
include("../config/db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kết nối đến cơ sở dữ liệu
    $stmt = $conn->prepare("SELECT * FROM user WHERE user_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];

            // Chuyển hướng theo vai trò
            switch ($_SESSION['role']) {
                case 'admin':
                    header('Location: ../admin/admin_index.php');
                    break;
                case 'user':
                    header('Location: ../user/user_index.php');
                    break;
                case 'designer':
                    header('Location: ../designer/designer_index.php');
                    break;
            }
            exit;
        } else {
            $error = "Mật khẩu không đúng.";
        }
    } else {
        $error = "Tên đăng nhập không tồn tại.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập</title>
</head>
<body>
    <h2>Đăng Nhập</h2>
    <form method="post">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Mật khẩu:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Đăng Nhập">
    </form>
    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
</body>
</html>
