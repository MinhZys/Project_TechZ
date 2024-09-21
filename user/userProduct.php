<?php
<<<<<<< HEAD

include '../config/db.php'; // Kết nối cơ sở dữ liệu
include"../user/userHeader.php";

// Xử lý khi người dùng bấm nút "Thêm vào giỏ hàng"
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Kiểm tra xem giỏ hàng đã được tạo trong session hay chưa
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
    if (isset($_SESSION['cart'][$product_id])) {
        // Nếu có, tăng số lượng sản phẩm lên 1
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        // Nếu chưa, lấy thông tin sản phẩm từ cơ sở dữ liệu và thêm vào giỏ hàng
        $sql = "SELECT * FROM product WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        // Thêm sản phẩm vào giỏ hàng
        $_SESSION['cart'][$product_id] = [
            'name' => $product['name'],
            'price' => $product['price'],
            'image_url' => $product['image_url'],
            'quantity' => 1
        ];
    }

    // Thông báo đã thêm vào giỏ hàng (có thể thay đổi thành thông báo thân thiện hơn)
    echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng!');</script>";
}
=======
include '../config/db.php';
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292

// Truy vấn lấy dữ liệu sản phẩm từ bảng product
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
?>

<<<<<<< HEAD

=======
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Sản Phẩm</title>
    <!-- Liên kết Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/userproduct.css">
</head>
<body>

<div class="container-fluid mt-5">
    <h2 class="text-center mb-5">Sản Phẩm Nổi Bật</h2>
    <div class="row g-4">
        <?php if ($result->num_rows > 0): ?>
            <?php 
            $count = 0;
            while($row = $result->fetch_assoc()): 
                if ($count % 4 == 0): // Mở một hàng mới mỗi khi 4 sản phẩm được hiển thị
            ?>
                <div class="row justify-content-center">
                <?php endif; ?>
                
                <div class="col-md-2 d-flex justify-content-center mb-4">
<<<<<<< HEAD
                <a href="product_detail.php?id=<?php echo $row['id']; ?>" class="text-decoration-none">

=======
                    <a href="product_detail.php?id=<?php echo $row['id']; ?>" class="text-decoration-none">
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
                        <div class="card product-card position-relative">
                            <!-- Hiển thị badge "New" hoặc "Trending" -->
                            <?php if ($row['price'] > 50000): ?>
                                <div class="badge">Trending</div>
                            <?php elseif ($row['price'] < 1000): ?>
                                <div class="badge">New</div>
                            <?php endif; ?>

                            <!-- Hiển thị hình ảnh sản phẩm -->
<<<<<<< HEAD
                            <img src="../admin/image/<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>" class="card-img-top">
=======
                            <img src="../admin/productM/image/<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>" class="card-img-top">
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292

                            <div class="card-body product-body">
                                <!-- Hiển thị tên sản phẩm -->
                                <h5 class="product-name"><?php echo $row['name']; ?></h5>

                                <!-- Hiển thị giá sản phẩm -->
                                <p class="price">$<?php echo number_format($row['price'], 2); ?></p>

                                <!-- Nút 'Add to Cart' canh giữa -->
<<<<<<< HEAD
                                <form method="POST" class="d-flex justify-content-center align-items-center mt-3">
=======
                                <form action="cart.php" method="POST" class="d-flex justify-content-center align-items-center mt-3">
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
                                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn add-to-cart-btn">Thêm vào giỏ</button>
                                </form>
                            </div>
                        </div>
                    </a>
                </div>

                <?php 
                $count++;
                if ($count % 4 == 0): // Đóng hàng sau mỗi 4 sản phẩm
                ?>
                </div>
                <?php endif; ?>
            <?php endwhile; ?>
            <!-- Đóng hàng nếu còn sản phẩm chưa hoàn thành hàng -->
            <?php if ($count % 4 != 0): ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <p class="text-center">Không có sản phẩm nào.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Liên kết Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Đóng kết nối CSDL
$conn->close();
?>
