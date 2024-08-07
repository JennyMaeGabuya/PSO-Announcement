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
  <title>PSO Staff</title>
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
</head>

<body>

  <!--top-Header-menu-->
  <?php include '../includes/header.php' ?>
  <!--close-top-Header-menu-->

  <!--sidebar-menu-->
  <?php $page = "equipment";
  include '../includes/sidebar.php' ?>
  <!--sidebar-menu-->

  <div id="content">
    <div id="content-header">
      <div id="breadcrumb">
        <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="#" class="current">Product List</a>
      </div>
    </div>

    <div class="container-fluid">
      <h1 class="text-center">Product List <i class="icon icon-cogs"></i></h1>
      <hr>
      <div class="row-fluid">
        <div class="span12">

          <div class='widget-box'>
            <div class='widget-title'> <span class='icon'> <i class='icon-cogs'></i> </span>
              <h5>Product Table</h5>
            </div>
            <div class='widget-content nopadding'>

              <?php
              include "dbcon.php";

              // Select equipment and order by purchase date in descending order
              $qry = "SELECT * FROM equipment ORDER BY date DESC";
              $result = mysqli_query($conn, $qry);

              if ($result) {
                $total_products = mysqli_num_rows($result); // Get the total number of products
                $cnt = $total_products;

                echo "<table class='table table-bordered table-striped'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th>Amount</th>
                                        <th>Vendor</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Purchased Date</th>
                                    </tr>
                                </thead>
                                <tbody>";

                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>
                                    <td><div class='text-center'>" . $cnt . "</div></td>
                                    <td><div class='text-center'>" . $row['name'] . "</div></td>
                                    <td><div class='text-center'>" . $row['description'] . "</div></td>
                                    <td><div class='text-center'>" . $row['quantity'] . "</div></td>
                                    <td><div class='text-center'>$" . $row['amount'] . "</div></td>
                                    <td><div class='text-center'>" . $row['vendor'] . "</div></td>
                                    <td><div class='text-center'>" . $row['address'] . "</div></td>
                                    <td><div class='text-center'>" . $row['contact'] . "</div></td>
                                    <td><div class='text-center'>" . $row['date'] . "</div></td>
                                    </tr>";
                  $cnt--;
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

  <!--Footer-part-->
  <?php include '../includes/footer.php'; ?>
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