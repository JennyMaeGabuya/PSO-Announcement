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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link href="../font-awesome/css/all.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/jquery.gritter.css" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>

<body>

  <!--top-Header-menu-->
  <?php include 'includes/topheader.php' ?>
  <!--close-top-Header-menu-->

  <!--sidebar-menu-->
  <?php $page = 'announcement';
  include 'includes/sidebar.php' ?>
  <!--sidebar-menu-->

  <!-- Main Content -->
  <div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
        <a href="announcement.php" class="current">Announcements</a>
      </div>
    </div>

    <div class="container-fluid">
      <h1 class="text-center">Announcement <i class="fas fa-bullhorn"></i></h1>
      <hr>
      <a href="manage-announcement.php"><button class="btn btn-danger" type="button">Manage Your Announcements</button></a>
      <div class="row-fluid">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
            <h5>Make Announcements</h5>
          </div>

          <div class="widget-content">
            <div class="control-group">
              <form id="announcement-form" action="post-announcement.php" method="POST">
                <div class="controls">
                  <select name="target_audience" class="span12" required>
                    <option value="" disabled selected>Announcement for...</option>
                    <option value="All">All</option>
                    <option value="User">User</option>
                    <option value="Staff">Staff</option>
                  </select>
                </div>
                <div class="controls">
                  <input type="text" class="span12" name="subject" placeholder="Subject" required>
                </div>
                <div class="controls">
                  <textarea class="span12" name="message" rows="6" placeholder="Enter message ..." required></textarea>
                </div>
                <div class="controls">
                  <h5><label for="Announce Date">Applied Date:
                      <input type="date" name="date" required></h5></label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-info">Publish Now</button>
                </div>
              </form>
            </div>
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

  <script src="../js/excanvas.min.js"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery.ui.custom.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.flot.min.js"></script>
  <script src="../js/jquery.flot.resize.min.js"></script>
  <script src="../js/jquery.peity.min.js"></script>
  <script src="../js/matrix.js"></script>
  <script src="../js/matrix.dashboard.js"></script>
  <script src="../js/jquery.gritter.min.js"></script>
  <script src="../js/matrix.interface.js"></script>
  <script src="../js/matrix.chat.js"></script>
  <script src="../js/jquery.validate.js"></script>
  <script src="../js/select2.min.js"></script>
  <script src="../js/matrix.popover.js"></script>
  <script src="../js/jquery.dataTables.min.js"></script>
  <script src="../js/matrix.tables.js"></script>
  <script src="../js/wysihtml5-0.3.0.js"></script>
  <script src="../js/bootstrap-wysihtml5.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.getElementById('announcement-form').addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent the form from submitting immediately

      Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to publish this announcement?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, publish it!'
      }).then((result) => {
        if (result.isConfirmed) {
          // Create a FormData object
          const formData = new FormData(this);

          // Send the form data using Fetch API
          fetch(this.action, {
              method: 'POST',
              body: formData
            })
            .then(response => response.json())
            .then(data => {
              if (data.status === 'success') {
                Swal.fire({
                  title: 'Published!',
                  text: 'Your announcement has been published successfully.',
                  icon: 'success',
                  confirmButtonText: 'OK'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = 'index.php';
                  }
                });
              } else {
                Swal.fire({
                  title: 'Error!',
                  text: 'An error occurred. Please try again.',
                  icon: 'error',
                  confirmButtonText: 'OK'
                });
              }
            })
            .catch(error => {
              console.error('Error:', error); // Log error to the console for debugging
              Swal.fire({
                title: 'Error!',
                text: 'An unexpected error occurred. Please try again.',
                icon: 'error',
                confirmButtonText: 'OK'
              });
            });
        }
      });
    });
  </script>

</body>

</html>