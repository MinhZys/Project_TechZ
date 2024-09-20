<?php
session_start();
include "../config/db.php";
$user_id = $_SESSION['user_id'];

// Xử lý khi form được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $avatar = $_FILES['avatar']['name']; // Giả sử người dùng có thể upload avatar mới

    // Xử lý upload ảnh avatar nếu có
    if ($avatar) {
        $target_dir = "../profile/img/";
        $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
        move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
    }

    // Cập nhật thông tin người dùng
    $sql = "UPDATE user SET full_name = ?, email_address = ?, address = ?, avatar = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $fullname, $email, $address, $avatar, $user_id);

    if ($stmt->execute()) {
        echo "Cập nhật thành công!";
    } else {
        echo "Có lỗi xảy ra!";
    }

    $stmt->close();
}

// Lấy thông tin người dùng
$sql = "SELECT * FROM user WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
</head>
<body>
    <!-- Navbar top -->
    <div class="navbar-top">
        <div class="title">
            <h1>DECORZ</h1>
        </div>
        <ul>
            <li>
                <a href="#message">
                    <span class="icon-count">29</span>
                    <i class="fa fa-envelope fa-2x"></i>
                </a>
            </li>
            <li>
                <a href="#notification">
                    <span class="icon-count">59</span>
                    <i class="fa fa-bell fa-2x"></i>
                </a>
            </li>
            <li>
                <a href="#sign-out">
                    <i class="fa fa-sign-out-alt fa-2x"></i>
                </a>
            </li>
        </ul>
    </div>

    <!-- Sidenav -->
    <div class="sidenav">
        <div class="profile">
            <img src="../profile/img/<?php echo $user['avatar']; ?>" alt="avt" width="100" height="100">
            <div class="name"><?php echo $user['full_name']; ?></div>
            <div class="job"><?php echo $user['role']; ?></div>
        </div>

        <div class="sidenav-url">
            <div class="url">
                <a href="#profile" class="active">Profile</a>
                <hr align="center">
            </div>
            <div class="url">
                <a href="#settings">Settings</a>
                <hr align="center">
            </div>
        </div>
    </div>

    <!-- Main -->
    <div class="main">
        <h2>EDIT PROFILE</h2>
        <div class="card">
            <div class="card-body">
                <form action="profileM.php" method="POST" enctype="multipart/form-data">
                    <table>
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>:</td>
                                <td><input type="text" name="fullname" value="<?php echo $user['full_name']; ?>" required></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><input type="email" name="email" value="<?php echo $user['email_address']; ?>" required></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td><input type="text" name="address" value="<?php echo $user['address']; ?>" required></td>
                            </tr>
                            <tr>
                                <td>Avatar</td>
                                <td>:</td>
                                <td><input type="file" name="avatar"></td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <button type="submit">Update Profile</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
