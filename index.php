<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrintDoors - Trang Chủ</title>
    <link rel="stylesheet" href="./assets/css/index1.css"> <!-- Kết nối CSS -->
    <style>
        /* Thêm một số kiểu dáng cơ bản cho khu vực nội dung */
        .content {
            padding: 20px;
            border: 1px solid #ccc;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="logo">
            <img src="logo.png" alt="PrintDoors">
        </div>
        <nav class="nav-link">
            <ul>
                <li><a href="#" onclick="loadContent('products')">Products</a></li>
                <li><a href="#" onclick="loadContent('integrations')">Integrations</a></li>
                <li><a href="#" onclick="loadContent('services')">Services</a></li>
                <li><a href="#" onclick="loadContent('shipping')">Shipping</a></li>
                <li><a href="#" onclick="loadContent('help')">Help</a></li>
            </ul>
        </nav>
        <div class="auth-buttons">
            <button><a href="./login/Login.php">Sign In</a></button>
            <button><a href="#">Sign Up</a></button>
        </div>
    </header>
<!-- Khu vực hiển thị nội dung -->
    <div class="content" id="content-area">
        <h2>Welcome to PrintDoors</h2>
        <p>Select a menu item to see more information.</p>
    </div>

    <script>
        function loadContent(page) {
            let contentArea = document.getElementById('content-area');

            switch(page) {
                case 'products':
                    fetch('./views/Products.php')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.text();
                        })
                        .then(data => {
                            contentArea.innerHTML = data;
                        })
                        .catch(error => {
                            contentArea.innerHTML = '<h2>Error loading content</h2><p>' + error.message + '</p>';
                        });
                    break;
                case 'integrations':
                    contentArea.innerHTML = '<h2>Integrations</h2><p>Learn about our integrations.</p>';
                    break;
                case 'services':
                    contentArea.innerHTML = '<h2>Services</h2><p>Explore the services we offer.</p>';
                    break;
                case 'shipping':
                    contentArea.innerHTML = '<h2>Shipping</h2><p>Details about our shipping options.</p>';
                    break;
                case 'help':
                    contentArea.innerHTML = '<h2>Help</h2><p>Find answers to your questions.</p>';
                    break;
                default:
                    contentArea.innerHTML = '<h2>Welcome to PrintDoors</h2><p>Select a menu item to see more information.</p>';
            }
        }
    </script>
      <!-- Banner chính -->
      <section class="main-banner">
        <div class="banner-content">
            <h1>Shipped Within 36-72h</h1>
            <p>Stable Timeliness, Fast Delivery, Timeout is Guaranteed</p>
            <div class="platforms">
                <button>Amazon</button>
                <button>Etsy</button>
                <button>Shopify</button>
                <button>Other eCommerce Stores</button>
            </div>
            <button class="cta-button">View Compensation Rules</button>
        </div>
        <div class="banner-image">
            <img src="banner-image.png" alt="Shipping Image">
        </div>
    </section>

</body>
</html>
