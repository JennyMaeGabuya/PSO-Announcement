<?php
session_start();
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
  <script src="../js/jquery.min.js"></script>

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

  <!--Header-part-->
  <!--close-Header-part-->

  <!--top-Header-menu-->
  <?php include 'includes/topheader.php'; ?>
  <!--close-top-Header-menu-->

  <!--sidebar-menu-->
  <?php $page = 'payment';
  include 'includes/sidebar.php'; ?>
  <!--sidebar-menu-->

  <div id="content">
    <div id="content-header">
      <div id="breadcrumb">
        <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
        <a href="#" class="current">In-system Reminder</a>
      </div>
    </div>

    <div class="container-fluid">
      <h1 class="text-center">In-system Reminder <i class="fas fa-exclamation-triangle"></i></h1>
      <hr>
      <div class="row-fluid">
        <div class="span12">
          <div class='widget-box'>
            <div class='widget-title'>
              <span class='icon'><i class='fas fa-th'></i></span>
              <h5>Reminder Alert Table</h5>
              <form id="custom-search-form" role="search" method="POST" action="search-result.php" class="form-search form-horizontal pull-right">
                <div class="input-append span12">
                  <input type="text" class="search-query" placeholder="Search" name="search" required>
                  <button type="submit" class="btn"><i class="fas fa-search"></i></button>
                </div>
              </form>
            </div>
            <div class='widget-content nopadding'>
              <?php
              include "dbcon.php";
              $qry = "SELECT * FROM members ORDER BY user_id DESC";
              $result = mysqli_query($con, $qry);

              if ($result) {
                $remind_mem = mysqli_num_rows($result); // Get the total number of equipment
                $cnt = $remind_mem;

                echo "<table class='table table-bordered data-table table-hover'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Member</th>
                                        <th>Last Payment Date</th>
                                        <th>Amount</th>
                                        <th>Chosen Service</th>
                                        <th>Plan</th>
                                        <th>Action</th>
                                        <th>Remind</th>
                                    </tr>
                                </thead>
                                <tbody>";

                while ($row = mysqli_fetch_array($result)) {
                  echo "
                                    <tr>
                                        <td><div class='text-center'>{$cnt}</div></td>
                                        <td><div class='text-center'>{$row['fullname']}</div></td>
                                        <td><div class='text-center'>" . ($row['paid_date'] == 0 ? "New Member" : $row['paid_date']) . "</div></td>
                                        <td><div class='text-center'>$" . $row['amount'] . "</div></td>
                                        <td><div class='text-center'>{$row['services']}</div></td>
                                        <td><div class='text-center'>{$row['plan']} Month/s</div></td>
                                        <td><div class='text-center'><a href='user-payment.php?id={$row['user_id']}'><button class='btn btn-success btn'><i class='fas fa-dollar-sign'></i> Make Payment</button></a></div></td>
                                        <td><div class='text-center'><button class='btn btn-danger' " . ($row['reminder'] == 1 ? "disabled" : "") . " onclick='sendReminder({$row['user_id']})'><i class='fas fa-exclamation-triangle'></i></button></div></td>
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

  <!--end-main-container-part-->

  <!--Footer-part-->
  <?php include 'includes/footer.php'; ?>
  <!--end-Footer-part-->

  <style>
    #custom-search-form {
      margin: 0;
      margin-top: 5px;
      padding: 0;
    }

    #custom-search-form .search-query {
      padding-right: 3px;
      padding-right: 4px \9;
      padding-left: 3px;
      padding-left: 4px \9;
      margin-bottom: 0;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
    }

    #custom-search-form button {
      border: 0;
      background: none;
      padding: 2px 5px;
      margin-top: 2px;
      position: relative;
      left: -28px;
      margin-bottom: 0;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
    }

    .search-query:focus+button {
      z-index: 3;
    }
  </style>

  <script>
    function sendReminder(userId) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You are about to send a reminder!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, send it!',
        customClass: {
          container: 'custom-alert'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: 'sendReminder.php',
            type: 'GET',
            data: {
              id: userId
            },
            success: function(response) {
              Swal.fire({
                title: 'Sent!',
                text: "Notification has been sent.",
                icon: 'success',
                customClass: {
                  container: 'custom-alert'
                }
              }).then(() => {
                window.location.href = "payment.php";
              });
            },
            error: function() {
              Swal.fire(
                'Error!',
                'Failed to send the notification.',
                'error'
              );
            }
          });
        }
      });
    }
  </script>
</body>

</html>