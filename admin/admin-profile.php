<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="../css/fullcalendar.css" />
    <link rel="stylesheet" href="../css/matrix-style.css" />
    <link rel="stylesheet" href="../css/matrix-media.css" />
    <link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../font-awesome/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/jquery.gritter.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <style>
        .sidebar {
            padding-top: 20px;
        }

        .sidebar .nav>li>a {
            color: #333;
        }

        .form-container {
            margin: 0 auto;
            padding: 35px;
            padding-bottom: 50px;
            max-width: 800px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }

        .form-container h2 {
            margin-bottom: 20px;
        }

        .form-container .form-group {
            margin-bottom: 20px;
            width: 100%;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="tel"] {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            width: 150%;
        }

        .form-container input[type="submit"],
        .form-container input[type="button"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
            font-size: 16px;
        }

        .form-container input[type="submit"]:hover,
        .form-container input[type="button"]:hover {
            background-color: #0056b3;
        }

        .profile-pic-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 40px;
            margin-left: 20px;
            margin-top: 30px;
        }

        .profile-pic {
            width: 170px;
            height: 170px;
            border-radius: 50%;
            background-color: #e0e0e0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            color: #fff;
            position: relative;
            overflow: hidden;
            border: 2px solid #007bff;
            cursor: pointer;
        }

        .profile-pic input[type="file"] {
            display: none;
        }

        .upload-icon {
            position: absolute;
            font-size: 24px;
            color: #007bff;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <!-- Include header -->
    <?php include 'includes/topheader.php'; ?>

    <!-- Include sidebar -->
    <div class="sidebar">
        <?php $page = "admin-profile"; include 'includes/sidebar.php'; ?>
    </div>

    <!-- Main content -->
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb">
                <a href="index.php" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="admin-profile.php" class="current">Admin Profile</a>
            </div>
            <h1>Admin Profile</h1>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class='widget-box'>
                        <div class='widget-title'>
                            <span class='icon'><i class='icon-user'></i></span>
                            <h5>Admin Profile</h5>
                        </div>
                        <div class='widget-content nopadding'>
                            <div class="form-container">
                                <!-- Profile Picture Section -->
                                <div class="profile-pic-container">
                                    <label for="profile_pic_input" class="profile-pic">
                                        <span class="upload-icon">+</span>
                                        <input type="file" id="profile_pic_input" name="profile_pic" accept="image/*">
                                    </label>
                                </div>
                                <!-- Form Section -->
                                <div>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="admin_fullname">Fullname:</label>
                                            <input type="text" id="admin_fullname" name="admin_fullname" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="admin_department">Department/Office:</label>
                                            <input type="text" id="admin_department" name="admin_department" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="admin_email">Email:</label>
                                            <input type="email" id="admin_email" name="admin_email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="admin_gender">Gender:</label>
                                            <input type="text" id="admin_gender" name="admin_gender" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="admin_address">Address:</label>
                                            <input type="text" id="admin_address" name="admin_address" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="admin_contact_no">Contact No:</label>
                                            <input type="tel" id="admin_contact_no" name="admin_contact_no" required>
                                        </div>
                                        <input type="submit" name="submit" value="Update Profile">
                                        <input type="button" value="Cancel" onclick="window.location.href='index.php';">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/matrix.js"></script>
    <script src="../js/excanvas.min.js"></script>
    <script src="../js/jquery.ui.custom.js"></script>
    <script src="../js/jquery.flot.min.js"></script>
    <script src="../js/jquery.flot.resize.min.js"></script>
    <script src="../js/jquery.peity.min.js"></script>
    <script src="../js/fullcalendar.min.js"></script>
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
    <script>
        // Function to handle file input change and display the image immediately
        document.getElementById('profile_pic_input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const profilePic = document.querySelector('.profile-pic');
                    profilePic.style.backgroundImage = `url(${e.target.result})`;
                    profilePic.style.backgroundSize = 'cover';
                    profilePic.style.backgroundPosition = 'center';
                    document.querySelector('.upload-icon').style.display = 'none'; // Hide the '+' icon
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>
