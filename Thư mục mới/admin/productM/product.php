<?php
session_start(); // Start session to use notifications
// Connect to the database
include '../../config/db.php';

// Define the directory to store images
$upload_dir = '../productM/image/'; // Relative path from admin/productM.php to image/
$image_url_path = '../productM/image/'; // Absolute path to use in <img> tags

// Fetch categories
$sql_categories = "SELECT * FROM category ORDER BY name ASC";
$query_categories = mysqli_query($conn, $sql_categories);

// Fetch brands
$sql_brands = "SELECT * FROM brand ORDER BY name ASC";
$query_brands = mysqli_query($conn, $sql_brands);

// Fetch materials
$sql_materials = "SELECT * FROM material ORDER BY material_type ASC";
$query_materials = mysqli_query($conn, $sql_materials);

// **New Queries to Fetch Styles and Color Coordinations**
$sql_styles = "SELECT * FROM style ORDER BY style_name ASC";
$query_styles = mysqli_query($conn, $sql_styles);

$sql_coordinations = "SELECT * FROM color_coordination ORDER BY coordination_name ASC";
$query_coordinations = mysqli_query($conn, $sql_coordinations);

// Check if there is an id in the URL for editing a product
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // Retrieve the product data to edit
    $sql_get = "SELECT * FROM product WHERE id = $id";
    $result = mysqli_query($conn, $sql_get);
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        $_SESSION['error'] = "Sản phẩm không tồn tại.";
        header("Location: product.php"); // **Corrected Redirect URL**
        exit();
    }
}

// Handle adding or editing a product if requested
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_product'])) {
    // Securely retrieve data from the form
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $price = floatval($_POST['price']);

    // Ensure the price is a non-negative number
    if (!is_numeric($price) || $price < 0) {
        $_SESSION['error'] = "Giá phải là số và không thể là số âm.";
        header("Location: product.php");
        exit();
    }

    $category_id = intval($_POST['category_id']);
    $brand_id = intval($_POST['brand_id']);
    $material_id = intval($_POST['material_id']);

    // **Retrieve and Sanitize New Fields**
    $style_id = intval($_POST['style_id']);
    $coordination_id = intval($_POST['coordination_id']);

    $description = mysqli_real_escape_string($conn, trim($_POST['description']));

    // Handle image upload if present
    if (isset($_FILES['hinhanh']['name']) && $_FILES['hinhanh']['name'] != '') {
        $hinhanh = basename($_FILES['hinhanh']['name']); // Use basename to prevent directory traversal
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $hinhanh_save_path = $upload_dir . $hinhanh;

        // Move uploaded file
        if (move_uploaded_file($hinhanh_tmp, $hinhanh_save_path)) {
            $image_url = $hinhanh;

            // If editing and there is an old image, delete it
            if (isset($_GET['id']) && !empty($product['image_url'])) {
                $old_image = $upload_dir . $product['image_url'];
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
            }
        } else {
            $_SESSION['error'] = "Không thể tải lên hình ảnh.";
            header("Location: product.php");
            exit();
        }
    } else {
        // If no new image, keep the old one if editing
        if (isset($_GET['id'])) {
            $image_url = $product['image_url'];
        } else {
            $image_url = NULL;
        }
    }

    if (isset($_GET['id'])) {
        // **Update Product**
        $sql_update = "UPDATE product SET 
                        name = '$name',
                        price = $price,
                        category_id = $category_id,
                        brand_id = $brand_id,
                        material_id = $material_id,
                        image_url = " . ($image_url ? "'$image_url'" : "NULL") . ",
                        description = '$description',
                        style_id = $style_id,
                        coordination_id = $coordination_id
                       WHERE id = $id";
        if (mysqli_query($conn, $sql_update)) {
            $_SESSION['success'] = "Cập nhật sản phẩm thành công!";
        } else {
            $_SESSION['error'] = "Lỗi: " . mysqli_error($conn);
        }
    } else {
        // **Insert New Product**
        $sql_add = "INSERT INTO product (name, price, category_id, brand_id, material_id, image_url, description, style_id, coordination_id) 
                    VALUES ('$name', $price, $category_id, $brand_id, $material_id, " . ($image_url ? "'$image_url'" : "NULL") . ", '$description', $style_id, $coordination_id)";
        if (mysqli_query($conn, $sql_add)) {
            $_SESSION['success'] = "Thêm sản phẩm thành công!";
        } else {
            $_SESSION['error'] = "Lỗi: " . mysqli_error($conn);
        }
    }
    // After adding or updating, redirect to the management page
    header("Location: product.php");
    exit();
}

