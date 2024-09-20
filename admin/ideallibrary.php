<?php
session_start(); // Start session to use notifications

// Connect to the database
include '../config/db.php';
include("header.php");

// Define the directory to store images
$upload_dir = '../ideallibrary/image/'; // Adjusted relative path
$image_url_path = '../ideallibrary/image/'; // Adjusted path for <img> tags

// Fetch related data
$sql_categories = "SELECT * FROM category ORDER BY name ASC";
$query_categories = mysqli_query($conn, $sql_categories);

$sql_styles = "SELECT * FROM style ORDER BY style_name ASC";
$query_styles = mysqli_query($conn, $sql_styles);

$sql_coordinations = "SELECT * FROM color_coordination ORDER BY coordination_name ASC";
$query_coordinations = mysqli_query($conn, $sql_coordinations);

$sql_users = "SELECT * FROM user ORDER BY user_name ASC";
$query_users = mysqli_query($conn, $sql_users);

// Check if there is an id in the URL for editing an idea
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // Retrieve the idea data to edit
    $sql_get = "SELECT * FROM ideallibrary WHERE idea_id = ?";
    $stmt_get = $conn->prepare($sql_get);
    if ($stmt_get) {
        $stmt_get->bind_param("i", $id);
        $stmt_get->execute();
        $result = $stmt_get->get_result();
        if ($result && $result->num_rows > 0) {
            $idea = $result->fetch_assoc();
        } else {
            $_SESSION['error'] = "Ý tưởng không tồn tại.";
            header("Location: ideallibrary.php");
            exit();
        }
        $stmt_get->close();
    } else {
        $_SESSION['error'] = "Lỗi khi chuẩn bị câu lệnh chọn: " . $conn->error;
        header("Location: ideallibrary.php");
        exit();
    }
}

// Handle adding or editing an idea
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_idea'])) {
    // Securely retrieve and validate form data
    $coordination_id = intval($_POST['coordination_id']);
    $category_id = intval($_POST['category_id']);
    $style_id = intval($_POST['style_id']);
    $user_id = intval($_POST['user_id']);
    $description = mysqli_real_escape_string($conn, trim($_POST['description']));

    // Validate required fields
    if ($coordination_id <= 0 || $category_id <= 0 || $style_id <= 0 || $user_id <= 0 || empty($description)) {
        $_SESSION['error'] = "Vui lòng điền đầy đủ các trường bắt buộc.";
        header("Location: ideallibrary.php" . (isset($id) ? "?id=$id" : ""));
        exit();
    }

    // Handle Image Upload
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $image = basename($_FILES['image']['name']);
        $image_tmp = $_FILES['image']['tmp_name'];

        // Ensure upload directory exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Check if file already exists and rename if necessary
        if (file_exists($upload_dir . $image)) {
            $image = time() . '_' . $image;
        }

        $image_save_path = $upload_dir . $image;

        // Move uploaded file
        if (move_uploaded_file($image_tmp, $image_save_path)) {
            $image_url = $image;

            // If editing and there is an old image, delete it
            if (isset($idea) && !empty($idea['image_url'])) {
                $old_image = $upload_dir . $idea['image_url'];
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
            }
        } else {
            $_SESSION['error'] = "Không thể tải lên hình ảnh.";
            header("Location: ideallibrary.php" . (isset($id) ? "?id=$id" : ""));
            exit();
        }
    } else {
        // If no new image, keep the old one if editing
        if (isset($idea)) {
            $image_url = $idea['image_url'];
        } else {
            $image_url = NULL;
        }
    }

    if (isset($idea)) {
        // **Update Idea using Prepared Statement**
        $sql_update = "UPDATE ideallibrary SET 
                        coordination_id = ?,
                        category_id = ?,
                        style_id = ?,
                        user_id = ?,
                        image_url = ?,
                        description = ?
                       WHERE idea_id = ?";
        $stmt_update = $conn->prepare($sql_update);
        if ($stmt_update) {
            $stmt_update->bind_param("iiiissi", 
                $coordination_id, 
                $category_id, 
                $style_id, 
                $user_id, 
                $image_url, 
                $description, 
                $id
            );

            if ($stmt_update->execute()) {
                $_SESSION['success'] = "Cập nhật ý tưởng thành công!";
            } else {
                $_SESSION['error'] = "Lỗi: " . $stmt_update->error;
            }

            $stmt_update->close();
        } else {
            $_SESSION['error'] = "Lỗi khi chuẩn bị câu lệnh cập nhật: " . $conn->error;
        }
    } else {
        // **Insert New Idea using Prepared Statement**
        $sql_insert = "INSERT INTO ideallibrary (coordination_id, category_id, style_id, user_id, image_url, description) 
                       VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        if ($stmt_insert) {
            $stmt_insert->bind_param("iiiiss", 
                $coordination_id, 
                $category_id, 
                $style_id, 
                $user_id, 
                $image_url, 
                $description
            );

            if ($stmt_insert->execute()) {
                $_SESSION['success'] = "Thêm ý tưởng thành công!";
            } else {
                $_SESSION['error'] = "Lỗi: " . $stmt_insert->error;
            }

            $stmt_insert->close();
        } else {
            $_SESSION['error'] = "Lỗi khi chuẩn bị câu lệnh thêm: " . $conn->error;
        }
    }

    // Redirect after operation
    header("Location: ideallibrary.php");
    exit();
}

