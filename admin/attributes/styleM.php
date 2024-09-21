<?php
// Kết nối đến CSDL
include '../../config/db.php';
include 'index_attributes.php';


// Kiểm tra nếu có id trong URL, thì sẽ là sửa style
if (isset($_GET['idstyle'])) {
    $id = intval($_GET['idstyle']);
    // Lấy dữ liệu của style cần sửa sử dụng Prepared Statements
    $stmt_get = $conn->prepare("SELECT * FROM style WHERE style_id = ?");
    $stmt_get->bind_param("i", $id);
    $stmt_get->execute();
    $result = $stmt_get->get_result();
    $style = $result->fetch_assoc();
    $stmt_get->close();
}

// Thêm hoặc sửa style nếu có yêu cầu
if (isset($_POST['save_style'])) {
    $name = trim($_POST['style_name']);
    $description = trim($_POST['description']);

    if (empty($name) || empty($description)) {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin.');</script>";
    } else {
        if (isset($_GET['idstyle'])) {
            // Sửa style sử dụng Prepared Statements
            $stmt_update = $conn->prepare("UPDATE style SET style_name = ?, description = ? WHERE style_id = ?");
            $stmt_update->bind_param("ssi", $name, $description, $id);
            if ($stmt_update->execute()) {
                echo "<script>alert('Cập nhật style thành công!'); window.location.href='styleM.php';</script>";
            } else {
                echo "<script>alert('Lỗi: " . $stmt_update->error . "');</script>";
            }
            $stmt_update->close();
        } else {
            // Thêm style mới sử dụng Prepared Statements
            $stmt_add = $conn->prepare("INSERT INTO style (style_name, description) VALUES (?, ?)");
            $stmt_add->bind_param("ss", $name, $description);
            if ($stmt_add->execute()) {
                echo "<script>alert('Thêm style thành công!'); window.location.href='styleM.php';</script>";
            } else {
                echo "<script>alert('Lỗi: " . $stmt_add->error . "');</script>";
            }
            $stmt_add->close();
        }
    }
    exit();
}

// Xóa style nếu có yêu cầu
if (isset($_GET['deletestyle'])) {
    $id = intval($_GET['deletestyle']);
    // Sử dụng Prepared Statements để bảo mật
    $stmt_delete = $conn->prepare("DELETE FROM style WHERE style_id = ?");
    $stmt_delete->bind_param("i", $id);
    if ($stmt_delete->execute()) {
        echo "<script>alert('Xóa style thành công!'); window.location.href='styleM.php';</script>";
    } else {
        echo "<script>alert('Lỗi: " . $stmt_delete->error . "');</script>";
    }
    $stmt_delete->close();
}

// Lấy dữ liệu từ bảng style sử dụng Prepared Statements
$stmt_lietke = $conn->prepare("SELECT * FROM style ORDER BY style_id DESC");
$stmt_lietke->execute();
$query_lietke_style = $stmt_lietke->get_result();
$stmt_lietke->close();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Style</title>
    <link rel="stylesheet" href="../../assets/css/attributes.css">
    <style>
        /* Styles for the back button (Quay lại trang chính) */
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
        <h1>Quản lý Style</h1>

    </div>

    <!-- Form thêm hoặc sửa style -->
    <form method="POST" action="">
        <label for="style_name">
            <?php echo isset($_GET['idstyle']) ? 'Sửa Style' : 'Tên Style mới'; ?>:
        </label>
        <input type="text" id="style_name" name="style_name"
            value="<?php echo isset($style) ? htmlspecialchars($style['style_name']) : ''; ?>" required>

        <label for="description">Mô tả:</label>
        <textarea id="description" name="description" rows="4"
            required><?php echo isset($style) ? htmlspecialchars($style['description']) : ''; ?></textarea>

        <button type="submit" name="save_style">
            <?php echo isset($_GET['idstyle']) ? 'Cập nhật' : 'Thêm'; ?>
        </button>
    </form>

    <table>
        <tr>
            <th>Id</th>
            <th>Tên Style</th>
            <th>Mô tả</th>
            <th>Quản lý</th>
        </tr>
        <?php
        // Hiển thị danh sách style
        if ($query_lietke_style->num_rows > 0) {
            while ($row = $query_lietke_style->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['style_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['style_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td>
                        <a href="styleM.php?idstyle=<?php echo urlencode($row['style_id']); ?>" class="action-link">Sửa</a> |
                        <a href="styleM.php?deletestyle=<?php echo urlencode($row['style_id']); ?>"
                            class="action-link delete-button"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa style này?')">Xóa</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='4' style='text-align:center;'>Không có style nào trong CSDL.</td></tr>";
        }
        ?>
    </table>

</body>

</html>