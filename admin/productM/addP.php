<?php
    // Kết nối đến CSDL
    include '../../config/db.php';
    
    // Kiểm tra nếu form được submit
    if (isset($_POST['submit'])) {
        // Lấy dữ liệu từ form
        $tensanpham = mysqli_real_escape_string($conn, $_POST['tensanpham']);
        $giasp = mysqli_real_escape_string($conn, $_POST['giasp']);
        $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
        $brand_id = mysqli_real_escape_string($conn, $_POST['brand_id']);
        $material_id = mysqli_real_escape_string($conn, $_POST['material_id']);
        $tomtat = mysqli_real_escape_string($conn, $_POST['tomtat']);
        
        // Lưu hình ảnh sản phẩm
        $hinhanh = $_FILES['hinhanh']['name'];
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $hinhanh_save_path = "../productM/image/" . $hinhanh;
        move_uploaded_file($hinhanh_tmp, $hinhanh_save_path);
        
        // Câu lệnh SQL để thêm sản phẩm
        $sql_them_sp = "
            INSERT INTO product (name, image_url, price, category_id, brand_id, material_id, description) 
            VALUES ('$tensanpham', '$hinhanh', '$giasp', '$category_id', '$brand_id', '$material_id', '$tomtat')
        ";
        
        // Thực thi câu lệnh SQL
        if (mysqli_query($conn, $sql_them_sp)) {
            echo "Thêm sản phẩm thành công!";
            header("Location: http://localhost:1000/Project_TechZ/admin/productM/listP.php");
        } else {
            echo "Có lỗi xảy ra: " . mysqli_error($conn);
        }
    }
?>

<!-- Form thêm sản phẩm -->
<h2>Thêm sản phẩm mới</h2>
<form action="addP.php" method="POST" enctype="multipart/form-data">
    <label for="tensanpham">Tên sản phẩm:</label>
    <input type="text" name="tensanpham" required><br><br>
    
    <label for="giasp">Giá sản phẩm:</label>
    <input type="text" name="giasp" required><br><br>
    
    <label for="category_id">Danh mục sản phẩm:</label>
    <select name="category_id" required>
        <?php
        // Lấy danh mục từ bảng category
        $sql_danhmuc = "SELECT * FROM category";
        $query_danhmuc = mysqli_query($conn, $sql_danhmuc);
        while ($row = mysqli_fetch_array($query_danhmuc)) {
            echo "<option value='" . $row['category_id'] . "'>" . $row['name'] . "</option>";
        }
        ?>
    </select><br><br>
    
    <label for="brand_id">Thương hiệu:</label>
    <select name="brand_id" required>
        <?php
        // Lấy danh sách thương hiệu từ bảng brand
        $sql_brand = "SELECT * FROM brand";
        $query_brand = mysqli_query($conn, $sql_brand);
        while ($row = mysqli_fetch_array($query_brand)) {
            echo "<option value='" . $row['brand_id'] . "'>" . $row['name'] . "</option>";
        }
        ?>
    </select><br><br>
    
    <label for="material_id">Mã vật liệu:</label>
    <input type="text" name="material_id" required><br><br>
    
    <label for="hinhanh">Hình ảnh sản phẩm:</label>
    <input type="file" name="hinhanh" required><br><br>
    
    <label for="tomtat">Tóm tắt sản phẩm:</label>
    <textarea name="tomtat" required></textarea><br><br>
    
    <input type="submit" name="submit" value="Thêm sản phẩm">
</form>