// Handle idea deletion
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);

    // Fetch the idea to get the image URL
    $sql_select = "SELECT image_url FROM ideallibrary WHERE idea_id = ?";
    $stmt_select = $conn->prepare($sql_select);
    if ($stmt_select) {
        $stmt_select->bind_param("i", $delete_id);
        $stmt_select->execute();
        $result_select = $stmt_select->get_result();
        if ($result_select && $result_select->num_rows > 0) {
            $row = $result_select->fetch_assoc();
            $image_to_delete = $row['image_url'];
            if ($image_to_delete && file_exists($upload_dir . $image_to_delete)) {
                unlink($upload_dir . $image_to_delete);
            }
        }
        $stmt_select->close();
    } else {
        $_SESSION['error'] = "Lỗi khi chuẩn bị câu lệnh chọn: " . $conn->error;
        header("Location: ideallibrary.php");
        exit();
    }

    // Delete the idea using prepared statement
    $sql_delete = "DELETE FROM ideallibrary WHERE idea_id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    if ($stmt_delete) {
        $stmt_delete->bind_param("i", $delete_id);
        if ($stmt_delete->execute()) {
            $_SESSION['success'] = "Xóa ý tưởng thành công!";
        } else {
            $_SESSION['error'] = "Lỗi: " . $stmt_delete->error;
        }
        $stmt_delete->close();
    } else {
        $_SESSION['error'] = "Lỗi khi chuẩn bị câu lệnh xóa: " . $conn->error;
    }

    header("Location: ideallibrary.php");
    exit();
}

// Fetch ideas with related data and apply filters
$sql_list = "SELECT il.*, 
                    c.name AS category_name, 
                    s.style_name AS style_name, 
                    cc.coordination_name AS coordination_name,
                    u.user_name AS user_name
             FROM ideallibrary il
             LEFT JOIN category c ON il.category_id = c.category_id
             LEFT JOIN style s ON il.style_id = s.style_id
             LEFT JOIN color_coordination cc ON il.coordination_id = cc.coordination_id
             LEFT JOIN user u ON il.user_id = u.user_id
             WHERE 1";

$filters = [];

// Apply filters if they are set
if (isset($_GET['filter_coordination_id']) && $_GET['filter_coordination_id'] != '') {
    $coordination_id_filter = intval($_GET['filter_coordination_id']);
    $sql_list .= " AND il.coordination_id = $coordination_id_filter";
}

if (isset($_GET['filter_category_id']) && $_GET['filter_category_id'] != '') {
    $category_id_filter = intval($_GET['filter_category_id']);
    $sql_list .= " AND il.category_id = $category_id_filter";
}

if (isset($_GET['filter_style_id']) && $_GET['filter_style_id'] != '') {
    $style_id_filter = intval($_GET['filter_style_id']);
    $sql_list .= " AND il.style_id = $style_id_filter";
}

if (isset($_GET['filter_user_id']) && $_GET['filter_user_id'] != '') {
    $user_id_filter = intval($_GET['filter_user_id']);
    $sql_list .= " AND il.user_id = $user_id_filter";
}

// Sort by the most recent idea
$sql_list .= " ORDER BY il.idea_id DESC";

