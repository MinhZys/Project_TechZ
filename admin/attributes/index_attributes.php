<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang Chính</title>
    <style>
        .navigation {
            list-style-type: none;
            padding: 0;
            margin: 0;
            background-color: #333;
            overflow: hidden;
            text-align: center;
            /* Canh giữa các mục trong danh sách */
        }

        .navigation li {
            display: inline-block;
            margin-right: 20px;
        }

        .navigation a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid transparent;
            transition: all 0.3s ease;
            /* Thêm hiệu ứng chuyển động mượt mà */
            position: relative;
        }

        .navigation a:hover {
            border: 1px solid #444;
            background-color: #444;
            color: white;
            box-shadow: 0 0 5px #888;
            transform: translateY(-5px);
            /* Dịch chuyển mục lên trên khi di chuột */
            text-decoration: none;
        }

        .navigation a::before {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 2px;
            background-color: white;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .navigation a:hover::before {
            transform: scaleX(1);
            /* Hiệu ứng dòng gạch dưới khi di chuột */
        }

        .introduction {
            text-align: center;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .introduction h1 {
            font-size: 2.5em;
            color: #333;
        }

        .introduction p {
            font-size: 1.2em;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="introduction">
        <h1>Chào mừng bạn đến với trang quản lý sản phẩm</h1>
        <p>Trang này cho phép bạn quản lý các danh mục, thương hiệu, chất liệu, phong cách và phối màu của sản phẩm.</p>
    </div>
    <!-- Thanh điều hướng với các liên kết đến trang tương ứng -->
    <ul class="navigation">
        <li><a href="../header.php">Trang Quản Trị</a></li>
        <li><a href="categoryM.php">Danh Mục</a></li>
        <li><a href="brandM.php">Thương Hiệu</a></li>
        <li><a href="materialM.php">Chất Liệu</a></li>
        <li><a href="styleM.php">Phong Cách</a></li>
        <li><a href="coordinationM.php">Phối Màu</a></li>
    </ul>

</body>

</html>