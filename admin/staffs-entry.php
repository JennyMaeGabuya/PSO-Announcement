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
  <style>
    #footer {
      padding: 5px;
      text-align: center;
    }

    #profile-picture {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      margin-top: 5px;
    }

    .error-message {
      color: red;
      font-weight: bold;
      font-size: 13px;
      margin-top: 5px;
    }
  </style>
</head>

<body>

  <div id="wrapper">
    <!-- Include header -->
    <?php include 'includes/topheader.php'; ?>

    <!-- Include sidebar -->
    <?php
    $page = 'staff-management';
    include 'includes/sidebar.php';
    ?>

    <!-- Main content -->
    <div id="content">
      <div id="content-header">
        <div id="breadcrumb">
          <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
          <a href="staffs.php">Staffs</a>
          <a href="#" class="current">Staff Entry</a>
        </div>
      </div>
      <div class="container-fluid">
        <h1 class="text-center">Staff Entry Form <i class="fas fa-briefcase"></i></h1>
        <hr>
        <div class="row-fluid">
          <div class="span12">
            <div class="widget-box">
              <div class="widget-title">
                <span class="icon"><i class="fas fa-align-justify"></i></span>
                <h5>Staff Details</h5>
              </div>
              <div class="widget-content nopadding">
                <form action="added-staffs.php" method="POST" class="form-horizontal" enctype="multipart/form-data">

                  <div class="control-group">
                    <div class="controls">
                      <img id="profile-picture" src="profile_image/default.png" alt="Profile Picture" />
                      <div id="error-message" class="error-message"></div>
                    </div>
                    <label class="control-label">Profile Picture :</label>
                    <div class="controls">
                      <input type="file" class="span11" name="profile" id="profile-input" />
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Full Name :</label>
                    <div class="controls">
                      <input type="text" class="span11" name="fullname" placeholder="Full Name" required />
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Username :</label>
                    <div class="controls">
                      <input type="text" class="span11" name="username" placeholder="Username" required />
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Email :</label>
                    <div class="controls">
                      <input type="email" class="span11" name="email" placeholder="Email" required />
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Password :</label>
                    <div class="controls">
                      <input type="password" class="span11" name="password" placeholder="**********" required />
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Confirm Password :</label>
                    <div class="controls">
                      <input type="password" class="span11" name="password2" placeholder="**********" required />
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Gender :</label>
                    <div class="controls">
                      <select name="gender" required="required" id="select" class="span11">
                        <option value="" disabled selected>Select gender...</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                      </select>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Contact Number :</label>
                    <div class="controls">
                      <input type="number" class="span11" name="contact" placeholder="Contact Number" required />
                      <span class="help-block">(999) 999-9999</span>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Address :</label>
                    <div class="controls">
                      <input type="text" class="span11" name="address" placeholder="Address" required />
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Designation :</label>
                    <div class="controls">
                      <select name="designation" class="span11" required>
                        <option value="Cashier">Cashier</option>
                        <option value="Trainer">Trainer</option>
                        <option value="GYM Assistant">GYM Assistant</option>
                        <option value="Front Desk Staff">Front Desk Staff</option>
                        <option value="Manager">Manager</option>
                      </select>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Account Status :</label>
                    <div class="controls">
                      <select name="status" class="span11" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                      </select>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">D.O.R :</label>
                    <div class="controls">
                      <input type="date" name="dor" class="span11" />
                      <span class="help-block">Date of Registration</span>
                    </div>
                  </div>

                  <div class="form-actions text-center">
                    <button type="submit" class="btn btn-success">Submit Staff Details</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Footer -->
    <div id="footer">
      <?php include 'includes/footer.php'; ?>
    </div>
  </div>

  <!-- Scripts -->
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/matrix.js"></script>
  <script src="../js/excanvas.min.js"></script>
  <script src="../js/jquery.ui.custom.js"></script>
  <script src="../js/jquery.flot.min.js"></script>
  <script src="../js/jquery.flot.resize.min.js"></script>
  <script src="../js/jquery.peity.min.js"></script>
  <script src="../js/fullcalendar.min.js"></script>
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

  <script>
    document.getElementById('profile-input').addEventListener('change', function(event) {
      var file = event.target.files[0];
      var errorMessage = document.getElementById('error-message');

      // Clear previous error message
      errorMessage.textContent = '';

      if (file) {
        // Check file type
        var allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
          errorMessage.textContent = 'Only image files (JPG, PNG, GIF) are allowed.';
          event.target.value = ''; // Clear the input
          document.getElementById('profile-picture').src = ''; // Clear the preview
          return;
        }

        // Check file size
        if (file.size > 5 * 1024 * 1024) { // Check if file size is greater than 5MB
          errorMessage.textContent = 'File size must be less than 5MB.';
          event.target.value = ''; // Clear the input 
          document.getElementById('profile-picture').src = ''; // Clear the preview
          return;
        }

        // Preview the image
        var reader = new FileReader();
        reader.onload = function() {
          var img = document.getElementById('profile-picture');
          img.src = reader.result;
        };
        reader.readAsDataURL(file);
      }
    });
  </script>
</body>

</html>