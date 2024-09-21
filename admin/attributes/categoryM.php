<?php
// Kết nối đến CSDL
include '../../config/db.php';
include 'index_attributes.php';

// Kiểm tra nếu có id trong URL, thì sẽ là sửa danh mục
if (isset($_GET['idc'])) {
    $id = intval($_GET['idc']);
    // Lấy dữ liệu của category cần sửa
    $sql_get = "SELECT * FROM category WHERE category_id = $id";
    $result = mysqli_query($conn, $sql_get);
    $category = mysqli_fetch_assoc($result);
}

// Thêm hoặc sửa category nếu có yêu cầu
if (isset($_POST['save_category'])) {
    $name = mysqli_real_escape_string($conn, $_POST['category_name']);

    if (isset($_GET['idc'])) {
        // Sửa danh mục
        // Sử dụng Prepared Statements để bảo mật
        $stmt_update = $conn->prepare("UPDATE category SET name = ? WHERE category_id = ?");
        $stmt_update->bind_param("si", $name, $id);
        if ($stmt_update->execute()) {
            echo "<script>alert('Cập nhật danh mục thành công!');</script>";
        } else {
            echo "<script>alert('Lỗi: " . $stmt_update->error . "');</script>";
        }
        $stmt_update->close();
    } else {
        // Thêm danh mục mới
        // Sử dụng Prepared Statements để bảo mật
        $stmt_add = $conn->prepare("INSERT INTO category (name) VALUES (?)");
        $stmt_add->bind_param("s", $name);
        if ($stmt_add->execute()) {
            echo "<script>alert('Thêm danh mục thành công!');</script>";
        } else {
            echo "<script>alert('Lỗi: " . $stmt_add->error . "');</script>";
        }
        $stmt_add->close();
    }
    // Sau khi thêm hoặc sửa, chuyển hướng về trang quản lý
    header("Location: categoryM.php");
    exit();
}

// Xóa category nếu có yêu cầu
if (isset($_GET['deletec'])) {
    $id = intval($_GET['deletec']);
    // Sử dụng Prepared Statements để bảo mật
    $stmt_delete = $conn->prepare("DELETE FROM category WHERE category_id = ?");
    $stmt_delete->bind_param("i", $id);
    if ($stmt_delete->execute()) {
        echo "<script>alert('Xóa danh mục thành công!');</script>";
    } else {
        echo "<script>alert('Lỗi: " . $stmt_delete->error . "');</script>";
    }
    $stmt_delete->close();
}

// Lấy dữ liệu từ bảng category
$sql_lietke_dm = "SELECT * FROM category ORDER BY category_id DESC";
$query_lietke_dm = mysqli_query($conn, $sql_lietke_dm);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh mục</title>
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

<body>

    <div class="header">
        <h1>Quản lý danh mục</h1>

    </div>

    <!-- Form thêm hoặc sửa danh mục -->
    <form method="POST" action="">
        <label for="category_name"><?php echo isset($_GET['idc']) ? 'Sửa danh mục' : 'Tên danh mục mới'; ?>:</label>
        <input type="text" id="category_name" name="category_name"
            value="<?php echo isset($category) ? htmlspecialchars($category['name']) : ''; ?>" required>
        <button type="submit" name="save_category"><?php echo isset($_GET['idc']) ? 'Cập nhật' : 'Thêm'; ?></button>
    </form>

    <table>
        <tr>
            <th>Id</th>
            <th>Tên danh mục</th>
            <th>Quản lý</th>
        </tr>
        <?php
        // Hiển thị danh sách danh mục
        if (mysqli_num_rows($query_lietke_dm) > 0) {
            while ($row = mysqli_fetch_array($query_lietke_dm)) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['category_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td>
                        <a href="categoryM.php?idc=<?php echo urlencode($row['category_id']); ?>" class="btn-action">Sửa</a> |
                        <a href="categoryM.php?deletec=<?php echo urlencode($row['category_id']); ?>"
                            class="btn-action delete-button"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">Xóa</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='3'>Không có danh mục nào trong CSDL.</td></tr>";
        }
        ?>
    </table>

</body>

</html>