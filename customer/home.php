<?php
session_start();
include('dbcon.php');

// Initialize error message variable
$error_message = "";

if (isset($_POST['login'])) {
    $username = isset($_POST['username']) ? mysqli_real_escape_string($con, $_POST['username']) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($con, $_POST['password']) : '';

    if (!empty($username) && !empty($password)) { // Check if username and password are not empty
        $password = md5($password);

        $query = mysqli_query($con, "SELECT * FROM members WHERE password='$password' and username='$username'");
        $row = mysqli_fetch_array($query);
        $num_row = mysqli_num_rows($query);

        if ($num_row > 0) {
            $_SESSION['user_id'] = $row['user_id'];
            header('location:pages/index.php');
            exit(); // Make sure to exit after header redirection
        } else {
            // Set error message
            $error_message = "<div class='alert alert-danger alert-dismissible text-center' role='alert' style='font-size: 16px;'>
                Invalid Username and/or Password
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>";
        }
    } else {
        // Handle case where username or password is empty
        $error_message = "<div class='alert alert-danger alert-dismissible text-center' role='alert' style='font-size: 16px;'>
            Username and/or Password cannot be empty
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
    }
} elseif (isset($_POST['change'])) {
    // Code for handling forgot password form submission
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0; // Corrected field name to 'id'
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check if user_id, email, and id match in the database
    $query = mysqli_query($con, "SELECT * FROM members WHERE username='$username' AND email='$email' AND user_id='$id'");
    $num_rows = mysqli_num_rows($query);

    if ($num_rows == 1) {
        // Update password in the members table
        $hashedPassword = md5($password);
        $updateQuery = "UPDATE members SET password='$hashedPassword' WHERE username='$username' AND email='$email' AND user_id='$id'";
        $result = mysqli_query($con, $updateQuery);

        if ($result) {
            // Set success message
            $error_message = "<div class='alert alert-success alert-dismissible text-center' role='alert' style='font-size: 16px;'>
                Password updated successfully!
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>";
        } else {
            // Set error message
            $error_message = "<div class='alert alert-danger alert-dismissible text-center' role='alert' style='font-size: 16px;'>
                Password update failed. Please try again.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>";
        }
    } else {
        // Set error message for mismatched user information
        $error_message = "<div class='alert alert-danger alert-dismissible text-center' role='alert' style='font-size: 16px;'>
            Incorrect username, email, or designation. Please check and try again.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
    }
}
?>

<script>
    function closeAlert() {
        document.querySelector('.alert').style.display = 'none';
    }
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>PSO Inventory | User Login</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="css/matrix-style.css" />
    <link rel="stylesheet" href="css/matrix-login.css" />
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <style>
        body {
            margin: 0;
            font-family: 'Times New Roman', Times, serif;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            display: flex;
            width: 100%;
            background-color: white;
            ;
        }

        .login-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
        }

        .background {
            flex: 1;
            background-image: url('img/bsu_img.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        .login-page {
            width: 100%;
            max-width: 440px;
            padding: 20px;
            border-radius: 5px;
            background-color: white;
        }

        .login-heading {
            text-align: center;
        }

        .login-heading img {
            height: 100px;
            width: 110px;
            vertical-align: middle;
            margin-top: 12px;
            animation: spinLogo 6s linear infinite;
        }

        .btn-login {
            border-radius: 5px;
            padding: 10px 30px;
            font-size: 15px;
        }

        .control-group {
            text-align: center;
            margin-bottom: 10px;
        }

        .main_input_box {
            position: relative;
            margin-bottom: 20px;
        }

        .main_input_box input {
            padding: 20px;
            font-size: 13px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .main_input_box label {
            position: absolute;
            left: 20px;
            top: 50%;
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

        /* CSS to center the modal */
        .modal {
            text-align: center;
            padding: 0 !important;
            width: 450px;
        }

        .modal:before {
            content: '';
            display: inline-block;
            height: 100%;
            vertical-align: middle;
            margin-right: -4px;
        }

        .modal-dialog {
            display: inline-block;
            text-align: left;
            vertical-align: middle;
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="login-container">
            <div class="login-page">
                <div class="text-center">
                    <b>
                        <h1 style="margin-bottom: 10px;">User Login</h1>
                    </b>
                    <h3 style="margin-bottom: 15px; color: #E71B03;">PSO Inventory System</h3>
                </div>

                <!-- Display error/success message -->
                <?php echo $error_message; ?>

                <form id="loginform" method="POST" class="form-vertical" action="#">

                    <div class="control-group" style="margin-top: 30px;">
                        <div class="controls">
                            <div class="main_input_box">
                                <label for="username">Email</label>
                                <input type="text" name="username" required onfocus="handleFocus(this)" onblur="handleBlur(this)" />
                            </div>
                        </div>
                    </div>

                    <div class="control-group" style="display: flex; flex-direction: column;">
                        <div class="controls">
                            <div class="main_input_box">
                                <label for="password">Password</label>
                                <input type="password" name="password" required onfocus="handleFocus(this)" onblur="handleBlur(this)" />
                            </div>
                        </div>

                        <a href="#" class="btn btn-link" data-toggle="modal" data-target="#forgotPasswordModal" style="text-align: right; margin:-15px; margin-bottom: -10px;">Forgot Password?</a>
                    </div>

                    <div class="form-actions text-center">
                        <button type="submit" class="btn btn-block btn-info" title="Log In" name="login" value="Login" style="font-family: 'Times New Roman', Times, serif; border-radius: 5px; font-size: 18px; padding: 8px;">Login</button>
                        <a href="index.php" class="btn btn-link" name="back" style="font-family: 'Times New Roman', Times, serif; font-size: 18px; padding: 10px; margin-bottom: -30px; margin-top: 2px;">Back</a>
                    </div>

                </form>

                <!-- Forgot Password -->
                <div id="forgotPasswordModal" class="modal fade">
                    <div class="modal-dialog modal-lg" style="padding: 25px;">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: white;">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="font-size: 24px; color: #E71B03">Forgot Password?</h4>
                            </div>
                            <div class="modal-body">
                                <p style="font-size: 18px;">Enter your details below to reset your password.</p>
                                <form class="form-login" name="forgot" method="post" style="font-family:'Times New Roman', Times, serif;">
                                    <input type="text" name="id" placeholder="ID" autocomplete="off" class="form-control" style="font-size: 16px; width: 325px; height: 30px;" required><br>
                                    <input type="text" name="username" placeholder="Username" autocomplete="off" class="form-control" style="font-size: 16px; width: 325px; height: 30px;" required><br>
                                    <input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control" style="font-size: 16px; width: 325px; height: 30px;" required><br>
                                    <input type="password" class="form-control" placeholder="New Password" id="password" name="password" style="font-size: 16px; width: 325px; height: 30px;" required><br>
                                    <input type="password" class="form-control unicase-form-control text-input" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" style="font-size: 16px; width: 325px; height: 30px;" required>
                                    <div class="modal-footer" style="background-color: white;">
                                        <button type="button" class="btn btn-default" data-dismiss="modal" style="font-size: 16px;">Cancel</button>
                                        <button type="submit" class="btn btn-danger" name="change" onclick="return valid();" style="font-size: 16px;">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="background"></div>
    </div>

    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
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

        document.getElementById('loginLink').addEventListener('click', function(event) {
            document.getElementById('loadingOverlay').style.display = 'block';
        });
    </script>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>