// Handle product deletion if requested
if (isset($_GET['deletep'])) {
    $id_to_delete = intval($_GET['deletep']);
    // Retrieve the product to delete its image
    $sql_select = "SELECT image_url FROM product WHERE id = $id_to_delete";
    $result_select = mysqli_query($conn, $sql_select);
    if ($result_select && mysqli_num_rows($result_select) > 0) {
        $row_select = mysqli_fetch_assoc($result_select);
        $image_to_delete = $row_select['image_url'];
        if ($image_to_delete && file_exists($upload_dir . $image_to_delete)) {
            unlink($upload_dir . $image_to_delete);
        }
    }

    // Delete the product
    $sql_delete = "DELETE FROM product WHERE id = $id_to_delete";
    if (mysqli_query($conn, $sql_delete)) {
        $_SESSION['success'] = "Xóa sản phẩm thành công!";
    } else {
        $_SESSION['error'] = "Lỗi: " . mysqli_error($conn);
    }
    header("Location: product.php");
    exit();
}

// Fetch products with related data
$sql_lietke_p = "SELECT p.*, c.name AS category_name, b.name AS brand_name, m.material_type, s.style_name, cc.coordination_name 
                 FROM product p
                 LEFT JOIN category c ON p.category_id = c.category_id
                 LEFT JOIN brand b ON p.brand_id = b.brand_id
                 LEFT JOIN material m ON p.material_id = m.id
                 LEFT JOIN style s ON p.style_id = s.style_id
                 LEFT JOIN color_coordination cc ON p.coordination_id = cc.coordination_id
                 ORDER BY p.id DESC";
$query_lietke_p = mysqli_query($conn, $sql_lietke_p);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="../../assets/css/product.css">
</head>

