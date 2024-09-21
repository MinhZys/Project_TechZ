<?php
<<<<<<< HEAD
session_start(); // Khởi tạo session để lấy dữ liệu giỏ hàng
?>

=======
session_start();

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Xử lý thêm sản phẩm vào giỏ hàng
if (isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);

    // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    } else {
        // Truy vấn sản phẩm từ CSDL
        include '../config/db.php';
        $sql = "SELECT * FROM product WHERE id = $product_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            // Thêm sản phẩm vào giỏ hàng
            $_SESSION['cart'][$product_id] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'image_url' => $product['image_url'],
                'quantity' => 1
            ];
        }

        $conn->close();
    }

    header("Location: cart.php");
    exit();
}

// Hiển thị giỏ hàng
?>
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<<<<<<< HEAD
    <style>
        .cart-item {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 20px;
        }
        .cart-item img {
            width: 80px;
            height: auto;
        }
        .cart-total {
            font-size: 1.5em;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Giỏ Hàng Của Bạn</h2>
    
    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
        <div class="row">
            <div class="col-lg-8">
                <?php 
                $total_price = 0;
                foreach ($_SESSION['cart'] as $id => $item): 
                    $item_total = $item['price'] * $item['quantity'];
                    $total_price += $item_total;
                ?>
                <!-- Sản phẩm trong giỏ hàng -->
                <div class="cart-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="../admin/image/<?php echo $item['image_url']; ?>" alt="<?php echo $item['name']; ?>">
                        <div class="ms-3">
                            <h5><?php echo $item['name']; ?></h5>
                            <p>$<?php echo number_format($item['price'], 2); ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <form method="POST" class="d-inline">
                            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="form-control me-2" style="width: 60px;">
                            <button type="submit" class="btn btn-info btn-sm">Cập Nhật</button>
                        </form>
                        <form method="POST" class="ms-2 d-inline">
                            <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                            <button type="submit" name="remove" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </div>
                    <div class="text-end">
                        <p class="mb-0">Tổng: $<?php echo number_format($item_total, 2); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-4">
                <div class="cart-summary p-4 bg-light rounded">
                    <h4 class="cart-total">Tổng Cộng: $<?php echo number_format($total_price, 2); ?></h4>
                    <a href="#" class="btn btn-success w-100 mt-3">Thanh Toán</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p class="text-center">Giỏ hàng của bạn đang trống.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
=======
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Giỏ Hàng</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Hình Ảnh</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                    <tr>
                        <td><img src="../admin/productM/image/<?php echo $item['image_url']; ?>" alt="<?php echo $item['name']; ?>" width="50"></td>
                        <td><?php echo $item['name']; ?></td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Giỏ hàng trống.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
</body>
</html>
