
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
        /* Cập nhật nền header với slideshow hình nền */
        header {
            background-size: cover;
            background-position: center;
            color: white;
            padding: 1rem 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            height: 300px; /* Bạn có thể điều chỉnh chiều cao của header nếu cần */
            position: relative;
            animation: changeBackground 15s infinite; /* Chuyển đổi hình ảnh mỗi 15 giây */
        }

        @keyframes changeBackground {
            0% {
                background-image: url('../assets/images/chicago.jpg');
            }
            33% {
                background-image: url('../assets/images/pexels-fotoaibe-1571457.jpg');
            }
            66% {
                background-image: url('../assets/images/pexels-pixabay-276724.jpg');
            }
            100% {
                background-image: url('../assets/images/pexels-thomas-balabaud-735585-1579739.jpg');
            }
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
            transition: background-color 0.3s, transform 0.3s;
        }
        nav ul li a:hover {
            background-color: #555;
            border-radius: 5px;
            transform: scale(1.1); /* Phóng to liên kết khi hover */
        }
        main {
            padding: 2rem 0;
        }
    </style>
</head>
<body>  
    <header>
        <div class="container">
            <h1>Trang Quản Trị!</h1>
        </div>
    </header>
    
    
    <nav>
        <div class="container">
            <ul>
                <li><a href="manage_users.php" class="admin-link">Quản Lý Người Dùng</a></li>
                <li><a href="product.php" class="admin-link">Quản Lý Sản Phẩm</a></li>
                <li><a href="ideallibrary.php" class="admin-link">Quản Lý Thư Viện Ý Tưởng  </a></li>
                <li><a href="../admin/attributes/index_attributes.php" class="admin-link">Quản Lý Phan Loai</a></li>
                <li><a href="../profile/profile.php" class="admin-link">Quản Lý profile</a></li>
                <li><a href="../login/login.php" class="admin-link">Đăng xuất</a></li>
</ul>
        </div>
    </nav>

</body>
</html>