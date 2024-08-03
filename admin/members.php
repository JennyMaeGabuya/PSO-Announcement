<?php
session_start();
// Check if the user is logged in
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

  <!--sidebar-menu-->
  <?php $page = "members";
  include 'includes/sidebar.php' ?>
  <!--sidebar-menu-->

  <div id="content">
    <div id="content-header">
      <div id="breadcrumb">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
        <a href="#" class="tip-bottom">Manage Members</a>
        <a href="#" class="current">Registered Members</a>
      </div>
    </div>

    <div class="container-fluid">
      <h1 class="text-center">Registered Members List <i class="fas fa-users"></i></h1>

      <div class="row-fluid">
        <div class="span12">

          <div class='widget-box'>
            <div class='widget-title'>
              <span class='icon'> <i class='fas fa-th'></i> </span>
              <h5>Member table</h5>
            </div>
            <div class='widget-content nopadding'>
              <?php
              include "dbcon.php";

              // Select members and order by date of registration in descending order
              $qry = "SELECT * FROM members ORDER BY dor DESC";
              $result = mysqli_query($con, $qry);

              if ($result) {
                $total_members = mysqli_num_rows($result); // Get the total number of members
                $cnt = $total_members;

                echo "<table class='table table-bordered table-hover'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fullname</th>
                                        <th>Username</th>
                                        <th>Gender</th>
                                        <th>Contact Number</th>
                                        <th>D.O.R</th>
                                        <th>Address</th>
                                        <th>Amount</th>
                                        <th>Choosen Service</th>
                                        <th>Plan</th>
                                    </tr>
                                </thead>
                                <tbody>";

                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>
                                    <td><div class='text-center'>" . $cnt . "</div></td>
                                    <td><div class='text-center'>" . $row['fullname'] . "</div></td>
                                    <td><div class='text-center'>@" . $row['username'] . "</div></td>
                                    <td><div class='text-center'>" . $row['gender'] . "</div></td>
                                    <td><div class='text-center'>" . $row['contact'] . "</div></td>
                                    <td><div class='text-center'>" . $row['dor'] . "</div></td>
                                    <td><div class='text-center'>" . $row['address'] . "</div></td>
                                    <td><div class='text-center'>$" . $row['amount'] . "</div></td>
                                    <td><div class='text-center'>" . $row['services'] . "</div></td>
                                    <td><div class='text-center'>" . $row['plan'] . " Month/s</div></td>
                                    </tr>";
                  $cnt--;
                }

                echo "</tbody></table>";
              } else {
                echo "Error: " . mysqli_error($con);
              }

              mysqli_close($con);
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Footer-part-->
  <?php include 'includes/footer.php'; ?>
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
    // Function to handle page navigation
    function goPage(newURL) {
      if (newURL != "") {
        if (newURL == "-") {
          resetMenu();
        } else {
          document.location.href = newURL;
        }
      }
    }

    // Function to reset menu selection
    function resetMenu() {
      document.gomenu.selector.selectedIndex = 2;
    }
  </script>
</body>

</html>