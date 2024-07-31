<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if (!isset($_SESSION['user_id'])) {
  header('location:../index.php');
}
include "dbcon.php";
$qry = "SELECT services, count(*) as number FROM members GROUP BY services";
$result = mysqli_query($con, $qry);
$qry = "SELECT gender, count(*) as enumber FROM members GROUP BY gender";
$result3 = mysqli_query($con, $qry);
$qry = "SELECT designation, count(*) as snumber FROM staffs GROUP BY designation";
$result5 = mysqli_query($con, $qry);
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <title>PSO Inventory System Admin</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/bootstrap.min.css" />
  <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="../css/fullcalendar.css" />
  <link rel="stylesheet" href="../css/matrix-style.css" />
  <link rel="stylesheet" href="../css/matrix-media.css" />
  <link href="../font-awesome/css/all.css" rel="stylesheet" />
  <link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/jquery.gritter.css" />
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

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Services', 'Number'],
        <?php
        while ($row = mysqli_fetch_array($result)) {
          echo "['" . $row["services"] . "', " . $row["number"] . "],";
        }
        ?>
      ]);
      var options = {
        //is3D:true,  
        pieHole: 0.4,

      };
      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
    }
  </script>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawStuff);

    function drawStuff() {
      var data = new google.visualization.arrayToDataTable([
        ['Services', 'Total Numbers'],
        // ["King's pawn (e4)", 44],
        // ["Queen's pawn (d4)", 31],
        // ["Knight to King 3 (Nf3)", 12],
        // ["Queen's bishop pawn (c4)", 10],
        // ['Other', 3]

        <?php
        $query = "SELECT services, count(*) as number FROM members GROUP BY services";
        $res = mysqli_query($con, $query);
        while ($data = mysqli_fetch_array($res)) {
          $services = $data['services'];
          $number = $data['number'];
        ?>['<?php echo $services; ?>', <?php echo $number; ?>],
        <?php
        }
        ?>
      ]);

      var options = {
        // title: 'Chess opening moves',
        width: 710,
        legend: {
          position: 'none'
        },
        // chart: { title: 'Chess opening moves',
        //          subtitle: 'popularity by percentage' },
        bars: 'vertical', // Required for Material Bar Charts.
        axes: {
          x: {
            0: {
              side: 'top',
              label: 'Total'
            } // Top x-axis.
          }
        },
        bar: {
          groupWidth: "100%"
        }
      };

      var chart = new google.charts.Bar(document.getElementById('top_x_div'));
      chart.draw(data, options);
    };
  </script>

  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawStuff);

    function drawStuff() {
      var data = new google.visualization.arrayToDataTable([
        ['Terms', 'Total Amount', ],

        <?php
        $query1 = "SELECT gender, SUM(amount) as numberone FROM members; ";

        $rezz = mysqli_query($con, $query1);
        while ($data = mysqli_fetch_array($rezz)) {
          $services = 'Earnings';
          $numberone = $data['numberone'];
          // $numbertwo=$data['numbertwo'];
        ?>['<?php echo $services; ?>', <?php echo $numberone; ?>, ],
        <?php
        }
        ?>

        <?php
        $query10 = "SELECT quantity, SUM(amount) as numbert FROM equipment";
        $res1000 = mysqli_query($con, $query10);
        while ($data = mysqli_fetch_array($res1000)) {
          $expenses = 'Expenses';
          $numbert = $data['numbert'];

        ?>['<?php echo $expenses; ?>', <?php echo $numbert; ?>, ],
        <?php
        }
        ?>

      ]);

      var options = {

        width: "1050",
        legend: {
          position: 'none'
        },

        bars: 'horizontal', // Required for Material Bar Charts.
        axes: {
          x: {
            0: {
              side: 'top',
              label: 'Total'
            } // Top x-axis.
          }
        },
        bar: {
          groupWidth: "100%"
        }
      };

      var chart = new google.charts.Bar(document.getElementById('top_y_div'));
      chart.draw(data, options);
    };
  </script>

  <script type="text/javascript">
    google.charts.load("current", {
      packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Gender', 'Number'],
        <?php
        while ($row = mysqli_fetch_array($result3)) {
          echo "['" . $row["gender"] . "', " . $row["enumber"] . "],";
        }
        ?>
      ]);

      var options = {

        pieHole: 0.4,
      };

      var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
      chart.draw(data, options);
    }
  </script>

  <script>
    google.charts.load("current", {
      packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Designation', 'Number'],
        <?php
        while ($row = mysqli_fetch_array($result5)) {
          echo "['" . $row["designation"] . "', " . $row["snumber"] . "],";
        }
        ?>
      ]);

      var options = {

        pieHole: 0.4,
      };

      var chart = new google.visualization.PieChart(document.getElementById('donutchart2022'));
      chart.draw(data, options);
    }
  </script>
</head>

