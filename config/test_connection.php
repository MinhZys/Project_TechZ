<?php
// Đường dẫn đến tệp db.php
require_once 'config/db.php';

// Kiểm tra kết nối
if ($conn) {
    echo "<h2>Kết nối đến cơ sở dữ liệu thành công!</h2>";
} else {
    echo "<h2>Kết nối đến cơ sở dữ liệu thất bại!</h2>";
}
?>
