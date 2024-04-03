<?php session_start();
include('dbcon.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>PSO Inventory | Home</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="css/matrix-style.css" />
    <link rel="stylesheet" href="css/matrix-login.css" />
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

</head>

<style>
    body {
        background-image: url('../img/bsu_img.jpg');
        background-size: contain;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        overflow: hidden;
    }

    .btn-login {
        border-radius: 5px;
        padding: 10px 133px;
        font-size: 15px;
    }

    .login-container {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 440px;
        width: 80%;
        padding: 20px;
        z-index: 9999;
    }

    .login-page {
        font-family: 'Times New Roman', Times, serif;
        background-color: rgba(255, 255, 255, .9);
        border-radius: 5px;
        padding: 20px;
        transition: transform 0.5s;
    }

    @media (max-width: 768px) {
        body {
            background-size: cover;
        }
    }

    .login-heading {
        display: inline-block;
        text-decoration: none;
        color: inherit;
    }

    .login-heading img {
        height: 100px;
        width: 110px;
        vertical-align: middle;
        margin-top: 12px;
        animation: spin 4s linear infinite;
    }

    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        z-index: 99999;
        display: none;
    }

    .login-heading img {
        height: 100px;
        width: 110px;
        vertical-align: middle;
        margin-top: 12px;
        animation: spinLogo 6s linear infinite;
    }

    @keyframes spinLogo {
        0% {
            transform: rotateY(0deg);
        }

        100% {
            transform: rotateY(360deg);
        }
    }

    .loading-spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 8px solid rgba(255, 255, 255, 0.3);
        border-top: 8px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spinSpinner 3s linear infinite;
    }

    @keyframes spinSpinner {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<body>

    <div class="login-container">
        <div class="login-page">
            <div class="text-center">
                <div class="login-heading">
                    <a href="home.php" id="loginLink">
                        <img src="../img/bsu_logo.png" alt="BatStateU-TNEU Logo" style="height: 100px; width: 110px; vertical-align: middle; margin-top: 12px;">
                    </a>
                    <br>
                    <span style="display: inline-block; margin-left: 10px;">
                        <h1>Product and Supply Office</h1>
                        <h2 style="color: #E71B03;">Inventory System</h2>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <script>
        document.getElementById('loginLink').addEventListener('click', function(event) {
            document.getElementById('loadingOverlay').style.display = 'block';
        });
    </script>

</body>

</html>