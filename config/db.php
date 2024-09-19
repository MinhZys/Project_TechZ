<?php
// Thông tin kết nối cơ sở dữ liệu
$host = 'localhost'; // Tên máy chủ MySQL
$dbname = 'decorvista'; // Tên cơ sở dữ liệu bạn đã tạo từ tệp SQL
$username = 'root'; // Tên người dùng MySQL (thay đổi nếu cần)
$password = ''; // Mật khẩu MySQL (thay đổi nếu cần)

// Tạo kết nối MySQL
$conn = new mysqli($host, $username, $password, $dbname);


