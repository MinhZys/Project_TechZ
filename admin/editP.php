<?php
// Kết nối đến CSDL
include '../../config/db.php';

// Kiểm tra xem có truyền ID sản phẩm không
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin sản phẩm
    $sql_get_sp = "SELECT * FROM product WHERE id='$id'";
    $query_get_sp = mysqli_query($conn, $sql_get_sp);
    $product = mysqli_fetch_array($query_get_sp);
}

// Kiểm tra xem người dùng có gửi dữ liệu không
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $brand_id = mysqli_real_escape_string($conn, $_POST['brand_id']);
    $material_id = mysqli_real_escape_string($conn, $_POST['material_id']);

    // Xử lý hình ảnh
    if ($_FILES['image_file']['name']) {
        $hinhanh = $_FILES['image_file']['name'];
        $hinhanh_tmp = $_FILES['image_file']['tmp_name'];
        $hinhanh_save_path = "../productM/image/" . $hinhanh;

        // Di chuyển tệp hình ảnh vào thư mục
        if (move_uploaded_file($hinhanh_tmp, $hinhanh_save_path)) {
            $sql_update_sp = "UPDATE product SET 
                                name='$name', 
                                image_url='$hinhanh', 
                                price='$price', 
                                description='$description', 
                                category_id='$category_id', 
                                brand_id='$brand_id', 
                                material_id='$material_id' 
                              WHERE id='$id'";
        } else {
            echo "Có lỗi xảy ra khi tải hình ảnh lên.";
        }
    } else {
        // Nếu không tải hình ảnh mới, chỉ cập nhật các trường khác
        $sql_update_sp = "UPDATE product SET 
                            name='$name', 
                            price='$price', 
                            description='$description', 
                            category_id='$category_id', 
                            brand_id='$brand_id', 
                            material_id='$material_id' 
                          WHERE id='$id'";
    }

    // Thực thi câu lệnh SQL
    if (mysqli_query($conn, $sql_update_sp)) {
        echo "Cập nhật sản phẩm thành công!";
        header("Location: ../listP.php");
        exit;
    } else {
        echo "Có lỗi xảy ra: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sửa sản phẩm</title>
</head>
<body>
    <h2>Sửa sản phẩm</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Tên sản phẩm:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required><br>

        <label>Hình ảnh:</label>
        <input type="file" name="image_file"><br>

        <label>Giá sản phẩm:</label>
        <input type="text" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required><br>

        <label>Tóm tắt:</label>
        <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea><br>

        <label>Danh mục:</label>
        <select name="category_id" required>
            <?php
            // Lấy danh mục từ bảng category
            $sql_danhmuc = "SELECT * FROM category";
            $query_danhmuc = mysqli_query($conn, $sql_danhmuc);
            while ($row = mysqli_fetch_array($query_danhmuc)) {
                $selected = ($row['category_id'] == $product['category_id']) ? 'selected' : '';
                echo "<option value='" . $row['category_id'] . "' $selected>" . $row['name'] . "</option>";
            }
            ?>
        </select><br>

        <label>Thương hiệu:</label>
        <select name="brand_id" required>
            <?php
            // Lấy danh sách thương hiệu từ bảng brand
            $sql_brand = "SELECT * FROM brand";
            $query_brand = mysqli_query($conn, $sql_brand);
            while ($row = mysqli_fetch_array($query_brand)) {
                $selected = ($row['brand_id'] == $product['brand_id']) ? 'selected' : '';
                echo "<option value='" . $row['brand_id'] . "' $selected>" . $row['name'] . "</option>";
            }
            ?>
        </select><br>

        <label>Vật liệu:</label>
        <select name="material_id" required>
            <?php
            // Lấy danh sách vật liệu từ bảng material
            $sql_material = "SELECT * FROM material";
            $query_material = mysqli_query($conn, $sql_material);
            while ($row = mysqli_fetch_array($query_material)) {
                $selected = ($row['id'] == $product['material_id']) ? 'selected' : '';
                echo "<option value='" . $row['id'] . "' $selected>" . $row['material_type'] . "</option>";
            }
            ?>
        </select><br>

        <input type="submit" value="Cập nhật sản phẩm">
    </form>
</body>
</html>
