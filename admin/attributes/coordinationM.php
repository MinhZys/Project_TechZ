<?php
// Kết nối đến CSDL
include '../../config/db.php';
<<<<<<< HEAD
include 'index_attributes.php';

=======
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292

// Kiểm tra nếu có id trong URL, thì sẽ là sửa color coordination
if (isset($_GET['idco'])) {
    $id = intval($_GET['idco']);
    // Lấy dữ liệu của color coordination cần sửa
    $stmt_get = $conn->prepare("SELECT * FROM color_coordination WHERE coordination_id = ?");
    $stmt_get->bind_param("i", $id);
    $stmt_get->execute();
    $result = $stmt_get->get_result();
    $coordination = $result->fetch_assoc();
    $stmt_get->close();
}

// Thêm hoặc sửa color coordination nếu có yêu cầu
if (isset($_POST['save_coordination'])) {
    $name = trim($_POST['coordination_name']);
    $description = trim($_POST['description']);

    if (empty($name) || empty($description)) {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin.');</script>";
    } else {
        if (isset($_GET['idco'])) {
            // Sửa color coordination sử dụng Prepared Statements
            $stmt_update = $conn->prepare("UPDATE color_coordination SET coordination_name = ?, description = ? WHERE coordination_id = ?");
            $stmt_update->bind_param("ssi", $name, $description, $id);
            if ($stmt_update->execute()) {
                echo "<script>alert('Cập nhật Color Coordination thành công!'); window.location.href='coordinationM.php';</script>";
            } else {
                echo "<script>alert('Lỗi: " . $stmt_update->error . "');</script>";
            }
            $stmt_update->close();
        } else {
            // Thêm color coordination mới sử dụng Prepared Statements
            $stmt_add = $conn->prepare("INSERT INTO color_coordination (coordination_name, description) VALUES (?, ?)");
            $stmt_add->bind_param("ss", $name, $description);
            if ($stmt_add->execute()) {
                echo "<script>alert('Thêm Color Coordination thành công!'); window.location.href='coordinationM.php';</script>";
            } else {
                echo "<script>alert('Lỗi: " . $stmt_add->error . "');</script>";
            }
            $stmt_add->close();
        }
    }
    exit();
}

// Xóa color coordination nếu có yêu cầu
if (isset($_GET['deleteco'])) {
    $id = intval($_GET['deleteco']);
    // Sử dụng Prepared Statements để bảo mật
    $stmt_delete = $conn->prepare("DELETE FROM color_coordination WHERE coordination_id = ?");
    $stmt_delete->bind_param("i", $id);
    if ($stmt_delete->execute()) {
        echo "<script>alert('Xóa Color Coordination thành công!'); window.location.href='coordinationM.php';</script>";
    } else {
        echo "<script>alert('Lỗi: " . $stmt_delete->error . "');</script>";
    }
    $stmt_delete->close();
}

// Lấy dữ liệu từ bảng color coordination
$sql_lietke_coordination = "SELECT * FROM color_coordination ORDER BY coordination_id DESC";
$query_lietke_coordination = mysqli_query($conn, $sql_lietke_coordination);
?>
<!DOCTYPE html>
<html lang="vi">
<<<<<<< HEAD

=======
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Color Coordination</title>
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
        <h1>Quản lý Color Coordination</h1>
<<<<<<< HEAD

=======
        <!-- Nút Quay lại trang chính -->
        <div class="back-button">
            <button onclick="window.location.href='index.php'">Quay lại trang chính</button>
        </div>
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
    </div>

    <!-- Form thêm hoặc sửa color coordination -->
    <form method="POST" action="">
        <label for="coordination_name">
            <?php echo isset($_GET['idco']) ? 'Sửa Color Coordination' : 'Tên Color Coordination mới'; ?>:
        </label>
<<<<<<< HEAD
        <input type="text" id="coordination_name" name="coordination_name"
            value="<?php echo isset($coordination) ? htmlspecialchars($coordination['coordination_name']) : ''; ?>"
            required>

        <label for="description">Mô tả:</label>
        <textarea id="description" name="description" rows="4"
            required><?php echo isset($coordination) ? htmlspecialchars($coordination['description']) : ''; ?></textarea>
=======
        <input type="text" id="coordination_name" name="coordination_name" value="<?php echo isset($coordination) ? htmlspecialchars($coordination['coordination_name']) : ''; ?>" required>

        <label for="description">Mô tả:</label>
        <textarea id="description" name="description" rows="4" required><?php echo isset($coordination) ? htmlspecialchars($coordination['description']) : ''; ?></textarea>
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292

        <button type="submit" name="save_coordination">
            <?php echo isset($_GET['idco']) ? 'Cập nhật' : 'Thêm'; ?>
        </button>
    </form>

    <table>
        <tr>
            <th>Id</th>
            <th>Tên Color Coordination</th>
            <th>Mô tả</th>
            <th>Quản lý</th>
        </tr>
        <?php
        // Hiển thị danh sách color coordination
        if (mysqli_num_rows($query_lietke_coordination) > 0) {
            while ($row = mysqli_fetch_assoc($query_lietke_coordination)) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['coordination_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['coordination_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td>
<<<<<<< HEAD
                        <a href="coordinationM.php?idco=<?php echo urlencode($row['coordination_id']); ?>"
                            class="action-link">Sửa</a> |
                        <a href="coordinationM.php?deleteco=<?php echo urlencode($row['coordination_id']); ?>"
                            class="action-link delete-button"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa Color Coordination này?')">Xóa</a>
=======
                        <a href="coordinationM.php?idco=<?php echo urlencode($row['coordination_id']); ?>" class="action-link">Sửa</a> |
                        <a href="coordinationM.php?deleteco=<?php echo urlencode($row['coordination_id']); ?>" class="action-link delete-button" onclick="return confirm('Bạn có chắc chắn muốn xóa Color Coordination này?')">Xóa</a>
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='4' style='text-align:center;'>Không có Color Coordination nào trong CSDL.</td></tr>";
        }
        ?>
    </table>

</body>
<<<<<<< HEAD

</html>
=======
</html>
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
