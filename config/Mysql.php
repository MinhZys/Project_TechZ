<?php
// Thông tin kết nối database
$servername = "localhost"; // Địa chỉ server, thường là localhost
$username = "root"; // Tên tài khoản MySQL của bạn
$password = ""; // Mật khẩu của MySQL (để trống nếu không có)
$dbname = "decorvista"; // Tên database mà bạn đã tạo

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

// Truy vấn ví dụ - Lấy danh sách users từ bảng users
$sql = "SELECT id, first_name, last_name, email FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Xuất dữ liệu của từng hàng
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Name: " . $row["first_name"]. " " . $row["last_name"]. " - Email: " . $row["email"]. "<br>";
    }
} else {
    echo "0 results";
}

// Đóng kết nối
$conn->close();
?>
