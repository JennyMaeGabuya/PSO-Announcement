<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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
        .sidebar .nav > li > a {
            color: #333;
        }
        .form-container {
            margin: 0 auto;
            padding: 35px;
            max-width: 600px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        .form-container .form-group {
            margin-bottom: 20px;
            width: 100%;
        }
        .form-container input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .form-container input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 0 auto; /* Center the button */
            display: block;
        }
        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Include header -->
    <?php include 'includes/topheader.php'; ?>

    <!-- Include sidebar -->
    <div class="sidebar">
        <?php $page = "change-password"; include 'includes/sidebar.php'; ?>
    </div>

    <!-- Main content -->
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb">
                <a href="index.php" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="change-password.php" class="current">Change Password</a>
            </div>
            <h1>Admin Change Password</h1>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class='widget-box'>
                        <div class='widget-title'>
                            <span class='icon'><i class='icon-lock'></i></span>
                            <h5>Change Password</h5>
                        </div>
                        <div class='widget-content nopadding'>
                            <div class="form-container">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <div class="form-group">
                                        <label for="old_password">Old Password:</label>
                                        <input type="password" id="old_password" name="old_password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">New Password:</label>
                                        <input type="password" id="new_password" name="new_password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="re_new_password">Re-enter New Password:</label>
                                        <input type="password" id="re_new_password" name="re_new_password" required>
                                    </div>
                                    <input type="submit" name="submit" value="Change Password">
                                </form>
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
    <script type="text/javascript">
        function goPage(newURL) {
            if (newURL != "") {
                if (newURL == "-") {
                    resetMenu();
                } else {
                    document.location.href = newURL;
                }
            }
        }

        function resetMenu() {
            document.gomenu.selector.selectedIndex = 2;
        }
    </script>
</body>
</html>
