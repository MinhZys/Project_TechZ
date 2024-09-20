<?php
session_start();
ob_start(); // Bật output buffering

include "../config/db.php";

$user_id = $_SESSION['user_id']; // Lấy user_id từ session

$sql = "SELECT * FROM user WHERE user_id = ?"; // Sử dụng prepared statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id); // Liên kết user_id với prepared statement
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Lấy dữ liệu từ cơ sở dữ liệu
    $row = $result->fetch_assoc();
    $avatar = $row["avatar"];
    $user_name = $row["user_name"];
    $role = $row["role"];
    $address = $row["address"];
    $email_address = $row["email_address"];
    $fullname = $row["full_name"];
} else {
    echo "Không tìm thấy dữ liệu.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="../assets/css/profile.css"> 
    <!-- FontAwesome 5 -->
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
                <a href="../login/Login.php">
                    <i class="fa fa-sign-out-alt fa-2x"></i>
                </a>
            </li>
        </ul>
    </div>

    <!-- Sidenav -->
    <div class="sidenav">
        <div class="profile">
            <!-- Hiển thị avatar -->
            <img src="../profile/img/<?php echo $avatar; ?>" alt="avt" width="100" height="100">
            <div class="name"><?php echo $fullname; ?></div>
            <div class="job"><?php echo $role; ?></div>
        </div>

        <div class="sidenav-url">
            <div class="url">
                <a href="#profile" class="active">Profile</a>
                <hr align="center">
            </div>

            <div class="url">
                <!-- Nút "Quay về" sử dụng đường dẫn dựa trên role -->
                <form method="POST">
                    <button type="submit" name="go_back" class="back-button">
                        <i class="fa fa-arrow-left fa-2x"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main -->
    <div class="main">
        <h2>IDENTITY</h2>
        <div class="card">
            <div class="card-body">
                <a href="profileM.php"><i class="fa fa-pen fa-xs edit"></i></a>
                <table>
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?php echo $fullname; ?></td>
                        </tr>
                        <tr>
                            <td>ID</td>
                            <td>:</td>
                            <td><?php echo $user_id; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $email_address; ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><?php echo $address; ?></td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>:</td>
                            <td><?php echo $role; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <h2>SOCIAL MEDIA</h2>
        <div class="card">
            <div class="card-body">
                <div class="social-media">
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-facebook fa-stack-1x fa-inverse"></i>
                    </span>
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                    </span>
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
                    </span>
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Xử lý khi bấm nút quay về
    if (isset($_POST['go_back'])) {
        // Kiểm tra role và điều hướng về trang tương ứng
        switch ($role) {
            case 'admin':
                header('Location: ../admin/admin_index.php');
                break;
            case 'user':
                header('Location: ../user/user_index.php');
                break;
            case 'designer':
                header('Location: ../designer/designer_index.php');
                break;
            default:
                header('Location: ../login/Login.php'); // Nếu không có role, về trang login
                break;
        }
        exit; // Đảm bảo không tiếp tục thực thi sau khi điều hướng
    }

    ob_end_flush(); // Kết thúc output buffering
    ?>
</body>
</html>
