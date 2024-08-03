<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if (!isset($_SESSION['user_id'])) {
  header('location:../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PSO Admin</title>
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
</head>

<body>

  <!--Header-part-->

  <!--close-Header-part-->

  <!--top-Header-menu-->
  <?php include 'includes/topheader.php' ?>
  <!--close-top-Header-menu-->
  <!--start-top-serch-->
  <!-- <div id="search">
  <input type="hidden" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div> -->
  <!--close-top-serch-->

  <!--sidebar-menu-->
  <?php $page = "announcement";
  include 'includes/sidebar.php' ?>
  <!--sidebar-menu-->

  <div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
        <a href="announcement.php">Announcements</a>
        <a href="#" class="current">Manage Announcements</a>
      </div>
    </div>
    <div class="container-fluid">
      <h1 class="text-center">Manage Announcement <i class="fas fa-bullhorn"></i></h1>
      <hr>
      <div class="row-fluid">
        <div class="span12">

          <div class='widget-box'>
            <div class='widget-title'> <span class='icon'> <i class='fas fa-bullhorn'></i> </span>
              <h5 style="color: black;">Announcement Table</h5>
            </div>
            <div class='widget-content nopadding'>

              <?php
              include "dbcon.php";
              $qry = "SELECT * FROM announcements ORDER BY id DESC"; // Fetch data in descending order of id
              $result = mysqli_query($conn, $qry);

              echo "<table class='table table-bordered table-hover'>
          <thead>
            <tr>
              <th>#</th>
              <th>Date</th>
              <th>Message</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>";

              $totalRows = mysqli_num_rows($result); // Get the total number of rows
              $cnt = $totalRows; // Start with the total number of rows

              while ($row = mysqli_fetch_array($result)) {
                // Truncate the message to the first 15 words
                $message = implode(' ', array_slice(explode(' ', $row['message']), 0, 15));
                $message = strlen($row['message']) > 15 ? $message . "..." : $message;

                echo "<tr>
            <td><div class='text-center'>" . $cnt . "</div></td>
            <td><div class='text-center'>" . $row['date'] . "</div></td>
            <td><div class='text-center'>" . $message . "</div></td>
            <td><div class='text-center'><a href='actions/remove-announcement.php?id=" . $row['id'] . "' style='color:#F66;' ><i class='fas fa-trash'></i> Remove</a></div></td></tr>";
                $cnt--; // Decrease the count for the next row
              }

              echo "</tbody>
      </table>";
              ?>

              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!--end-main-container-part-->

  <!--Footer-part-->

  <?php
  include 'includes/footer.php';
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