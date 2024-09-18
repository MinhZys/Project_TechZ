
<?php
session_start();

// Kết nối đến database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "decorvista";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Xử lý đăng nhập
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Mã hóa mật khẩu
    
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['user'] = $email;
        header("Location: welcome.php"); // Điều hướng sau khi đăng nhập thành công
    } else {
        echo "Invalid email or password!";
    }
}

// Xử lý đăng ký
if (isset($_POST['register'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Mã hóa mật khẩu
    
    $query = "INSERT INTO users (first_name, last_name, phone, email, password) 
              VALUES ('$first_name', '$last_name', '$phone', '$email', '$password')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: auth.php?message=registered"); // Điều hướng sau khi đăng ký thành công
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Xử lý quên mật khẩu
if (isset($_POST['forgot_password'])) {
    $email = $_POST['email'];
    
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        // Ở đây bạn sẽ xử lý gửi email đặt lại mật khẩu (sử dụng PHPMailer hoặc thư viện tương tự)
        echo "A reset password link has been sent to your email!";
    } else {
        echo "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <link rel="stylesheet" href="../assets/css/index.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,700;1,400&display=swap" />
    <title>Sign In & Sign Up</title>
</head>
<body>
    <div class="group-parent">
        <div class="line-parent">
            <!-- Form Đăng Nhập -->
            <div class="group-child"></div>
            <div class="sign-in">Sign In</div>
            
            <b class="email">Email</b>
            <input type="email" class="group-item" placeholder="Enter your email" required />

            <b class="password">Password</b>
            <input type="password" class="group-inner" placeholder="Enter your password" required />

            <i class="create-an-account1">Create An Account</i>
            <i class="forgot-password">Forgot Password</i>
            
            <div class="rectangle-div"></div>
            <button type="submit" class="sign-in1">SIGN IN</button>
            
            <!-- Đăng nhập với Google -->
            <div class="group-child1"></div>
            <div class="group-child2"></div>
            <button type="button" class="sign-in-with">SIGN IN WITH GOOGLE</button>

            <!-- Form Đăng Ký -->
            <div class="create-an-account">Create An Account</div>
            
            <b class="first-name">First Name</b>
            <input type="text" class="group-child3" placeholder="First Name" required />
            
            <b class="last-name">Last Name</b>
            <input type="text" class="group-child4" placeholder="Last Name" required />
            
            <b class="phone">Phone</b>
            <input type="text" class="group-child5" placeholder="Phone Number" required />
            
            <b class="email1">Email</b>
            <input type="email" class="group-child6" placeholder="Email" required />
            
            <button type="submit" class="create-account">CREATE ACCOUNT</button>
        </div>
    </div>
</body>
</html>
