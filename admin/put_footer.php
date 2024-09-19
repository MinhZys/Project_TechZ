<?php
session_start(); // Bắt đầu phiên làm việc

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    // Nếu chưa đăng nhập, bạn có thể điều hướng về trang đăng nhập hoặc hiển thị thông báo
    header('Location: ../login/login.php');
    exit();
}
?>

<?php
function putFooter() {
    // In ra HTML của phần footer
    echo '<footer>';
    echo '<div style="text-align: center; padding: 20px; background-color: #f1f1f1;">';
    echo '<p>&copy; 2024 Your Website Name. All Rights Reserved.</p>';
    echo '<p><a href="privacy.php">Privacy Policy</a> | <a href="terms.php">Terms of Service</a></p>';
    echo '</div>';
    echo '</footer>';
}

// Gọi hàm để hiển thị footer
putFooter();
?>
