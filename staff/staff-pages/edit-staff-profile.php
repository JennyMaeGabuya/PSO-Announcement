<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();
}

include '../dbcon.php';

// Use the logged-in user's ID
$id = $_SESSION['user_id'];

$qry = "SELECT * FROM staffs WHERE user_id=?";
$stmt = mysqli_prepare($con, $qry);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<h3>Record not found.</h3>";
    exit();
}

$row = mysqli_fetch_array($result);
mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>PSO Staff</title>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <style>
        #wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #content {
            flex: 1;
        }

        #footer {
            padding: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <!-- Header -->
        <?php include '../includes/header.php'; ?>

        <!-- Sidebar -->
        <?php $page = 'staff-profile';
        include '../includes/sidebar.php'; ?>

        <!-- Main content -->
        <div id="content">
            <div id="content-header">
                <div id="breadcrumb">
                    <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
                    <a href="staff-profile.php" class="tip-bottom">My Profile</a>
                    <a href="#" class="current">Edit Profile</a>
                </div>
                <h1>Edit Profile Details</h1>
            </div>
            <form action="edit-staff-profile.php" method="POST" enctype="multipart/form-data">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $fullname = $_POST['fullname'];
                    $username = $_POST['username'];
                    $gender = $_POST['gender'];
                    $dor = $_POST['dor'];
                    $email = $_POST['email'];
                    $contact = $_POST['contact'];
                    $address = $_POST['address'];
                    $id = $_POST['id'];

                    $profile_picture = $row['profile_picture']; // Default to current profile picture

                    if (isset($_FILES['profile']['name']) && $_FILES['profile']['name'] != '') {
                        $profile_picture = $_FILES['profile']['name'];
                        $target = "../img/profile_picture/" . basename($profile_picture);
                        move_uploaded_file($_FILES['profile']['tmp_name'], $target);
                    }

                    $qry = "UPDATE staffs SET fullname=?, username=?, gender=?, dor=?, email=?, contact=?, address=?, profile_picture=? WHERE user_id=?";
                    $stmt = mysqli_prepare($con, $qry);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, 'ssssssssi', $fullname, $username, $gender, $dor, $email, $contact, $address, $profile_picture, $id);

                        if (mysqli_stmt_execute($stmt)) {
                            echo "<div class='container-fluid'>
                                <div class='row-fluid'>
                                    <div class='span12'>
                                        <div class='widget-box'>
                                            <div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>
                                                <h5>Message</h5>
                                            </div>
                                            <div class='widget-content'>
                                                <div class='error_ex'>
                                                    <h1>Success</h1>
                                                    <h3>Profile details have been updated!</h3>
                                                    <p>The requested details are updated. Please click the button to go back.</p>
                                                    <a class='btn btn-inverse btn-big' href='staff-profile.php'>Go Back</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>";
                        } else {
                            echo "<div class='container-fluid'>
                                <div class='row-fluid'>
                                    <div class='span12'>
                                        <div class='widget-box'>
                                            <div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>
                                                <h5>Error Message</h5>
                                            </div>
                                            <div class='widget-content'>
                                                <div class='error_ex'>
                                                    <h1 style='color:maroon;'>Error</h1>
                                                    <h3>Error occurred while updating your details</h3>
                                                    <p>Please Try Again</p>
                                                    <a class='btn btn-warning btn-big' href='edit-staff-profile.php'>Go Back</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>";
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "Error preparing statement: " . mysqli_error($con);
                    }

                    mysqli_close($con);
                }
                ?>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div id="footer">
        <?php include '../includes/footer.php'; ?>
    </div>

    <!-- Scripts -->
    <script src="../js/excanvas.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.ui.custom.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.flot.min.js"></script>
    <script src="../js/jquery.flot.resize.min.js"></script>
    <script src="../js/jquery.peity.min.js"></script>
    <script src="../js/fullcalendar.min.js"></script>
    <script src="../js/matrix.js"></script>
    <script src="../js/matrix.dashboard.js"></script>
    <script src="../js/jquery.gritter.min.js"></script>
    <script src="../js/matrix.interface.js"></script>
    <script src="../js/matrix.chat.js"></script>
    <script src="../js/jquery.validate.js"></script>
    <script src="../js/matrix.form_validation.js"></script>
    <script src="../js/jquery.wizard.js"></script>
    <script src="../js/jquery.uniform.js"></script>
    <script src="../js/select2.min.js"></script>
    <script src="../js/matrix.popover.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/matrix.tables.js"></script>
</body>

</html>