<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('location:../index.php');
  exit();
}

// Default fullname if not found
$user_name = 'Guest';

// Check if the user's name is stored in the session
if (isset($_SESSION['fullname'])) {
  $user_name = $_SESSION['fullname'];
} else {
  // Fetch fullname from database if not set in session
  include "../dbcon.php"; // Adjust the path as necessary

  $user_id = $_SESSION['user_id'];
  $qry = "SELECT fullname FROM members WHERE user_id = '$user_id'";
  $result = mysqli_query($con, $qry);

  if ($result && $row = mysqli_fetch_assoc($result)) {
    $user_name = $row['fullname'];
    $_SESSION['fullname'] = $user_name; // Store in session for future use
  }

  mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PSO Inventory System | User</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/bootstrap.min.css" />
  <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="../css/fullcalendar.css" />
  <link rel="stylesheet" href="../css/matrix-style.css" />
  <link rel="stylesheet" href="../css/matrix-media.css" />
  <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/jquery.gritter.css" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

  <style>
    body {
      background-color: #1f262d;
    }

    #sidebar {
      color: white;
      height: 100vh;
    }

    #sidebar a {
      color: white;
    }

    #content #content-header {
      border: 2px solid #ddd;
      padding: 5px;
      background-color: #f5f5f5;
      border-radius: 5px;
    }

    #content {
      padding-top: 0px;
    }

    .highlight {
      background-color: #FFFF99;
      border: 1px solid #FFD700;
      color: black;
      font-size: 18px;
    }

    .zoom-img {
      transition: transform 0.3s ease;
    }

    .zoom-img:hover {
      transform: scale(1.1);
    }

    .user-thumb {
      float: left;
      margin-right: 10px;
      background-color: transparent;
    }

    .article-post {
      overflow: hidden;
      padding-left: 10px;
    }

    .article-post:not(.highlight) {
      padding: 10px;
    }
  </style>
</head>

<body>

  <!--top-Header-menu-->
  <?php include '../includes/topheader.php' ?>
  <!--close-top-Header-menu-->

  <!--sidebar-menu-->
  <?php $page = "dashboard";
  include '../includes/sidebar.php' ?>
  <!--sidebar-menu-->

  <!--main-container-part-->
  <div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
      <div id="breadcrumb"> <a href="index.php" title="You're right here" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

      <div class="row-fluid">

        <div class="span6">

          <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
              <h5>Reminders</h5>
            </div>
            <div class="widget-content nopadding collapse in">
              <ul class="recent-posts">
                <li>

                  <?php
                  include "dbcon.php";

                  // Calculate the date of one week ago
                  $one_week_ago = date('Y-m-d', strtotime('-1 week'));

                  // Retrieve the reminders from the last week
                  $qry = "SELECT * FROM reminder WHERE date >= '$one_week_ago' ORDER BY date DESC";
                  $result = mysqli_query($con, $qry);

                  $count = 0; // Initialize count variable
                  while ($row = mysqli_fetch_array($result)) {
                    // Increment count variable
                    $count++;

                    // Check if this is the newest reminder
                    $class = ($count == 1) ? 'highlight' : '';

                    // Start the div with the article-post class
                    echo "<div class='article-post $class'>";

                    // Check if this is the highlighted reminder
                    $messageStyle = ($class == 'highlight') ? 'font-weight: bold;' : '';

                    // Start the div for user-thumb
                    echo "<div class='user-thumb'>";
                    echo "<img class='img-responsive zoom-img' width='50' height='50' alt='Alert' src='../img/icons/alert.png'> ";
                    echo "</div>"; // Close the user-thumb div

                    // Start the div for reminder content
                    echo "<div>";
                    echo "<span class='user-info'> By: System Administrator / Date: " . $row['date'] . " </span>";
                    echo "<p><a href='#' style='$messageStyle'>" . $row['message'] . "</a> </p>";
                    echo "</div>"; // Close the reminder content div

                    echo "</div>"; // Close the article-post div
                  }
                  ?>

                  <a href="customer-reminder.php"><button class="btn btn-warning btn-mini">View All</button></a>
                </li>
              </ul>
            </div>
          </div>

        </div> <!-- End of Reminders -->

        <div class="span6">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-bullhorn"></i></span>
              <h5>Announcements</h5>
            </div>
            <div class="widget-content nopadding collapse in">
              <ul class="recent-posts">
                <li>

                  <?php
                  include "dbcon.php";

                  // Calculate the date of one week ago
                  $one_week_ago = date('Y-m-d', strtotime('-1 week'));

                  // Retrieve the announcements from the last week
                  $qry = "SELECT * FROM announcements WHERE date >= '$one_week_ago' ORDER BY date DESC";
                  $result = mysqli_query($con, $qry);

                  $count = 0; // Initialize count variable
                  while ($row = mysqli_fetch_array($result)) {
                    // Increment count variable
                    $count++;

                    // Check if this is the newest announcement
                    $class = ($count == 1) ? 'highlight' : '';

                    // Start the div with the article-post class
                    echo "<div class='article-post $class'>";

                    // Check if this is the highlighted announcement
                    $messageStyle = ($class == 'highlight') ? 'font-weight: bold;' : '';

                    // Truncate the message to the first 15 words and add "..."
                    $message = implode(' ', array_slice(explode(' ', $row['message']), 0, 15));
                    $message = strlen($row['message']) > 15 ? $message . "..." : $message;

                    // Start the div for user-thumb
                    echo "<div class='user-thumb' style='float: left; margin-right: 10px;'>"; // Adjust styling here
                    echo "<img class='img-responsive zoom-img' width='50' height='50' alt='Alert' src='../img/icons/announcement.png'> ";
                    echo "</div>"; // Close the user-thumb div

                    // Start the div for announcement content
                    echo "<div style='overflow: hidden;'>"; // Adjust styling here
                    echo "<span class='user-info'> By: System Administrator / Date: " . $row['date'] . " </span>";
                    echo "<p><a href='#' style='$messageStyle'>" . $message . "</a> </p>";
                    echo "</div>"; // Close the announcement content div

                    echo "</div>"; // Close the article-post div
                  }
                  ?>

                  <a href="announcement.php"><button class="btn btn-warning btn-mini">View All</button></a>
                </li>
              </ul>
            </div>
          </div>
        </div> <!-- End of Announcements -->

      </div><!-- End of row-fluid -->
    </div><!-- End of container-fluid -->
  </div><!-- End of content-ID -->

  <!--end-main-container-part-->

  <!--Footer-->
  <?php include '../includes/footer.php' ?>

  <style>
    .card {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      max-width: 460px;
      margin: auto;
      text-align: center;
      font-family: arial;
    }

    .title {
      color: grey;
      font-size: 18px;
    }
  </style>

  <!--end-Footer-part-->

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
      if (newURL != "") {
        if (newURL == "-") {
          resetMenu();
        } else {
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