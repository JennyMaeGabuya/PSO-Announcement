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
  $qry = "SELECT fullname FROM staffs WHERE user_id = '$user_id'";
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
  <title>Inventory System | Staff</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/bootstrap.min.css" />
  <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="../css/fullcalendar.css" />
  <link rel="stylesheet" href="../css/matrix-style.css" />
  <link rel="stylesheet" href="../css/matrix-media.css" />
  <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/jquery.gritter.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

  <style>
    .highlight {
      background-color: #FFFF99;
      border: 1px solid #FFD700;
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

    .highlight {
      color: black;
      font-size: 18px;
    }

    .article-post:not(.highlight) {
      padding: 10px;
    }
  </style>

</head>

<body>

  <!--Header-part-->
  <!--close-Header-part-->

  <?php $page = "dashboard";
  include '../includes/header.php' ?>

  <?php $page = "dashboard";
  include '../includes/sidebar.php' ?>

  <!--main-container-part-->
  <div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
      <div id="breadcrumb"> <a href="index.php" title="You're right here" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
      <!-- <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_lb span"> <a href="index.php"> <i class="icon-dashboard"></i> System Dashboard </a> </li>

        <li class="bg_ls span2"> <a href="announcement.php"> <i class="icon-bullhorn"></i>Announcements </a> </li> -->


      <!-- <li class="bg_ls span2"> <a href="buttons.html"> <i class="icon-tint"></i> Buttons</a> </li>
        <li class="bg_ly span3"> <a href="form-common.html"> <i class="icon-th-list"></i> Forms</a> </li>
        <li class="bg_lb span2"> <a href="interface.html"> <i class="icon-pencil"></i>Elements</a> </li> -->
      <!-- <li class="bg_lg"> <a href="calendar.html"> <i class="icon-calendar"></i> Calendar</a> </li>
        <li class="bg_lr"> <a href="error404.html"> <i class="icon-info-sign"></i> Error</a> </li> -->

      <!-- </ul>
    </div> -->
      <!--End-Action boxes-->

      <!--Chart-box-->
      <div class="row-fluid">
        <div class="widget-box widget-plain">
          <div class="center">
            <ul class="stat-boxes2" style="margin-left: 100px;">
              <li>
                <div class="left peity_bar_neutral"><span><span style="display: none;">2,4,9,7,12,10,12</span>
                    <canvas width="60" height="24"></canvas>
                  </span>+10%</div>
                <div class="right"> <strong><?php include 'dashboard-usercount.php' ?></strong> Registered </div>
              </li>
              <li>
                <div class="left peity_bar_bad"><span><span style="display: none;">3,5,6,16,8,10,6</span>
                    <canvas width="60" height="24"></canvas>
                  </span>-40%</div>
                <div class="right"> <strong><?php include 'actions/count-trainers.php' ?></strong> Useful Life near Due</div>
              </li>
              <li>
                <div class="left peity_line_good"><span><span style="display: none;">12,6,9,23,14,10,17</span>
                    <canvas width="60" height="24"></canvas>
                  </span>+5%</div>
                <div class="right"> <strong><?php include 'actions/count-equipments.php' ?></strong>Products and Supply </div>
              </li>
              <li>
                <div class="left peity_bar_good"><span>12,6,9,23,14,10,13</span>+9%</div>
                <div class="right"> <strong><?php include 'actions/dashboard-staff-count.php' ?></strong> Staffs</div>
              </li>
            </ul>
          </div>
        </div>
      </div><!-- End of row-fluid -->

      <!--End-Chart-box-->
      <hr />
      <div class="row-fluid">
        <div class="span6">
          <div class="widget-box">
            <div class="widget-title bg_ly" data-toggle="collapse"><span class="icon"><i class="icon-chevron-down"></i></span>
              <h5>Property & Supply Office Announcements</h5>
            </div>
            <div class="widget-content nopadding collapse in" id="collapseG2">

              <ul class="recent-posts">
                <li>

                  <?php

                  include "../dbcon.php";

                  // Calculate the date of one week ago
                  $one_week_ago = date('Y-m-d', strtotime('-1 week'));

                  // Retrieve the announcements from the last week and the newest one
                  $qry = "SELECT * FROM announcements WHERE date >= '$one_week_ago' ORDER BY date DESC";
                  $result = mysqli_query($con, $qry);

                  $count = 0; // Initialize count variable
                  while ($row = mysqli_fetch_array($result)) {
                    // Increment count variable
                    $count++;

                    // Check if this is the newest announcement
                    $class = ($count == 1) ? 'highlight' : '';

                    // Start the div with the article-post class
                    echo "<div class='article-post $class'>"; // Add the class here

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

                  <a href="staff-announcement.php"><button class="btn btn-warning btn-mini">View All</button></a>
                </li>
              </ul>
            </div>
          </div>


        </div>
        <div class="span6">

          <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-tasks"></i></span>
              <h5>Request to Transfer</h5>
            </div>
            <div class="widget-content">
              <div class="todo">
                <ul>
                  <?php

                  include "dbcon.php";
                  $qry = "SELECT * FROM todo";
                  $result = mysqli_query($conn, $qry);

                  while ($row = mysqli_fetch_array($result)) { ?>

                    <li class='clearfix'>

                      <div class='txt'> <?php echo $row["task_desc"] ?> <?php if ($row["task_status"] == "Pending") {
                                                                          echo '<span class="date badge badge-important">Pending</span>';
                                                                        } else {
                                                                          echo '<span class="date badge badge-success">In Progress</span>';
                                                                        } ?></div>

                    <?php }
                  echo "</li>";
                  echo "</ul>";
                    ?>
              </div>
            </div>
          </div>



        </div> <!-- End of ToDo List Bar -->
      </div><!-- End of Announcement Bar -->
    </div><!-- End of container-fluid -->
  </div><!-- End of content-ID -->

  <!--end-main-container-part-->

  <!--Footer-part-->

  <?php
  include '../includes/footer.php';
  ?>

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
  <!-- <script src="../js/matrix.interface.js"></script>  -->
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