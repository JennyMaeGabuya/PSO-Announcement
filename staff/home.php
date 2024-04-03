<?php
include('dbcon.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>PSO Inventory | Staff Login</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="css/matrix-style.css" />
    <link rel="stylesheet" href="css/matrix-login.css" />
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    <style>
        body {
            background-image: url('../img/bsu_img.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            overflow: hidden;
        }

        .btn-login {
            border-radius: 5px;
            padding: 10px 30px;
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

        .control-group {
            text-align: center;
        }

        .login-page {
            font-family: 'Times New Roman', Times, serif;
            background-color: rgba(255, 255, 255, .9);
            border-radius: 7px;
            padding: 20px;
            transition: transform 0.5s;
        }

        @media (max-width: 768px) {
            body {
                background-size: cover;
            }
        }

        .control-group {
            text-align: center;
            margin-bottom: 10px;
            /* Add margin bottom to control groups */
        }

        /* Style for the main input box */
        .main_input_box {
            position: relative;
            margin-bottom: 20px;
        }

        .main_input_box input {
            padding: 20px;
            font-size: 13px;
            width: 95%;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .main_input_box label {
            position: absolute;
            left: 20px;
            top: 44%;
            transform: translateY(-50%);
            color: #aaa;
            pointer-events: none;
            z-index: 1;
            transition: all 0.3s ease;
        }

        .input-filled label {
            top: 5px;
            font-size: 14px;
            color: black;
            left: 10px;
            transform: translateY(-140%);
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-page">
            <div class="text-center">
                <b>
                    <h1 style="margin-bottom: 10px;">Login</h1>
                </b>
                <h3 style="margin-bottom: 15px; color: #E71B03;">Product and Supply Office</h3>
            </div>

            <?php
            if (isset($_POST['login'])) {
                $username = mysqli_real_escape_string($con, $_POST['username']);
                $password = mysqli_real_escape_string($con, $_POST['password']);

                $password = md5($password);

                $query     = mysqli_query($con, "SELECT * FROM staffs WHERE password='$password' and username='$username'");
                $row       = mysqli_fetch_array($query);
                $num_row   = mysqli_num_rows($query);

                if ($num_row > 0) {
                    $_SESSION['user_id'] = $row['user_id'];
                    header('location:staff-pages/index.php');
                } else {
                    echo "<div class='alert alert-danger alert-dismissible text-center' role='alert' style='font-size: 16px;'>
                    Invalid Username and/or Password
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
                }
            }
            ?>

            <form id="loginform" method="POST" class="form-vertical" action="#">

                <div class="control-group" style="margin-top: 30px;">
                    <div class="controls">
                        <div class="main_input_box">
                            <label for="username">Username</label>
                            <input type="text" name="username" required onfocus="handleFocus(this)" onblur="handleBlur(this)" />
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <label for="password">Password</label>
                            <input type="password" name="password" required onfocus="handleFocus(this)" onblur="handleBlur(this)" />
                        </div>
                    </div>
                </div>

                <div class="form-actions text-center">
                    <button type="submit" class="btn btn-block btn-info" title="Log In" name="login" value="Staff Login" style="font-family: 'Times New Roman', Times, serif; border-radius: 5px; font-size: 18px; padding: 8px;">Login</button>
                    <a href="index.php" class="btn btn-link" name="back" style="font-family: 'Times New Roman', Times, serif; font-size: 18px; padding: 10px; margin-bottom: -30px; margin-top: 2px;">Back</a>
                </div>

            </form>
        </div>
    </div>

    <script>
        function handleFocus(input) {
            input.parentElement.classList.add('input-filled');
        }

        function handleBlur(input) {
            if (input.value === '') {
                input.parentElement.classList.remove('input-filled');
            }
        }
    </script>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>