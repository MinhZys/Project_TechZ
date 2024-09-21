<?php
// Kết nối đến CSDL
include '../../config/db.php';
<<<<<<< HEAD
include 'index_attributes.php';
=======
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292

// Kiểm tra nếu có id trong URL, thì sẽ là sửa brand
if (isset($_GET['idb'])) {
    $id = intval($_GET['idb']);
    // Lấy dữ liệu của brand cần sửa
    $sql_get = "SELECT * FROM brand WHERE brand_id = $id";
    $result = mysqli_query($conn, $sql_get);
    $brand = mysqli_fetch_assoc($result);
}

// Thêm hoặc sửa brand nếu có yêu cầu
if (isset($_POST['save_brand'])) {
    $name = mysqli_real_escape_string($conn, $_POST['brand_name']);
<<<<<<< HEAD

=======
    
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
    if (isset($_GET['idb'])) {
        // Sửa brand
        $sql_update = "UPDATE brand SET name = '$name' WHERE brand_id = $id";
        if (mysqli_query($conn, $sql_update)) {
            echo "<script>alert('Cập nhật thương hiệu thành công!');</script>";
        } else {
            echo "<script>alert('Lỗi: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        // Thêm thương hiệu mới
        $sql_add = "INSERT INTO brand (name) VALUES ('$name')";
        if (mysqli_query($conn, $sql_add)) {
            echo "<script>alert('Thêm thương hiệu thành công!');</script>";
        } else {
            echo "<script>alert('Lỗi: " . mysqli_error($conn) . "');</script>";
        }
    }
    // Sau khi thêm hoặc sửa, chuyển hướng về trang quản lý
    header("Location: brandM.php");
    exit();
}

// Xóa brand nếu có yêu cầu
if (isset($_GET['deleteb'])) {
    $id = intval($_GET['deleteb']);
    $sql_delete = "DELETE FROM brand WHERE brand_id = $id";
    if (mysqli_query($conn, $sql_delete)) {
        echo "<script>alert('Xóa thương hiệu thành công!');</script>";
    } else {
        echo "<script>alert('Lỗi: " . mysqli_error($conn) . "');</script>";
    }
}

// Lấy dữ liệu từ bảng brand
$sql_lietke_br = "SELECT * FROM brand ORDER BY brand_id DESC";
$query_lietke_br = mysqli_query($conn, $sql_lietke_br);
?>

<!DOCTYPE html>
<html lang="vi">
<<<<<<< HEAD

=======
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý thương hiệu</title>
    <link rel="stylesheet" href="../../assets/css/attributes.css">
    <style>
        .back-button {
            margin-bottom: 20px;
        }

        .back-button button {
            padding: 8px 16px;
            background-color: #bca87c;
            /* Màu của nút */
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .back-button button:hover {
            background-color: #a89470;
            /* Màu khi hover */
        }
    </style>
</head>
<<<<<<< HEAD

=======
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
<body>

    <div class="header">
        <h1>Quản lý thương hiệu</h1>
<<<<<<< HEAD

=======
        <!-- Nút Quay lại trang chính -->
        <div class="back-button">
            <button onclick="window.location.href='index.php'">Quay lại trang chính</button>
        </div>
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
    </div>

    <!-- Form thêm hoặc sửa thương hiệu -->
    <form method="POST" action="">
        <label for="brand_name"><?php echo isset($_GET['idb']) ? 'Sửa thương hiệu' : 'Tên thương hiệu mới'; ?>:</label>
<<<<<<< HEAD
        <input type="text" id="brand_name" name="brand_name"
            value="<?php echo isset($brand) ? htmlspecialchars($brand['name']) : ''; ?>" required>
=======
        <input type="text" id="brand_name" name="brand_name" value="<?php echo isset($brand) ? htmlspecialchars($brand['name']) : ''; ?>" required>
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
        <button type="submit" name="save_brand"><?php echo isset($_GET['idb']) ? 'Cập nhật' : 'Thêm'; ?></button>
    </form>

    <table>
        <tr>
            <th>Id</th>
            <th>Tên thương hiệu</th>
            <th>Quản lý</th>
        </tr>
        <?php
        // Hiển thị danh sách thương hiệu
        if (mysqli_num_rows($query_lietke_br) > 0) {
            while ($row = mysqli_fetch_array($query_lietke_br)) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['brand_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td>
                        <a href="brandM.php?idb=<?php echo urlencode($row['brand_id']); ?>">Sửa</a> |
<<<<<<< HEAD
                        <a href="brandM.php?deleteb=<?php echo urlencode($row['brand_id']); ?>" class="delete-button"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này?')">Xóa</a>
=======
                        <a href="brandM.php?deleteb=<?php echo urlencode($row['brand_id']); ?>" class="delete-button" onclick="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này?')">Xóa</a>
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='3'>Không có thương hiệu nào trong CSDL.</td></tr>";
        }
        ?>
    </table>

</body>
<<<<<<< HEAD

</html>
=======
</html>
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
