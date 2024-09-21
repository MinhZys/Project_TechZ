<?php
include '../config/db.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra xem có ID sản phẩm được truyền qua URL hay không
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Truy vấn lấy thông tin sản phẩm dựa trên ID
    $sql = "SELECT * FROM product WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra xem sản phẩm có tồn tại hay không
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Sản phẩm không tồn tại.";
        exit();
    }
} else {
    echo "Không có sản phẩm nào được chọn.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/product_detail.css">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <!-- Hiển thị hình ảnh sản phẩm -->
            <img src="../admin/image/<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>" class="img-fluid">
        </div>
        <div class="col-md-6">
            <!-- Hiển thị thông tin chi tiết sản phẩm -->
            <h2><?php echo $product['name']; ?></h2>
            <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
            <p><?php echo $product['description']; ?></p>

            <!-- Nút thêm vào giỏ hàng -->
            <form method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <button type="submit" class="btn btn-primary">Thêm vào giỏ</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Đóng kết nối CSDL
$conn->close();
?>
