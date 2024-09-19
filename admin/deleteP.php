<?php
// Kết nối đến CSDL
include '../../config/db.php';

// Kiểm tra xem có truyền ID sản phẩm không
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Câu lệnh SQL để xóa sản phẩm
    $sql_xoa_sp = "DELETE FROM product WHERE id='$id'";

    // Thực thi truy vấn
    if (mysqli_query($conn, $sql_xoa_sp)) {
        echo "Xóa sản phẩm thành công!";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}

// Chuyển hướng về trang danh sách sản phẩm
header("Location: ../listP.php");
exit;
?>
