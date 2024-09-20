<?php
include("header.php");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Chính</title>
    <style>
        /* Một số kiểu CSS đơn giản để trình bày */
        .navigation {
            list-style-type: none;
            padding: 0;
        }

        .navigation li {
            display: inline;
            margin-right: 20px;
        }

        .navigation a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        .navigation a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Thanh điều hướng với các liên kết đến trang tương ứng -->
    <ul class="navigation">
        <li><a href="../admin/attributes/categoryM.php">Danh Mục</a></li>
        <li><a href="../admin/attributes/brandM.php">Thương Hiệu</a></li>
        <li><a href="../admin/attributes/materialM.php">Chất Liệu</a></li>
        <li><a href="../admin/attributes/styleM.php">Phong Cách</a></li>
        <li><a href="../admin/attributes/coordinationM.php">Phối Màu</a></li>
    </ul>

</body>
</html>