$result_list = mysqli_query($conn, $sql_list) or die("Lỗi khi thực thi truy vấn: " . mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Thư viện Ý tưởng</title>
    <link rel="stylesheet" href="../assets/css/ideallibrary.css">
    <!-- <style>
        /* Add any additional inline styles here if necessary */
        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .actions a {
            margin-right: 10px;
            text-decoration: none;
            color: #007BFF;
        }

        .actions a:hover {
            text-decoration: underline;
        }

        form {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-top: 10px;
        }

        form input[type="text"],
        form input[type="number"],
        form select,
        form textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        form button {
            margin-top: 15px;
            padding: 10px 20px;
        }

        img {
            max-width: 100px;
            height: auto;
        }
    </style> -->
</head>

<body>

    <h2>Quản lý Thư viện Ý tưởng</h2>

    <?php
    // Display success or error messages
    if (isset($_SESSION['success'])) {
        echo "<div class='message success'>{$_SESSION['success']}</div>";
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo "<div class='message error'>{$_SESSION['error']}</div>";
        unset($_SESSION['error']);
    }
    ?>

    <!-- Filter Form -->
    <form method="GET" action="">
        <h4>Lọc Ý tưởng</h4>

        <label for="filter_coordination_id">Màu phối hợp:</label>
        <select id="filter_coordination_id" name="filter_coordination_id">
            <option value="">-- Tất cả Màu phối hợp --</option>
            <?php
            if (mysqli_num_rows($query_coordinations) > 0) {
                while ($row = mysqli_fetch_assoc($query_coordinations)) {
                    $selected = (isset($_GET['filter_coordination_id']) && $_GET['filter_coordination_id'] == $row['coordination_id']) ? 'selected' : '';
                    echo "<option value='{$row['coordination_id']}' $selected>" . htmlspecialchars($row['coordination_name']) . "</option>";
                }
            }
            ?>
        </select>

        <label for="filter_category_id">Danh mục:</label>
        <select id="filter_category_id" name="filter_category_id">
            <option value="">-- Tất cả Danh mục --</option>
            <?php
            if (mysqli_num_rows($query_categories) > 0) {
                while ($row = mysqli_fetch_assoc($query_categories)) {
                    $selected = (isset($_GET['filter_category_id']) && $_GET['filter_category_id'] == $row['category_id']) ? 'selected' : '';
                    echo "<option value='{$row['category_id']}' $selected>" . htmlspecialchars($row['name']) . "</option>";
                }
            }
            ?>
        </select>

        <label for="filter_style_id">Phong cách:</label>
        <select id="filter_style_id" name="filter_style_id">
            <option value="">-- Tất cả Phong cách --</option>
            <?php
            if (mysqli_num_rows($query_styles) > 0) {
                while ($row = mysqli_fetch_assoc($query_styles)) {
                    $selected = (isset($_GET['filter_style_id']) && $_GET['filter_style_id'] == $row['style_id']) ? 'selected' : '';
                    echo "<option value='{$row['style_id']}' $selected>" . htmlspecialchars($row['style_name']) . "</option>";
                }
            }
            ?>
        </select>

        <label for="filter_user_id">Người dùng:</label>
        <select id="filter_user_id" name="filter_user_id">
            <option value="">-- Tất cả Người dùng --</option>
            <?php
            if (mysqli_num_rows($query_users) > 0) {
                while ($row = mysqli_fetch_assoc($query_users)) {
                    $selected = (isset($_GET['filter_user_id']) && $_GET['filter_user_id'] == $row['user_id']) ? 'selected' : '';
                    echo "<option value='{$row['user_id']}' $selected>" . htmlspecialchars($row['user_name']) . "</option>";
                }
            }
            ?>
        </select>

        <button type="submit">Lọc</button>
        <a href="ideallibrary.php" style="margin-left: 10px;">Reset</a>
    </form>

    <!-- Form to Add or Edit Idea -->
    <form method="POST" action="" enctype="multipart/form-data">
        <h3><?php echo isset($idea) ? 'Sửa Ý tưởng' : 'Thêm Ý tưởng Mới'; ?></h3>

        <label for="coordination_id">Màu phối hợp:</label>
        <select id="coordination_id" name="coordination_id" required>
            <option value="">-- Chọn Màu phối hợp --</option>
            <?php
            // Reset pointer and fetch data again
            mysqli_data_seek($query_coordinations, 0);
            if (mysqli_num_rows($query_coordinations) > 0) {
                while ($row = mysqli_fetch_assoc($query_coordinations)) {
                    $selected = (isset($idea) && $idea['coordination_id'] == $row['coordination_id']) ? 'selected' : '';
                    echo "<option value='{$row['coordination_id']}' $selected>" . htmlspecialchars($row['coordination_name']) . "</option>";
                }
            }
            ?>
        </select>

        <label for="category_id">Danh mục:</label>
        <select id="category_id" name="category_id" required>
            <option value="">-- Chọn Danh mục --</option>
            <?php
            mysqli_data_seek($query_categories, 0);
            if (mysqli_num_rows($query_categories) > 0) {
                while ($row = mysqli_fetch_assoc($query_categories)) {
                    $selected = (isset($idea) && $idea['category_id'] == $row['category_id']) ? 'selected' : '';
                    echo "<option value='{$row['category_id']}' $selected>" . htmlspecialchars($row['name']) . "</option>";
                }
            }
            ?>
        </select>

        <label for="style_id">Phong cách:</label>
        <select id="style_id" name="style_id" required>
            <option value="">-- Chọn Phong cách --</option>
            <?php
            mysqli_data_seek($query_styles, 0);
            if (mysqli_num_rows($query_styles) > 0) {
                while ($row = mysqli_fetch_assoc($query_styles)) {
                    $selected = (isset($idea) && $idea['style_id'] == $row['style_id']) ? 'selected' : '';
                    echo "<option value='{$row['style_id']}' $selected>" . htmlspecialchars($row['style_name']) . "</option>";
                }
            }
            ?>
        </select>

        <label for="user_id">Người dùng:</label>
        <select id="user_id" name="user_id" required>
            <option value="">-- Chọn Người dùng --</option>
            <?php
            mysqli_data_seek($query_users, 0);
            if (mysqli_num_rows($query_users) > 0) {
                while ($row = mysqli_fetch_assoc($query_users)) {
                    $selected = (isset($idea) && $idea['user_id'] == $row['user_id']) ? 'selected' : '';
                    echo "<option value='{$row['user_id']}' $selected>" . htmlspecialchars($row['user_name']) . "</option>";
                }
            }
            ?>
        </select>

        <label for="image">Hình ảnh:</label>
        <input type="file" id="image" name="image" <?php echo isset($idea) ? '' : 'required'; ?>>
        <?php
        if (isset($idea) && $idea['image_url']) {
            echo "<img src='{$image_url_path}{$idea['image_url']}' alt='Hình ảnh Ý tưởng'>";
        }
        ?>

        <label for="description">Mô tả:</label>
        <textarea id="description" name="description" rows="4" required><?php echo isset($idea) ? htmlspecialchars($idea['description']) : ''; ?></textarea>

        <button type="submit" name="save_idea"><?php echo isset($idea) ? 'Cập nhật Ý tưởng' : 'Thêm Ý tưởng'; ?></button>
        <?php if (isset($idea)): ?>
            <a href="ideallibrary.php" style="margin-left: 10px;">Hủy</a>
        <?php endif; ?>
    </form>

    <!-- Table to List All Ideas -->
    <table>
        <tr>
            <th>ID</th>
            <th>Màu phối hợp</th>
            <th>Danh mục</th>
            <th>Phong cách</th>
            <th>Người dùng</th>
            <th>Hình ảnh</th>
            <th>Mô tả</th>
            <th>Quản lý</th>
        </tr>
        <?php
        if (mysqli_num_rows($result_list) > 0) {
            while ($row = mysqli_fetch_assoc($result_list)) {
        ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['idea_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['coordination_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['style_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                    <td>
                        <?php
                        if ($row['image_url']) {
                            echo "<img src='{$image_url_path}{$row['image_url']}' alt='Hình ảnh Ý tưởng'>";
                        } else {
                            echo "Không có hình ảnh";
                        }
                        ?>
                    </td>
                    <td><?php echo nl2br(htmlspecialchars($row['description'])); ?></td>
                    <td class="actions">
                        <a href="ideallibrary.php?id=<?php echo htmlspecialchars($row['idea_id']); ?>">Sửa</a>
                        <a href="ideallibrary.php?delete=<?php echo htmlspecialchars($row['idea_id']); ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa ý tưởng này?')">Xóa</a>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='8'>Không có ý tưởng nào trong CSDL.</td></tr>";
        }
        ?>
    </table>

</body>

</html>
