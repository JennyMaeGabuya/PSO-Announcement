<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header('location:../index.php');
}

include "dbcon.php";

// Check if a search query is submitted
$search = '';
if (isset($_POST['search'])) {
  $search = mysqli_real_escape_string($con, $_POST['search']);
}

// Construct the SQL query with search functionality
$qry = "SELECT * FROM members WHERE fullname LIKE '%$search%' ORDER BY dor DESC";
$result = mysqli_query($con, $qry);
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
  <style>
    #custom-search-form {
      margin: 0;
      margin-top: 5px;
      padding-right: 10px;
      display: flex;
      justify-content: flex-end;
    }

    #custom-search-form .search-container {
      position: relative;
      display: flex;
    }

    #custom-search-form .search-query {
      padding: 5px 10px;
      padding-right: 30px;
      /* Adds space for the button */
      margin-bottom: 0;
      border-radius: 3px;
      border: 1px solid #ccc;
      width: 150px;
      /* Adjust width as needed */
    }

    #custom-search-form .search-button {
      position: absolute;
      top: 0;
      right: 0;
      height: 100%;
      border: none;
      background-color: #007bff;
      /* Change to the desired background color */
      color: white;
      /* Text color */
      border-radius: 0 3px 3px 0;
      /* Rounded corners on the right side */
      padding: 5px 10px;
      cursor: pointer;
    }

    #custom-search-form .search-button i {
      margin: 0;
    }
  </style>
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
        <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
        <a href="#" class="current">Manage Members</a>
      </div>
    </div>

    <div class="container-fluid">
      <h1 class="text-center">Registered Members List <i class="fas fa-users"></i></h1>
      <hr>

      <div class="row-fluid">
        <div class="span12">
          <div class='widget-box'>
            <div class='widget-title'>
              <span class='icon'> <i class='fas fa-th'></i> </span>
              <h5>Member table</h5>
              <!-- Search Form -->
              <!-- Search Form -->
              <form id="custom-search-form" role="search" method="POST" action="">
                <div class="search-container">
                  <input type="text" class="search-query" placeholder="Search" name="search"
                    value="<?php echo htmlspecialchars($search); ?>" required>
                  <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
                </div>
              </form>
            </div>
            <div class='widget-content nopadding'>
              <?php
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