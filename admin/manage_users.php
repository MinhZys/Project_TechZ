<?php
session_start();
include("../config/db.php");
include("../admin/header.php");

// Kiểm tra quyền truy cập

// Xử lý xóa người dùng
if (isset($_GET['delete'])) {
    $deleteId = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $deleteId);
    $stmt->execute();
    header('Location: manage_users.php');
    exit;
}

// Xử lý thêm người dùng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $user_name = $_POST['user_name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email_address = $_POST['email_address'];
    $role = $_POST['role'];
    $number_phone = $_POST['number_phone'];

    $stmt = $conn->prepare("INSERT INTO user (user_name, password, email_address, role, number_phone) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $user_name, $password, $email_address, $role, $number_phone);
    $stmt->execute();
    header('Location: manage_users.php');
    exit;
}

// Xử lý chỉnh sửa người dùng
if (isset($_GET['edit'])) {
    $editId = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $editId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

// Cập nhật thông tin người dùng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $email_address = $_POST['email_address'];
    $role = $_POST['role'];
    $number_phone = $_POST['number_phone'];

    $stmt = $conn->prepare("UPDATE user SET user_name = ?, email_address = ?, role = ?, number_phone = ? WHERE user_id = ?");
    $stmt->bind_param("ssssi", $user_name, $email_address, $role, $number_phone, $user_id);
    $stmt->execute();
    header('Location: manage_users.php');
    exit;
}

// Lấy danh sách người dùng
$result = $conn->query("SELECT * FROM user");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Người Dùng</title>
    <link rel="stylesheet" href="../assets/css/manage_users.css">
</head>
<body>
    <div class="container">
        <h2>Quản Lý Người Dùng</h2>
        <h3>Danh Sách Người Dùng</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Đăng Nhập</th>
                    <th>Email</th>
                    <th>Vai Trò</th>
                    <th>Số Điện Thoại</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['email_address']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td><?php echo $row['number_phone']; ?></td>
                    <td>
                        <a href="?edit=<?php echo $row['user_id']; ?>">Chỉnh Sửa</a> | 
                        <a href="?delete=<?php echo $row['user_id']; ?>">Xóa</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3>Thêm Người Dùng</h3>
        <form method="post">
            <label for="user_name">Tên đăng nhập:</label>
            <input type="text" name="user_name" required>
            
            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" required>
            
            <label for="email_address">Email:</label>
            <input type="email" name="email_address" required>
            
            <label for="role">Vai trò:</label>
            <select name="role">
                <option value="admin">Admin</option>
                <option value="user">User</option>
                <option value="designer">Designer</option>
            </select>
            
            <label for="number_phone">Số điện thoại:</label>
            <input type="text" name="number_phone" required>
            
            <button type="submit" name="add_user">Thêm Người Dùng</button>
        </form>

        <?php if (isset($user)): ?>
        <h3>Chỉnh Sửa Người Dùng</h3>
        <form method="post">
            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
            
            <label for="user_name">Tên đăng nhập:</label>
            <input type="text" name="user_name" value="<?php echo $user['user_name']; ?>" required>
            
            <label for="email_address">Email:</label>
            <input type="email" name="email_address" value="<?php echo $user['email_address']; ?>" required>
            
            <label for="role">Vai trò:</label>
            <select name="role">
                <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                <option value="user" <?php echo $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                <option value="designer" <?php echo $user['role'] == 'designer' ? 'selected' : ''; ?>>Designer</option>
            </select>
            
            <label for="number_phone">Số điện thoại:</label>
            <input type="text" name="number_phone" value="<?php echo $user['number_phone']; ?>" required>
            
            <button type="submit" name="update_user">Cập Nhật Người Dùng</button>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>
