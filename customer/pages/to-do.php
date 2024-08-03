<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
  header('location:../index.php');
  exit(); // Add exit to stop script execution after redirecting
}

// Assuming $userid is retrieved from session or any other source
$userid = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PSO Inventory | Request</title>
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
</head>

<style>
  .resizable-container {
    position: relative;
    display: inline-block;
  }

  #resizable-input {
    width: 100%;
    padding: 5px;
    box-sizing: border-box;
  }

  .resize-handle {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 10px;
    height: 10px;
    background: #333;
    cursor: nwse-resize;
  }
</style>

<body>

  <!--Header-part-->

  <!--close-Header-part-->

  <!--top-Header-menu-->
  <?php include '../includes/topheader.php' ?>
  <!--close-top-Header-menu-->

  <!--sidebar-menu-->
  <?php $page = "todo";
  include '../includes/sidebar.php' ?>

  <!--sidebar-menu-->

  <!--main-container-part-->
  <div id="content">
    <div id="content-header">
      <div id="breadcrumb">
        <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon icon-home"></i> Home</a>
        <a href="#" class="current">Relocation Request</a>
      </div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
      <h1 class="text-center">Submit a Request <i class="fas fa-file"></i></h1>
      <hr>
      <!--End-Action boxes-->

      <div class="row-fluid">

        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-pencil"></i> </span>
              <h5>Request for Relocation of Product or Supply</h5>
            </div>
            <div class="widget-content nopadding">
              <form id="form-wizard" class="form-horizontal" action="add-to-do.php" method="POST">
                <div id="form-wizard-1" class="step">

                  <div class="control-group">
                    <label class="control-label">Office Requesting :</label>
                    <div class="controls">
                      <input type="text" class="span11" name="task_desc" placeholder="CECS Office . . ." />
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Enter where the product will be relocated :</label>
                    <div class="controls">
                      <input type="text" class="span11" name="task_desc" placeholder="To Library . . ." />
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Description :</label>
                    <div class="controls">
                      <div class="resizable-container">
                        <input type="text" id="resizable-input" class="span11" name="task_desc" placeholder="As detailed as possible ..." />
                        <div class="resize-handle"></div>
                      </div>
                    </div>
                  </div>

                  <!--comment
                  <div class="control-group">
                    <label class="control-label">Please Select a Status:</label>
                    <div class="controls">
                      <select name="task_status" required="required" id="select">
                        <option value="In Progress">In Progress</option>
                        <option value="Pending">Pending</option>
                      </select>
                    </div>
                  </div>
                  -->

                  <div class="form-actions text-center">
                    <!-- HIDDEN USERID -->
                    <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                    <input id="add" class="btn btn-success" type="submit" value="Submit" />
                    <div id="status"></div>
                  </div>

                  <div id="submitted"></div>
              </form>
            </div><!--end of widget-content -->
          </div><!--end of widget box-->
        </div><!--end of span 12 -->

      </div><!-- End of row-fluid -->
    </div><!-- End of container-fluid -->
  </div><!-- End of content-ID -->
  </div>
  <!--end-main-container-part-->

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

  <script>
    document.addEventListener('DOMContentLoaded', (event) => {
      const handle = document.querySelector('.resize-handle');
      const container = document.querySelector('.resizable-container');
      const input = document.getElementById('resizable-input');

      let startX, startY, startWidth, startHeight;

      handle.addEventListener('mousedown', (e) => {
        e.preventDefault();
        startX = e.clientX;
        startY = e.clientY;
        startWidth = parseFloat(getComputedStyle(input, null).width.replace('px', ''));
        startHeight = parseFloat(getComputedStyle(input, null).height.replace('px', ''));

        document.addEventListener('mousemove', handleMouseMove);
        document.addEventListener('mouseup', handleMouseUp);
      });

      function handleMouseMove(e) {
        const width = startWidth + (e.clientX - startX);
        const height = startHeight + (e.clientY - startY);

        input.style.width = width + 'px';
        input.style.height = height + 'px';
      }

      function handleMouseUp() {
        document.removeEventListener('mousemove', handleMouseMove);
        document.removeEventListener('mouseup', handleMouseUp);
      }
    });
  </script>

</body>

</html>