<?php
// Giả sử sản phẩm lấy từ cơ sở dữ liệu
$product = [
    'id' => 1,
    'name' => 'Multi-Way Ultra',
    'description' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.',
    'price' => 24.5,
    'image' => 'path/to/product_image.jpg', // Đường dẫn hình ảnh
];

// Xử lý form giỏ hàng (giả sử có thêm vào giỏ hàng)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);
    
    // Logic thêm sản phẩm vào giỏ hàng, ví dụ lưu session
    // $_SESSION['cart'][$product_id] = $quantity;
    
    echo "Đã thêm sản phẩm vào giỏ hàng!";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-detail {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        .product-image {
            max-width: 45%;
        }
        .product-image img {
            width: 100%;
            border-radius: 5px;
        }
        .product-info {
            max-width: 45%;
        }
        .product-info h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .product-info .price {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 15px;
        }
        .product-info .description {
            margin-bottom: 20px;
        }
        .product-info .quantity {
            margin-bottom: 15px;
        }
        .btn-add-to-cart {
            background-color: #bca87c;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
        }
        .btn-add-to-cart:hover {
            background-color: #a8936d;
        }
        .tabs {
            margin-top: 30px;
        }
        .tabs .tab-content {
            padding: 20px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="product-detail">
            <!-- Phần Hình ảnh sản phẩm -->
            <div class="product-image">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            </div>

            <!-- Phần thông tin sản phẩm -->
            <div class="product-info">
                <h1><?php echo $product['name']; ?></h1>
                <p class="price">Price: $<?php echo number_format($product['price'], 2); ?></p>
                <p class="description"><?php echo $product['description']; ?></p>

                <!-- Form chọn số lượng và thêm vào giỏ hàng -->
                <form action="" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    
                    <div class="quantity">
                        <label for="quantity">Quantity:</label>
                        <select name="quantity" id="quantity" class="form-control" style="width: 100px;">
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-add-to-cart">Add to Cart</button>
                </form>
            </div>
        </div>

        <!-- Tabs cho mô tả và đánh giá -->
        <div class="tabs">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Specification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Reviews (2)</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="description">
                    <h4>Product Description</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
