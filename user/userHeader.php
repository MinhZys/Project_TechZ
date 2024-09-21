<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD

=======
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar with Dropdowns and Carousel</title>
<<<<<<< HEAD

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Reference to your custom stylesheet -->
  <link rel="stylesheet" href=".css">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

=======
    
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Reference to your custom stylesheet -->
    <link rel="stylesheet" href="../assets/css/userHeadr.css"> <!-- Update the path as needed -->
    
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
    <!-- Optional: Custom Styles (if any) -->
    <style>
        /* Example: Adjust carousel image height */
        .carousel-item img {
<<<<<<< HEAD
            height: 500px;
            /* Adjust as needed */
            object-fit: cover;
        }
            /* Căn giữa phần caption của carousel */
            .carousel-caption {
            text-align: center;
        }
        .navbar-nav{
            padding-left: 38rem;
        }
    </style>
  

</head>

<body>

=======
            height: 500px; /* Adjust as needed */
            object-fit: cover;
        }
    </style>
    <style>
    /* Zoom effect for carousel images */
    .carousel-item img {
        height: 500px; /* Adjust as needed */
        object-fit: cover;
        transition: transform 3s ease; /* Set the zoom transition */
    }

    .carousel-item.active img {
        transform: scale(1.1); /* Scale the image to zoom in */
    }
</style>

</head>
<body>

    <!-- Navbar -->
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../assets/images/DecoZ.png" alt="Logo" height="30"> <!-- Adjust height as needed -->
            </a>
<<<<<<< HEAD
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Dropdown Product -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="../user/userHeader.php" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../user/userHeader.php">Phòng ngủ</a></li>
                            <li><a class="dropdown-item" href="#">Phòng khách</a></li>
                            <li><a class="dropdown-item" href="#">Nhà bếp</a></li>
                            <li><a class="dropdown-item" href="#">Văn phòng</a></li>
                            <li><a class="dropdown-item" href="#">Toilet</a></li>
                        </ul>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">BLOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Advisory</a>
=======
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!-- ms-auto aligns items to the right -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Product
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <li><a class="dropdown-item" href="#">Phòng khách</a></li>
                            <li><a class="dropdown-item" href="#">Phòng ngủ</a></li>
                            <li><a class="dropdown-item" href="#">Nhà bếp</a></li>
                            <li><a class="dropdown-item" href="#">Phòng tắm</a></li>
                            <li><a class="dropdown-item" href="#">Văn phòng</a></li>
                            <li><a class="dropdown-item" href="#">Không gian ngoài trời</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Idea Interface</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Advise</a>
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Thông báo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../profile/profile.php">
<<<<<<< HEAD
                            Profile <span style="color:orange;">🔥</span>
                        </a>
                    </li>
                    <!-- Giỏ hàng -->
                    <li class="nav-item">
                        <a href="cart.php" class="btn btn-primary">Xem Giỏ Hàng</a>
                        <i class="bi bi-cart-fill"></i>
                        <span class="badge bg-danger"></span>
                    </li>
=======
                            profile <span style="color:orange;">🔥</span>
                        </a>
                    </li>
                    <!-- Uncomment the following block if you want to add authentication buttons -->
                    <!--
                    <div class="auth-buttons ms-3">
                        <a href="#" class="btn btn-outline-dark me-2">Sign In</a>
                        <a href="#" class="btn btn-warning">Sign Up</a>
                    </div>
                    -->
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
                </ul>
            </div>
        </div>
    </nav>

<<<<<<< HEAD

=======
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
    <!-- Carousel -->
    <div id="demo" class="carousel slide" data-bs-ride="carousel">

        <!-- Indicators/dots -->
        <div class="carousel-indicators">
<<<<<<< HEAD
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2" aria-label="Slide 3"></button>
=======
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active" 
                    aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1" 
                    aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2" 
                    aria-label="Slide 3"></button>
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
        </div>

        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../assets/images/pexels-pixabay-276583.jpg" alt="Los Angeles" class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Los Angeles</h3>
                    <p>We had such a great time in LA!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../assets/images/pexels-pixabay-275484.jpg" alt="Chicago" class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Chicago</h3>
                    <p>Thank you, Chicago!</p>
<<<<<<< HEAD
                </div>
=======
                </div> 
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
            </div>
            <div class="carousel-item">
                <img src="../assets/images/pexels-pixabay-276724.jpg" alt="New York" class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h3>thiết kế phòng khách</h3>
                    <p>bạn có thích phong cách thiết kế sắp sếp của bênh tôi không.</p>
<<<<<<< HEAD
                </div>
=======
                </div>  
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
            </div>
        </div>

        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span> <!-- For accessibility -->
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span> <!-- For accessibility -->
        </button>
    </div>
    <!-- Bootstrap 5.3.3 JS Bundle (Includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Optional: Custom Scripts (if any) -->
    <script>
        // Example: Initialize the carousel with specific options
        var myCarousel = document.querySelector('#demo')
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 2000, // Slide interval in milliseconds
            wrap: true       // Whether the carousel should cycle continuously or have hard stops
        })
    </script>
</body>
<<<<<<< HEAD

</html>
=======
</html>
>>>>>>> 4b3d920203f035acd5c5be55213b14e62b523292
