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
    <!-- Link to custom CSS file -->
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center flex-column" style="height: 100vh;">
        <!-- Thương hiệu DecoZ bên ngoài khung đăng nhập -->
        <div class="brand">𝘿𝙚𝙘𝙤𝙕</div>

        <div class="card shadow p-4">
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
