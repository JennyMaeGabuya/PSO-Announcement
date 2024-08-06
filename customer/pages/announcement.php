<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if (!isset($_SESSION['user_id'])) {
  header('location:../index.php');
  exit(); // Add exit to stop script execution after redirecting
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PSO Inventory System</title>
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
  </style>

</head>

<body>

  <!--Header-part-->

  <!--close-Header-part-->

  <!--top-Header-menu-->
  <?php include '../includes/topheader.php' ?>
  <!--close-top-Header-menu-->

  <!--sidebar-menu-->
  <?php $page = "announcement";
  include '../includes/sidebar.php' ?>
  <!--sidebar-menu-->

  <!--main-container-part-->
  <div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
      <div id="breadcrumb">
        <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon icon-home"></i> Home</a>
        <a href="#" class="current">Announcements</a>
      </div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
      <h1 class="text-center">Annoucements <i class="fas fa-bullhorn"></i></h1>
      <hr>

      <!--End-Action boxes-->

      <div class="row-fluid">

        <div class="span12">
          <div class="widget-box">
            <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="icon-chevron-down"></i></span>
              <h5>Property & Supply Office Announcement</h5>
            </div>
            <div class="widget-content nopadding collapse in" id="collapseG2">
              <ul class="recent-posts">

                <li>

                  <?php
                  include "dbcon.php";
                  $qry = "SELECT * FROM announcements WHERE (toWho = 'User' OR toWho = 'All') ORDER BY date DESC";

                  $result = mysqli_query($con, $qry);
                  $first_row = true;

                  while ($row = mysqli_fetch_array($result)) {
                    // Open a div and apply conditional class for highlighting
                    echo "<div class='" . ($first_row ? 'highlight-announcement' : '') . "'>";
                    echo "<div class='user-thumb'> <img width='50' height='50' alt='Alert' src='../img/icons/announcement.png'> </div>";
                    echo "<div class='article-post'>";
                    echo "<span class='user-info'> By: System Administrator / Date: " . $row['date'] . " </span>";
                    // Apply conditional class for making text bold
                    echo "<p><a href='#' class='" . ($first_row ? 'bold-text' : '') . "'>" . $row['message'] . "</a></p>";
                    echo "</div>"; // Close .article-post
                    echo "</div>"; // Close .highlight-announcement

                    // Only apply the bold style for the first (newest) announcement
                    $first_row = false;
                  }
                  ?>

                </li>

              </ul>
            </div>
          </div>
        </div><!--end of span 12 -->
      </div><!-- End of row-fluid -->
    </div><!-- End of container-fluid -->
  </div><!-- End of content-ID -->
  </div><!--end-main-container-part-->

  <!--Footer-->
  <?php include '../includes/footer.php' ?>
  <!--end-Footer-part-->

  <script src="../js/excanvas.min.js"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery.ui.custom.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.flot.min.js"></script>
  <script src="../js/jquery.flot.resize.min.js"></script>
  <script src="../js/jquery.peity.min.js"></script>
  <!-- <script src="../js/full/calendar.min.js"></script> -->
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