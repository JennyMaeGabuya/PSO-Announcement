<?php
session_start();
// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();
}

include "../dbcon.php";
$id = isset($_GET['id']) ? intval($_GET['id']) : null; // Ensure $id is an integer

if ($id) {
    $query = mysqli_query($con, "SELECT * FROM announcements WHERE id = $id");

    if (!$query) {
        die("Error: " . mysqli_error($con));
    }

    // Check if any rows are returned
    if (mysqli_num_rows($query) === 0) {
        $announcement = null;
    } else {
        $announcement = mysqli_fetch_array($query, MYSQLI_ASSOC); // Fetch as associative array
    }
} else {
    $announcement = null;
}
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
        .widget-box {
            background-color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th:first-child,
        td:first-child {
            text-align: right;
            width: 20%;
        }
    </style>
</head>

<body>

    <!-- Header-part -->
    <?php include 'includes/topheader.php'; ?>
    <!-- close-Header-part -->

    <!-- Sidebar-menu -->
    <?php $page = 'announcement';
    include 'includes/sidebar.php'; ?>
    <!-- close-sidebar-menu -->
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
                <a href="staff-announcement.php">Announcements</a>
                <a href="#" class="current">View Announcement</a>
            </div>
        </div>

        <div class="container-fluid">
            <h1 class="text-center">Announcements <i class="fas fa-bullhorn"></i></h1>
            <hr>
            <div class='widget-box'>
                <div class='widget-content' style="font-size: 14px;">
                    <?php
                    if ($announcement) {
                        echo "<table>";
                        echo "<tr>
                            <th>Announcement ID</th>
                            <td>" . htmlentities($announcement['id']) . "</td>
                        </tr>";
                        echo "<tr>
                            <th>Message</th>
                            <td>" . (isset($announcement['message']) ? htmlentities($announcement['message']) : 'No message') . "</td>
                        </tr>";
                        echo "<tr>
                            <th>Date</th>
                            <td>" . (isset($announcement['date']) ? htmlentities($announcement['date']) : 'No date') . "</td>
                        </tr>";
                        echo "</table>";
                    } else {
                        echo "No announcement found or ID is not set!";
                    }
                    ?>
                    <a class="btn btn-primary btn-sm" href="manage-announcement.php" role="button" style="margin: 10px; margin-left: 220px; margin-bottom: 2px; margin-top: 15px; font-size: 15px">Back</a>
                </div>
            </div>

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

            <script type="text/javascript">
                // This function is called from the pop-up menus to transfer to
                // a different page. Ignore if the value returned is a null string:
                function goPage(newURL) {

                    // if url is empty, skip the menu dividers and reset the menu selection to default
                    if (newURL != "") {

                        // if url is "-", it is this page -- reset the menu:
                        if (newURL == "-") {
                            resetMenu();
                        }
                        // else, send page to designated URL            
                        else {
                            document.location.href = newURL;
                        }
                    }
                }

                // resets the menu selection upon entry to this page:
                function resetMenu() {
                    document.gomenu.selector.selectedIndex = 2;
                }
            </script>
</body>

</html>