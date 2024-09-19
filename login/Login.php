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
            echo "<div class='alert alert-danger'>MK đăng nhập sai!</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Tên đăng nhập sai!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <style>
        /* Định dạng thương hiệu DecoZ */
        .brand {
            font-family: 'Poppins', sans-serif; /* Chữ kiểu Poppins */
            font-size: 56px; /* Kích thước lớn hơn */
            font-weight: bold; /* In đậm */
            text-align: center; /* Căn giữa */
            color: #bca87c; /* Màu vàng nhạt */
            margin-bottom: 30px; /* Khoảng cách bên dưới chữ */
            text-transform: uppercase; /* In hoa */
            letter-spacing: 3px; /* Khoảng cách giữa các ký tự */
            position: relative;
            top: -10px; /* Dời chữ lên trên một chút */
        }

        /* Định dạng nút */
        .custom-button {
            background-color: #bca87c; /* Màu nền từ ảnh */
            color: white;
            border-radius: 50px; /* Bo tròn nút */
            padding: 10px 20px;
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease; /* Hiệu ứng */
        }

        .custom-button:hover {
            background-color: #a7926b; /* Màu tối hơn khi hover */
            transform: scale(1.05); /* Phóng to nhẹ khi hover */
        }
    </style>
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center flex-column" style="height: 100vh;">
        <!-- Thương hiệu DecoZ bên ngoài khung đăng nhập -->
        <div class="brand">𝘿𝙚𝙘𝙤𝙕</div>
        <div class="card shadow p-4" style="width: 400px;">
            <h3 class="text-center mb-4">Đăng nhập</h3>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập:</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="custom-button">TIẾP TỤC</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
