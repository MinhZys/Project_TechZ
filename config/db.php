<?php
// Thông tin kết nối cơ sở dữ liệu
$host = 'localhost'; // Tên máy chủ MySQL
$dbname = 'decorvista'; // Tên cơ sở dữ liệu bạn đã tạo từ tệp SQL
$username = 'root'; // Tên người dùng MySQL (thay đổi nếu cần)
$password = ''; // Mật khẩu MySQL (thay đổi nếu cần)

// Tạo kết nối MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
echo "Kết nối thành công với cơ sở dữ liệu decorvista!";
?>
