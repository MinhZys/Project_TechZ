<?php
include '../config/db.php';

// Truy vấn lấy dữ liệu sản phẩm từ bảng product
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
?>

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
                    <a href="product_detail.php?id=<?php echo $row['id']; ?>" class="text-decoration-none">
                        <div class="card product-card position-relative">
                            <!-- Hiển thị badge "New" hoặc "Trending" -->
                            <?php if ($row['price'] > 50000): ?>
                                <div class="badge">Trending</div>
                            <?php elseif ($row['price'] < 1000): ?>
                                <div class="badge">New</div>
                            <?php endif; ?>

                            <!-- Hiển thị hình ảnh sản phẩm -->
                            <img src="../admin/productM/image/<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>" class="card-img-top">

                            <div class="card-body product-body">
                                <!-- Hiển thị tên sản phẩm -->
                                <h5 class="product-name"><?php echo $row['name']; ?></h5>

                                <!-- Hiển thị giá sản phẩm -->
                                <p class="price">$<?php echo number_format($row['price'], 2); ?></p>

                                <!-- Nút 'Add to Cart' canh giữa -->
                                <form action="cart.php" method="POST" class="d-flex justify-content-center align-items-center mt-3">
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
