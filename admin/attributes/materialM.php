<?php
// Kết nối đến CSDL
include '../../config/db.php';
<<<<<<< HEAD
include 'index_attributes.php';

=======
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292

// Kiểm tra nếu có id trong URL, thì sẽ là sửa material
if (isset($_GET['idm'])) {
    $id = intval($_GET['idm']);
    // Lấy dữ liệu của material cần sửa sử dụng Prepared Statements
    $stmt_get = $conn->prepare("SELECT * FROM material WHERE id = ?");
    $stmt_get->bind_param("i", $id);
    $stmt_get->execute();
    $result = $stmt_get->get_result();
    $material = $result->fetch_assoc();
    $stmt_get->close();
}

// Thêm hoặc sửa material nếu có yêu cầu
if (isset($_POST['save_material'])) {
    $material_type = trim($_POST['material_type']);

    if (empty($material_type)) {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin.');</script>";
    } else {
        if (isset($_GET['idm'])) {
            // Sửa material sử dụng Prepared Statements
            $stmt_update = $conn->prepare("UPDATE material SET material_type = ? WHERE id = ?");
            $stmt_update->bind_param("si", $material_type, $id);
            if ($stmt_update->execute()) {
                echo "<script>alert('Cập nhật loại vật liệu thành công!'); window.location.href='materialM.php';</script>";
            } else {
                echo "<script>alert('Lỗi: " . $stmt_update->error . "');</script>";
            }
            $stmt_update->close();
        } else {
            // Thêm loại vật liệu mới sử dụng Prepared Statements
            $stmt_add = $conn->prepare("INSERT INTO material (material_type) VALUES (?)");
            $stmt_add->bind_param("s", $material_type);
            if ($stmt_add->execute()) {
                echo "<script>alert('Thêm loại vật liệu thành công!'); window.location.href='materialM.php';</script>";
            } else {
                echo "<script>alert('Lỗi: " . $stmt_add->error . "');</script>";
            }
            $stmt_add->close();
        }
    }
    exit();
}

// Xóa material nếu có yêu cầu
if (isset($_GET['deletem'])) {
    $id = intval($_GET['deletem']);
    // Sử dụng Prepared Statements để bảo mật
    $stmt_delete = $conn->prepare("DELETE FROM material WHERE id = ?");
    $stmt_delete->bind_param("i", $id);
    if ($stmt_delete->execute()) {
        echo "<script>alert('Xóa loại vật liệu thành công!'); window.location.href='materialM.php';</script>";
    } else {
        echo "<script>alert('Lỗi: " . $stmt_delete->error . "');</script>";
    }
    $stmt_delete->close();
}

// Lấy dữ liệu từ bảng material sử dụng Prepared Statements
$stmt_lietke = $conn->prepare("SELECT * FROM material ORDER BY id DESC");
$stmt_lietke->execute();
$query_lietke_m = $stmt_lietke->get_result();
$stmt_lietke->close();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý loại vật liệu</title>
    <link rel="stylesheet" href="../../assets/css/attributes.css">
    <style>
        /* CSS cơ bản để cải thiện giao diện */
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
        <h1>Quản lý loại vật liệu</h1>
<<<<<<< HEAD

=======
        <!-- Nút Quay lại trang chính -->
        <div class="back-button">
            <button onclick="window.location.href='index.php'">Quay lại trang chính</button>
        </div>
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
    </div>

    <!-- Form thêm hoặc sửa loại vật liệu -->
    <form method="POST" action="">
        <label for="material_type">
            <?php echo isset($_GET['idm']) ? 'Sửa loại vật liệu' : 'Tên loại vật liệu mới'; ?>:
        </label>
        <input type="text" id="material_type" name="material_type"
            value="<?php echo isset($material) ? htmlspecialchars($material['material_type']) : ''; ?>" required>
        <button type="submit" name="save_material">
            <?php echo isset($_GET['idm']) ? 'Cập nhật' : 'Thêm'; ?>
        </button>
    </form>

    <table>
        <tr>
            <th>Id</th>
            <th>Tên loại vật liệu</th>
            <th>Quản lý</th>
        </tr>
        <?php
        // Hiển thị danh sách loại vật liệu
        if ($query_lietke_m->num_rows > 0) {
            while ($row = $query_lietke_m->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['material_type']); ?></td>
                    <td>
                        <a href="materialM.php?idm=<?php echo urlencode($row['id']); ?>" class="action-link">Sửa</a> |
                        <a href="materialM.php?deletem=<?php echo urlencode($row['id']); ?>" class="action-link delete-button"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa loại vật liệu này?')">Xóa</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='3' style='text-align:center;'>Không có loại vật liệu nào trong CSDL.</td></tr>";
        }
        ?>
    </table>

</body>

</html>