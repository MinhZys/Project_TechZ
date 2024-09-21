<?php
// Kết nối đến CSDL
include '../../config/db.php';
include '../productM/addP.php';


// Câu lệnh SQL để lấy dữ liệu từ bảng product, category, brand và material
$sql_lietke_sp = "
        SELECT product.id, product.name AS tensanpham, product.image_url AS hinhanh, 
               product.price AS giasp, material.material_type AS tenvatlieu, 
               product.description AS tomtat, category.name AS tendanhmuc, brand.name AS tenbrand
        FROM product 
        INNER JOIN category ON product.category_id = category.category_id 
        INNER JOIN brand ON product.brand_id = brand.brand_id
        INNER JOIN material ON product.material_id = material.id
        ORDER BY product.id DESC
    ";

// Thực thi truy vấn SQL
$query_lietke_sp = mysqli_query($conn, $sql_lietke_sp);

// Kiểm tra nếu có dữ liệu trả về
if (mysqli_num_rows($query_lietke_sp) > 0) {
    ?>
    <p>Liệt kê danh mục sản phẩm</p>
    <table style="width:100%" border="1" style="border-collapse: collapse;">
        <tr>
            <th>Id</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Giá sp</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Tên vật liệu</th>
            <th>Tóm tắt</th>
            <th>Quản lý</th>
        </tr>
        <?php
        // Vòng lặp để lấy từng hàng dữ liệu
        while ($row = mysqli_fetch_array($query_lietke_sp)) {
            ?>
            <tr>
                <!-- Hiển thị ID từ CSDL -->
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['tensanpham'] ?></td>
                <td><img src="../productM/image/<?php echo $row['hinhanh'] ?>" width="150px"></td>
                <td><?php echo $row['giasp'] ?> USD</td>
                <td><?php echo $row['tendanhmuc'] ?></td>
                <td><?php echo $row['tenbrand'] ?></td>
                <td><?php echo $row['tenvatlieu'] ?></td> <!-- Hiển thị tên vật liệu -->
                <td><?php echo $row['tomtat'] ?></td>
                <td>
                    <a href="../productM/deleteP.php/?id=<?php echo $row['id'] ?>">Xoá</a> |
                    <a href="../productM/editP.php/?id=<?php echo $row['id'] ?>">Sửa</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
} else {
    echo "Không có sản phẩm nào trong CSDL.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/listP.css"> <!-- Cập nhật đường dẫn -->
</head>
<body>


</div>
</body>
</html>
