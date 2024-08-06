<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../dbcon.php';

    $user_id = $_SESSION['user_id'];
    $cpassword = $_POST['cpassword'];
    $new_password = $_POST['new_password'];
    $re_new_password = $_POST['re_new_password'];

    // Validate new password
    if (!preg_match('/^[a-zA-Z0-9!@#$%^&*()_+{}\[\]:;"\'<>,.?]{8,}$/', $new_password)) {
        $_SESSION['alert'] = 'invalid';
        header('location: change-password.php');
        exit();
    }

    // Prepare and execute query to get the current password hash
    $qry = "SELECT password FROM staffs WHERE user_id=?";
    $stmt = mysqli_prepare($con, $qry);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        // Debugging: Print out the password hash
        echo "<script>console.log('DB Password Hash: " . $row['password'] . "');</script>";

        mysqli_stmt_close($stmt);

        // Verify the current password
        if (password_verify($cpassword, $row['password'])) {
            if ($new_password === $re_new_password) {
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update password in the database
                $update_qry = "UPDATE staffs SET password=? WHERE user_id=?";
                $update_stmt = mysqli_prepare($con, $update_qry);
                mysqli_stmt_bind_param($update_stmt, 'si', $hashed_new_password, $user_id);

                if (mysqli_stmt_execute($update_stmt)) {
                    $_SESSION['alert'] = 'success';
                } else {
                    $_SESSION['alert'] = 'error';
                }
                mysqli_stmt_close($update_stmt);
            } else {
                $_SESSION['alert'] = 'mismatch';
            }
        } else {
            $_SESSION['alert'] = 'incorrect';
        }
    } else {
        $_SESSION['alert'] = 'error';
    }

    mysqli_close($con);
    header('location: change-password.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>PSO Staff | Change Password</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="../css/fullcalendar.css" />
    <link rel="stylesheet" href="../css/matrix-style.css" />
    <link rel="stylesheet" href="../css/matrix-media.css" />
    <link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../font-awesome/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/jquery.gritter.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .custom-alert .swal2-popup {
            max-width: 400px !important;
            width: 330px !important;
        }

        .custom-alert .swal2-title {
            font-size: 1.5em;
        }

        .custom-alert .swal2-html-container {
            font-size: 1em;
        }

        .tooltip-inner {
            max-width: 250px;
            text-align: left;
        }
    </style>
</head>

<body>

    <!-- Include header -->
    <?php include '../includes/header.php'; ?>

    <!-- Include sidebar -->
    <div class="sidebar">
        <?php $page = "change-password";
        include '../includes/sidebar.php'; ?>
    </div>

    <!-- Main content -->
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb">
                <a href="index.php" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
                <a href="#" class="current">Change Password</a>
            </div>
        </div>
        <div class="container-fluid">
            <h1 class="text-center">Change Password <i class="fas fa-lock"></i></h1>
            <hr>
            <div class="row-fluid">
                <div class="span6 offset3">
                    <div class="widget-box">
                        <div class="widget-title">
                            <span class="icon"><i class="fas fa-lock"></i></span>
                            <h5>Change Password</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label" for="cpassword">Current Password :</label>
                                    <div class="controls">
                                        <input type="password" id="cpassword" name="cpassword" class="span11" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="new_password">New Password :</label>
                                    <div class="controls">
                                        <input type="password" id="new_password" name="new_password" class="span11" required data-toggle="tooltip" data-placement="right" title="Must be at least 8 characters long.">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="re_new_password">Re-enter New Password :</label>
                                    <div class="controls">
                                        <input type="password" id="re_new_password" name="re_new_password" class="span11" required>
                                    </div>
                                </div>
                                <div class="form-actions text-center">
                                    <button type="submit" name="submit" class="btn btn-success">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include footer -->
    <?php include '../includes/footer.php'; ?>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/matrix.js"></script>
    <script src="../js/jquery.ui.custom.js"></script>
    <script src="../js/jquery.validate.js"></script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            <?php if (isset($_SESSION['alert'])) : ?>
                <?php if ($_SESSION['alert'] == 'success') : ?>
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your password has been successfully changed.',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        customClass: {
                            container: 'custom-alert'
                        }
                    });
                <?php elseif ($_SESSION['alert'] == 'mismatch') : ?>
                    Swal.fire({
                        title: 'Error!',
                        text: 'New password and confirm password do not match.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        customClass: {
                            container: 'custom-alert'
                        }
                    });
                <?php elseif ($_SESSION['alert'] == 'incorrect') : ?>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Your current password is incorrect.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        customClass: {
                            container: 'custom-alert'
                        }
                    });
                <?php elseif ($_SESSION['alert'] == 'invalid') : ?>
                    Swal.fire({
                        title: 'Alert!',
                        text: 'New password must be at least 8 characters long.',
                        icon: 'warning',
                        confirmButtonText: 'OK',
                        customClass: {
                            container: 'custom-alert'
                        }
                    });
                <?php else : ?>
                    Swal.fire({
                        title: 'Error!',
                        text: 'An unknown error occurred.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        customClass: {
                            container: 'custom-alert'
                        }
                    });
                <?php endif; ?>
                <?php unset($_SESSION['alert']); ?>
            <?php endif; ?>
        });
    </script>
</body>

</html>