<body>

  <!--Header-part-->
  <div id="header">
    <h1><a href="dashboard.html">PSO Admin</a></h1>
  </div>
  <!--close-Header-part-->


  <!--top-Header-menu-->
  <?php include 'includes/topheader.php' ?>
  <!--close-top-Header-menu-->

  <!--sidebar-menu-->
  <?php $page = 'dashboard';
  include 'includes/sidebar.php' ?>
  <!--sidebar-menu-->

  <!--main-container-part-->
  <div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
      <div id="breadcrumb"> <a href="index.php" title="You're right here" class="tip-bottom"><i class="fa fa-home"></i> Home</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
      <div class="quick-actions_homepage">
        <ul class="quick-actions">
          <li class="bg_ls span"> <a href="index.php" style="font-size: 16px;"> <i class="fas fa-user-check"></i> <span class="label label-important"><?php include 'actions/dashboard-activecount.php' ?></span> Active Offices </a> </li>
          <li class="bg_lo span3"> <a href="members.php" style="font-size: 16px;"> <i class="fas fa-users"></i></i><span class="label label-important"><?php include 'dashboard-usercount.php' ?></span> Registered Offices</a> </li>
          <li class="bg_lg span3"> <a href="payment.php" style="font-size: 16px;"> <i class="fa fa-cog"></i></i><span class="label label-important"><?php include 'dashboard-usercount.php' ?></span> Request for Relocation </a> </li>
          <li class="bg_lb span2"> <a href="announcement.php" style="font-size: 16px;"> <i class="fas fa-bullhorn"></i><span class="label label-important"><?php include 'actions/count-announcements.php' ?></span>Announcements </a> </li>


          <!-- <li class="bg_ls span2"> <a href="buttons.html"> <i class="fas fa-tint"></i> Buttons</a> </li>
        <li class="bg_ly span3"> <a href="form-common.html"> <i class="fas fa-th-list"></i> Forms</a> </li>
        <li class="bg_lb span2"> <a href="interface.html"> <i class="fas fa-pencil"></i>Elements</a> </li> -->
          <!-- <li class="bg_lg"> <a href="calendar.html"> <i class="fas fa-calendar"></i> Calendar</a> </li>
        <li class="bg_lr"> <a href="error404.html"> <i class="fas fa-info-sign"></i> Error</a> </li> -->
          <!-- Visit codeastro.com for more projects -->
        </ul>
      </div>
      <!--End-Action boxes-->

      <div class="row-fluid">
        <div class="span6">
          <div class="widget-box">
            <div class="widget-title bg_ly" href="#collapseG2"><span class="icon"><i class="fas fa-chevron-down"></i></span>
              <h5>Active and Inactive Accounts: Overview</h5>
            </div>
            <div class="widget-content nopadding collapse in" id="collapseG2">
              <ul class="recent-posts">

                <div id="donutchart" style="width: 600px; height: 300px;"></div>

              </ul>
            </div>
          </div>
        </div>

        <div class="span6">
          <div class="widget-box">
            <div class="widget-title bg_ly" href="#collapseG2"><span class="icon"><i class="fas fa-chevron-down"></i></span>
              <h5>Useful Life Statuses: Overview</h5>
            </div>
            <div class="widget-content nopadding collapse in" id="collapseG2">
              <ul class="recent-posts">

                <div id="donutchart2022" style="width: 600px; height: 300px;"></div>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!--End-Chart-box-->
      <!-- <hr/> -->

      <div class="container-fluid" style="margin-top: -20px;">
        <div class="row-fluid">
          <!-- Product and Supply Announcements -->
          <div class="span6 custom-container">
            <div class="widget-box">
              <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2">
                <span class="icon"><i class="fas fa-chevron-down"></i></span>
                <h5>Product and Supply Office Announcements</h5>
              </div>
              <div class="widget-content nopadding collapse in" id="collapseG2">
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
                  echo "<img class='img-responsive zoom-img' width='50' height='50' alt='Alert' src='http://localhost/gym%20system/img/demo/alert.png'> ";
                  echo "</div>"; // Close the user-thumb div

                  // Start the div for announcement content
                  echo "<div style='overflow: hidden;'>"; // Adjust styling here
                  echo "<span class='user-info'> By: System Administrator / Date: " . $row['date'] . " </span>";
                  echo "<p><a href='#' style='$messageStyle'>" . $message . "</a> </p>";
                  echo "</div>"; // Close the announcement content div

                  echo "</div>"; // Close the article-post div
                }

                ?>

                <a href="manage-announcement.php"><button class="btn btn-warning btn-mini" style="margin: 10px;">View All</button></a>
                </li>
                </ul>

              </div>
            </div>
          </div>

          <!-- Reminders Section -->
          <div class="span6 custom-container">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"><i class="fas fa-tasks"></i></span>
                <h5>Request for Relocation</h5>
              </div>
              <div class="widget-content">
                <div class="todo">
                  <ul>
                    <?php
                    include "dbcon.php";
                    $qry = "SELECT * FROM todo";
                    $result = mysqli_query($con, $qry);

                    while ($row = mysqli_fetch_array($result)) { ?>
                      <li class='clearfix'>
                        <div class='txt'> <?php echo $row["task_desc"] ?> <?php if ($row["task_status"] == "Pending") {
                                                                            echo '<span class="by label label-info">Pending</span>';
                                                                          } else {
                                                                            echo '<span class="by label label-success">In Progress</span>';
                                                                          } ?></div>
                      <?php }
                    echo "</li>";
                    echo "</ul>";
                      ?>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- End of row -->
      </div><!-- End of container-fluid -->

    </div><!-- End of container-fluid -->
  </div><!-- End of content-ID -->

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