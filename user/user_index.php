<?php 
include("./userHeader.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How It Works: Our Easy Process</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
        }

        .container {
            text-align: center;
            padding: 50px;
        }

        .container h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .container p {
            font-size: 16px;
            color: #777;
            margin-bottom: 40px;
        }

        .video-container {
            position: relative;
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        .video-container video {
            width: 100%;
            height: auto;
        }

        .text-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 24px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Life your style </h1>
        <p>Come to us, we will make it easier.</p>

        <div class="video-container">
            <video autoplay loop muted>
                <source src="../assets/images/9583751-uhd_3840_2160_25fps.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="text-overlay"></div>
        </div>
    </div>
</body>
</html>
<?php

?>