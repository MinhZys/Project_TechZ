<?php session_start(); 
include("../config/db.php");
include("header.php");

// Kiểm tra quyền truy cập

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
  
</head>
<body>
    
    <main class="container">
    <section class="welcome-message">
        <h1>Xin chào Admin, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <p>Chào mừng bạn đến với trang quản trị. Chọn một trong các tùy chọn bên dưới để bắt đầu.</p>
    </section>

    <!-- Vùng hiển thị nội dung động -->
    <div id="content-area">
        <!-- Nội dung các trang khác sẽ được tải về đây -->
    </div>

    
</main>

</body>
</html>