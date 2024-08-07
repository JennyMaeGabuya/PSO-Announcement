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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    .custom-alert .swal2-popup {
      max-width: 400px !important;
      width: 330px !important;
    }

    .custom-alert .swal2-title {
      font-size: 1.5em;
    }

    .custom-alert .swal2-html-container {
      font-size: 1em;
    }
  </style>
</head>

<body>
  <!--top-Header-menu-->
  <?php include 'includes/topheader.php' ?>

  <!--sidebar-menu-->
  <?php $page = "announcement";
  include 'includes/sidebar.php' ?>

  <div id="content">
    <div id="content-header">
      <div id="breadcrumb">
        <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
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
            <div class='widget-title'>
              <span class='icon'><i class='fas fa-bullhorn'></i></span>
              <h5 style="color: black;">Announcement Table</h5>
            </div>
            <div class='widget-content nopadding'>

              <?php
              include "dbcon.php";
              $qry = "SELECT * FROM announcements ORDER BY id DESC";
              $result = mysqli_query($conn, $qry);

              echo "<table class='table table-bordered table-hover'>
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>To</th>
                          <th>Subject</th>
                          <th>Date</th>
                          <th>Message</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>";

              $totalRows = mysqli_num_rows($result);
              $cnt = $totalRows;

              while ($row = mysqli_fetch_array($result)) {
                $message = implode(' ', array_slice(explode(' ', $row['message']), 0, 15));
                $message = strlen($row['message']) > 15 ? $message . "..." : $message;

                echo "<tr>
                        <td><div class='text-center'>" . $cnt . "</div></td>
                        <td><div class='text-center'>" . $row['toWho'] . "</div></td>
                        <td><div class='text-center'>" . $row['subject'] . "</div></td>
                        <td><div class='text-center'>" . $row['date'] . "</div></td>
                        <td><div class='text-center'>" . $message . "</div></td>
                        <td><div class='text-center'>
                            <a href='view-announcement.php?id=" . $row['id'] . "' title='View' style='color:#0080FF;'><i class='fas fa-eye'></i> View</a>
                            &nbsp; | &nbsp;
                            <a href='#' onclick='confirmDelete(" . $row['id'] . ")' title='Remove' style='color:#F66;'><i class='fas fa-trash'></i> Remove</a>
                          </div></td>
                      </tr>";
                $cnt--;
              }

              echo "</tbody></table>";
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
    function confirmDelete(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        customClass: {
          container: 'custom-alert'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'actions/remove-announcement.php?id=' + id;
        }
      })
    }

    // Check if the success parameter is present in the URL
    <?php if (isset($_GET['success']) && $_GET['success'] == 'true') : ?>
      Swal.fire({
        title: 'Deleted!',
        text: 'The announcement has been deleted.',
        icon: 'success',
        confirmButtonText: 'OK',
        customClass: {
          container: 'custom-alert'
        }
      });
    <?php endif; ?>
  </script>
</body>

</html>