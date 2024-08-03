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
  <link rel="stylesheet" href="../css/uniform.css" />
  <link rel="stylesheet" href="../css/select2.css" />
  <link rel="stylesheet" href="../css/matrix-style.css" />
  <link rel="stylesheet" href="../css/matrix-media.css" />
  <link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
  <link href="../font-awesome/css/all.css" rel="stylesheet" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>

<body>

  <!--Header-part-->
  <!--close-Header-part-->

  <!--top-Header-menu-->
  <?php include 'includes/topheader.php' ?>
  <!--close-top-Header-menu-->

  <!--sidebar-menu-->
  <?php $page = 'staff-management';
  include 'includes/sidebar.php' ?>
  <!--sidebar-menu-->

  <div id="content">
    <div id="content-header">
      <div id="breadcrumb">
        <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
        <a href="staffs.php" class="current">Staff Members</a>
      </div>
    </div>
    <div class="container-fluid">
      <h1 class="text-center">PSO Staff List <i class="fas fa-briefcase"></i></h1>
      <hr>
      <div class="row-fluid">
        <div class="span12">
          <a href="staffs-entry.php"><button class="btn btn-primary">Add Staff Members</button></a>
          <div class='widget-box'>
            <div class='widget-title'>
              <span class='icon'> <i class='fas fa-th'></i> </span>
              <h5>Staff table</h5>
            </div>
            <div class='widget-content nopadding'>
              <?php
              include "dbcon.php";

              // Query to select staff members ordered by DOD in descending order
              $qry = "SELECT * FROM staffs ORDER BY dor DESC";
              $result = mysqli_query($conn, $qry);

              if ($result) {
                $total_staff = mysqli_num_rows($result); // Get the total number of staff members
                $cnt = $total_staff; // Initialize the count to the total number of staff members

                echo "<table class='table table-bordered table-hover'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fullname</th>
                                        <th>Username</th>
                                        <th>DOD</th>
                                        <th>Designation</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>";

                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>
                                    <td><div class='text-center'>" . $cnt . "</div></td>
                                    <td><div class='text-center'>" . $row['fullname'] . "</div></td>
                                    <td><div class='text-center'>@" . $row['username'] . "</div></td>
                                    <td><div class='text-center'>" . $row['dor'] . "</div></td>
                                    <td><div class='text-center'>" . $row['designation'] . "</div></td>
                                    <td><div class='text-center'>" . $row['email'] . "</div></td>
                                    <td><div class='text-center'>" . $row['address'] . "</div></td>
                                    <td><div class='text-center'>" . $row['contact'] . "</div></td>
                                    <td><div class='text-center'><a href='edit-staff-form.php?id=" . $row['user_id'] . "'><i class='fas fa-edit' style='color:#28b779'></i> Edit |</a> <a href='remove-staff.php?id=" . $row['user_id'] . "' style='color:#F66;'><i class='fas fa-trash'></i> Remove</a></div></td>
                                    </tr>";
                  $cnt--; // Decrement the count
                }

                echo "</tbody></table>";
              } else {
                echo "Error: " . mysqli_error($conn);
              }

              mysqli_close($conn);
              ?>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!--end-main-container-part-->

  <!--Footer-part-->
  <?php include 'includes/footer.php'; ?>
  <!--end-Footer-part-->

  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery.ui.custom.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.uniform.js"></script>
  <script src="../js/select2.min.js"></script>
  <script src="../js/jquery.dataTables.min.js"></script>
  <script src="../js/matrix.js"></script>
  <script src="../js/matrix.tables.js"></script>
</body>

</html>