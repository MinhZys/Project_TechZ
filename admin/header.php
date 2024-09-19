
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #f4f4f4, #e0e0e0);
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        header {
            background-color: #333;
            color: white;
            padding: 1rem 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        nav {
            background-color: #444;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: space-around;
        }
        nav ul li {
            flex: 1;
            text-align: center;
        }
        nav ul li a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 1rem;
            transition: background-color 0.3s;
        }
        nav ul li a:hover {
            background-color: #555;
            border-radius: 5px; /* Thêm viền bo cho liên kết */
        }
        main {
            padding: 2rem 0;
        }
        .welcome-message {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            transition: transform 0.3s;
        }
        .welcome-message:hover {
            transform: scale(1.02); /* Hiệu ứng phóng to khi hover */
        }
        h2 {
            color: #4CAF50; /* Màu xanh lá cho tiêu đề */
        }
        p {
            color: #555; /* Màu chữ tối cho văn bản */
        }
    </style>
</head>
<body>  
    <header>
        <div class="container">
            <h1>Trang Quản Trị</h1>
        
        </div>
    </header>
    
    <nav>
        <div class="container">
            <ul>
                <li><a href="manage_users.php" class="admin-link">Quản Lý Người Dùng</a></li>
                <li><a href="listP.php" class="admin-link">Quản Lý Sản Phẩm</a></li>
                <li><a href="statisadmin/productM/listP.phptics.php" class="admin-link">Thống Kê</a></li>
                <li><a href="settings.php" class="admin-link">Cài Đặt Hệ Thống</a></li>
                <li><a href="../login/logsin.php" class="admin-link">Đăng xuất</a></li>
            </ul>
        </div>
    </nav>
    
    <main class="container">
        <section class="welcome-message">
            <h2>Chào mừng đến với trang quản trị!</h2>
        </section>
    </main>
</body>
</html>