<body>

    <h2>Quản lý sản phẩm</h2>

    <?php
    // Display notifications
    if (isset($_SESSION['success'])) {
        echo "<div class='message success'>{$_SESSION['success']}</div>";
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo "<div class='message error'>{$_SESSION['error']}</div>";
        unset($_SESSION['error']);
    }
    ?>

    <!-- Form to add or edit a product -->
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="name"><?php echo isset($_GET['id']) ? 'Sửa sản phẩm' : 'Tên sản phẩm mới'; ?>:</label>
        <input type="text" id="name" name="name"
            value="<?php echo isset($product) ? htmlspecialchars($product['name']) : ''; ?>" required>

        <label for="price">Giá (USD):</label>
        <div style="position: relative;">
            <span style="position: absolute; top: 50%; transform: translateY(-50%); left: 10px;">USD</span>
            <input type="number" step="any" id="price" name="price"
                value="<?php echo isset($product) ? htmlspecialchars($product['price']) : ''; ?>" required min="0"
                style="padding-left: 45px;">
        </div>

        <label for="category_id">Danh mục:</label>
        <select id="category_id" name="category_id" required>
            <option value="">-- Chọn danh mục --</option>
            <?php
            if (mysqli_num_rows($query_categories) > 0) {
                while ($row = mysqli_fetch_assoc($query_categories)) {
                    $selected = (isset($product) && $product['category_id'] == $row['category_id']) ? 'selected' : '';
                    echo "<option value='{$row['category_id']}' $selected>" . htmlspecialchars($row['name']) . "</option>";
                }
            }
            ?>
        </select>

        <label for="brand_id">Thương hiệu:</label>
        <select id="brand_id" name="brand_id" required>
            <option value="">-- Chọn thương hiệu --</option>
            <?php
            if (mysqli_num_rows($query_brands) > 0) {
                while ($row = mysqli_fetch_assoc($query_brands)) {
                    $selected = (isset($product) && $product['brand_id'] == $row['brand_id']) ? 'selected' : '';
                    echo "<option value='{$row['brand_id']}' $selected>" . htmlspecialchars($row['name']) . "</option>";
                }
            }
            ?>
        </select>

        <label for="material_id">Loại vật liệu:</label>
        <select id="material_id" name="material_id" required>
            <option value="">-- Chọn loại vật liệu --</option>
            <?php
            if (mysqli_num_rows($query_materials) > 0) {
                while ($row = mysqli_fetch_assoc($query_materials)) {
                    $selected = (isset($product) && $product['material_id'] == $row['id']) ? 'selected' : '';
                    echo "<option value='{$row['id']}' $selected>" . htmlspecialchars($row['material_type']) . "</option>";
                }
            }
            ?>
        </select>

        <!-- **Added Style Dropdown** -->
        <label for="style_id">Phong cách:</label>
        <select id="style_id" name="style_id" required>
            <option value="">-- Chọn phong cách --</option>
            <?php
            if (mysqli_num_rows($query_styles) > 0) {
                while ($row = mysqli_fetch_assoc($query_styles)) {
                    $selected = (isset($product) && $product['style_id'] == $row['style_id']) ? 'selected' : '';
                    echo "<option value='{$row['style_id']}' $selected>" . htmlspecialchars($row['style_name']) . "</option>";
                }
            }
            ?>
        </select>

        <!-- **Added Coordination Dropdown** -->
        <label for="coordination_id">Phối màu:</label>
        <select id="coordination_id" name="coordination_id" required>
            <option value="">-- Chọn phối màu --</option>
            <?php
            if (mysqli_num_rows($query_coordinations) > 0) {
                while ($row = mysqli_fetch_assoc($query_coordinations)) {
                    $selected = (isset($product) && $product['coordination_id'] == $row['coordination_id']) ? 'selected' : '';
                    echo "<option value='{$row['coordination_id']}' $selected>" . htmlspecialchars($row['coordination_name']) . "</option>";
                }
            }
            ?>
        </select>

        <label for="hinhanh">Hình ảnh:</label>
        <input type="file" id="hinhanh" name="hinhanh" <?php echo isset($_GET['id']) ? '' : 'required'; ?>>
        <?php
        if (isset($product) && $product['image_url']) {
            echo "<img src='{$image_url_path}{$product['image_url']}' alt='Hình ảnh sản phẩm'>";
        }
        ?>

        <label for="description">Mô tả:</label>
        <textarea id="description" name="description" rows="4" required><?php echo isset($product) ? htmlspecialchars($product['description']) : ''; ?></textarea>

        <button type="submit" name="save_product"><?php echo isset($_GET['id']) ? 'Cập nhật' : 'Thêm'; ?></button>
    </form>

    <table>
        <tr>
            <th>Id</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Loại vật liệu</th>
            <th>Phong cách</th> <!-- New Column -->
            <th>Phối màu</th> <!-- New Column -->
            <th>Hình ảnh</th>
            <th>Mô tả</th>
            <th>Quản lý</th>
        </tr>
        <?php
        // Display the list of products
        if (mysqli_num_rows($query_lietke_p) > 0) {
            while ($row = mysqli_fetch_assoc($query_lietke_p)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo number_format($row['price'], 2); ?> USD</td>
                    <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['brand_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['material_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['style_name']); ?></td> <!-- New Column -->
                    <td><?php echo htmlspecialchars($row['coordination_name']); ?></td> <!-- New Column -->
                    <td>
                        <?php
                        if ($row['image_url']) {
                            echo "<img src='{$image_url_path}{$row['image_url']}' alt='Hình ảnh sản phẩm'>";
                        } else {
                            echo "Không có hình ảnh";
                        }
                        ?>
                    </td>
                    <td><?php echo nl2br(htmlspecialchars($row['description'])); ?></td>
                    <td>
                        <a href="product.php?id=<?php echo $row['id']; ?>">Sửa</a> |
                        <a href="product.php?deletep=<?php echo $row['id']; ?>"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='11'>Không có sản phẩm nào trong CSDL.</td></tr>";
        }
        ?>
    </table>

</body>

</html>
