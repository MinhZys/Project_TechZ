<?php
// Bắt đầu session
session_start();
include '../config/db.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Kiểm tra username trống
    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    // Kiểm tra phone là số và giới hạn 10 số
    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        $errors[] = "Phone must be a 10-digit number.";
    }

    // Kiểm tra email có chứa @
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Kiểm tra mật khẩu: phải có ký tự viết hoa, ký tự thường, số, ký tự đặc biệt, và dài hơn 6 ký tự
    if (!preg_match('/^.{6,}$/', $password)) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    // Nếu không có lỗi, thực hiện lưu vào cơ sở dữ liệu
    if (empty($errors)) {
        // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Chuẩn bị câu lệnh SQL với prepared statements để tránh SQL Injection
        $stmt = $conn->prepare("INSERT INTO user (user_name, number_phone, email_address, password, role) VALUES (?, ?, ?, ?, 'user')");

        // Kiểm tra xem câu lệnh chuẩn bị có thành công hay không
        if ($stmt === false) {
            die('Error preparing statement: ' . htmlspecialchars($conn->error));
        }

        // Bind các biến vào câu lệnh SQL
        $stmt->bind_param("ssss", $username, $phone, $email, $hashed_password);

        // Thực hiện câu lệnh
        if ($stmt->execute()) {
            // Nếu thành công, điều hướng đến trang người dùng
            $_SESSION['user_name'] = $username;
            $_SESSION['role'] = 'user';
            header("Location: ../user/user_index.php");
        } else {
            echo "Error: " . htmlspecialchars($stmt->error);
        }

        // Đóng câu lệnh
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="../assets/css/create.css"> <!-- Link đến file CSS -->
</head>

<body>
    <div class = "brand">𝘿𝙚𝙘𝙤𝙕</div>

    <div class="container">
        <h2>Create Account</h2>

        <?php
        // Hiển thị lỗi nếu có
        if (!empty($errors)) {
            echo '<div class="errors">';
            foreach ($errors as $error) {
                echo '<p>' . htmlspecialchars($error) . '</p>';
            }
            echo '</div>';
        }
        ?>

        <form action="create.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" name="phone" placeholder="Phone" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <label for="password">Create Password</label>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            
            <button type="submit" name="register">Create Account</button>
            
        </form>
    </div>
</body>

</html>