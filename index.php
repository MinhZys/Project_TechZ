<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar with Dropdowns and Carousel</title> <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Reference to your custom stylesheet -->
    <link rel="stylesheet" href="../assets/css/userHeadr.css"> <!-- Update the path as needed -->
    <!-- Optional: Custom Styles (if any) -->
    <style>
        /* Example: Adjust carousel image height */
        .carousel-item img {
            height: 500px;
            /* Adjust as needed */
            object-fit: cover;
        }
    </style>
</head>

<body> <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid"> <a class="navbar-brand" href="#"> <img src="./assets/images/DecoZ.png" alt="Logo"
                    height="30"> <!-- Adjust height as needed --> </a> <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!-- ms-auto aligns items to the right -->
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false"> Product </a>
                        <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <li><a class="dropdown-item" href="./views/livingroom.php">Phòng khách</a></li>
                            <li><a class="dropdown-item" href="#">Phòng ngủ</a></li>
                            <li><a class="dropdown-item" href="#">Nhà bếp</a></li>
                            <li><a class="dropdown-item" href="#">Phòng tắm</a></li>
                            <li><a class="dropdown-item" href="#">Văn phòng</a></li>
                            <li><a class="dropdown-item" href="#">Không gian ngoài trời</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false"> Idea Interface</a>
                        <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <li><a class="dropdown-item" href="#">Item</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="#">Advise</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="#">Thông báo</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="#"> Halloween Party <span
                                style="color:orange;">🔥</span> </a> </li>
                </ul>
                <div class="auth-buttons ms-3"> <a href="#" class="btn btn-outline-dark me-2">Login</a> <a href="#"
                        class="btn btn-warning">Registry</a> </div>
            </div>
        </div>
    </nav> <!-- Carousel -->
    <div id="demo" class="carousel slide" data-bs-ride="carousel"> <!-- Indicators/dots -->
        <div class="carousel-indicators"> <button type="button" data-bs-target="#demo" data-bs-slide-to="0"
                class="active" aria-current="true" aria-label="Slide 1"></button> <button type="button"
                data-bs-target="#demo" data-bs-slide-to="1" aria-label="Slide 2"></button> <button type="button"
                data-bs-target="#demo" data-bs-slide-to="2" aria-label="Slide 3"></button> </div>
        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
            <div class="carousel-item active"> <img src="./assets/images/LA.jpg" alt="Los Angeles"
                    class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Los Angeles</h3>
                    <p>We had such a great time in LA!</p>
                </div>
            </div>
            <div class="carousel-item active"> <img src="./assets/images/chicago.jpg" alt="Chicago"
                    class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Chicago</h3>
                    <p>Thank you, Chicago!</p>
                </div>
            </div>
            <div class="carousel-item"> <img src="./assets/images/pexels-fotoaibe-1571457.jpg" alt="New York"
                    class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h3>New York</h3>
                    <p>We love the Big Apple!</p>
                </div>
            </div>
        </div> <!-- Left and right controls/icons --> <button class="carousel-control-prev" type="button"
            data-bs-target="#demo" data-bs-slide="prev"> <span class="carousel-control-prev-icon"
                aria-hidden="true"></span> <span class="visually-hidden">Previous</span> <!-- For accessibility -->
        </button> <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next"> <span
                class="carousel-control-next-icon" aria-hidden="true"></span> <span class="visually-hidden">Next</span>
            <!-- For accessibility --> </button>
    </div> <!-- Additional Content Below Carousel (Optional) --> <!-- Bootstrap 5.3.3 JS Bundle (Includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Optional: Custom Scripts (if any) -->
    <script> // Example: Initialize the carousel with specific options var myCarousel = document.querySelector('#demo') var carousel = new bootstrap.Carousel(myCarousel, { interval: 2000, // Slide interval in milliseconds wrap: true       // Whether the carousel should cycle continuously or have hard stops }) </script>
    <?php include_once("./admin/put_footer.php"); ?>
</body>

</html>