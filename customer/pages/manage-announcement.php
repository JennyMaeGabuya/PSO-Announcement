<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Inventory | Announcements</title>
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
        .span3 .widget-box .widget-content .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
            margin-right: 12px;
        }

        .span3 .widget-box .widget-content .form-group label {
            margin-bottom: 5px;
        }

        .span3 .widget-box .widget-content .form-group input {
            width: 100%;
        }

        .span3 .widget-box .widget-content .form-group .button-group {
            display: flex;
            gap: 25px;
        }
        
        .highlight-announcement {
            background-color: #FFFF99;
            border: 1px solid #FFD700;
            padding: 10px;
            font-size: 18px;
        }

        .bold-text {
            font-weight: bold;
        }

        .user-thumb {
            background-color: transparent;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <?php $page = "announcement"; include '../includes/topheader.php'; ?>
    <?php $page = "announcement"; include '../includes/sidebar.php'; ?>

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb">
                <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
                <a href="#" class="current">Announcements</a>
            </div>
        </div>

        <div class="container-fluid">
            <h1 class="text-center">Announcements <i class='fas fa-bullhorn'></i></h1>
            <hr>
            <div class="row-fluid">
                <div class="span9">
                    <div class='widget-box'>
                        <div class='widget-title'>
                            <span class='icon'><i class='fas fa-bullhorn'></i></span>
                            <h5 style="color: black;">Announcements Table</h5>
                        </div>
                        <div class='widget-content nopadding' id="announcement_table">
                            <!-- Announcements Table -->
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Table rows will be dynamically inserted here by JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="span3">
                    <div class="widget-box">
                        <div class="widget-title">
                            <h5 style="color: black;">Filter Announcements</h5>
                        </div>
                        <div class="widget-content">
                            <div class="form-group">
                                <label for="start_date">Start Date:</label>
                                <input type="date" id="start_date" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date:</label>
                                <input type="date" id="end_date" class="form-control" />
                            </div>
                            <div class="form-group button-group">
                                <button id="filter_button" class="btn btn-primary" style="margin-bottom: 5px;">Filter</button>
                                <button id="clear_button" class="btn btn-secondary">Clear</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>

    <!-- JavaScript files -->
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

    <!-- Custom Script -->
    <script>
        document.getElementById('clear_button').addEventListener('click', function() {
            document.getElementById('start_date').value = '';
            document.getElementById('end_date').value = '';

            // Trigger AJAX request to reload all announcements
            loadAllAnnouncements();
        });

        document.getElementById('filter_button').addEventListener('click', function() {
            var startDate = document.getElementById('start_date').value;
            var endDate = document.getElementById('end_date').value;

            if (startDate && endDate) {
                // Make AJAX request to fetch filtered announcements
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'fetch-announcement.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.querySelector('#announcement_table tbody').innerHTML = xhr.responseText;
                    }
                };
                xhr.send('start_date=' + startDate + '&end_date=' + endDate);
            } else {
                alert('Please select both start and end dates.');
            }
        });

        // Function to load all announcements
        function loadAllAnnouncements() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fet', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.querySelector('#announcement_table tbody').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        // Load all announcements on initial page load
        window.onload = function() {
            loadAllAnnouncements();
        };
    </script>
</body>

</html>
