<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();
}

include 'dbcon.php';

// Use the logged-in user's ID
$id = $_SESSION['user_id'];

$qry = "SELECT * FROM members WHERE user_id='$id'";
$result = mysqli_query($con, $qry);

// Check if the query was successful and if any rows were returned
if (!$result || mysqli_num_rows($result) == 0) {
    echo "Error: No records found.";
    exit();
}

$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>PSO Inventory System | My Profile</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="../css/fullcalendar.css" />
    <link rel="stylesheet" href="../css/matrix-style.css" />
    <link rel="stylesheet" href="../css/matrix-media.css" />
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/jquery.gritter.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        <?php include '../includes/topheader.php'; ?>

        <!-- Include sidebar -->
        <?php
        $page = 'my-profile';
        include '../includes/sidebar.php';
        ?>

        <!-- Main content -->
        <div id="content">
            <div id="content-header">
                <div id="breadcrumb">
                    <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon icon-home"></i> Home</a>
                    <a href="#" class="current">My Profile</a>
                </div>
            </div>
            <div class="container-fluid">
                <h1 class="text-center">Profile Details <i class="fas fa-info-circle"></i></h1>
                <hr>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon"><i class="fas fa-align-justify"></i></span>
                                <h5>Personal and Contact Info</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <form action="edit-my-profile.php" method="POST" class="form-horizontal" enctype="multipart/form-data">

                                    <div class="control-group">
                                        <div class="controls">
                                            <img id="profile-picture" src="../img/profile_picture/<?php echo htmlspecialchars($row['profile_picture']); ?>" alt="Profile Picture" />
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
                                            <input type="text" class="span11" name="fullname" value='<?php echo htmlspecialchars($row['fullname']); ?>' />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Username :</label>
                                        <div class="controls">
                                            <input type="text" class="span11" name="username" value='<?php echo htmlspecialchars($row['username']); ?>' />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Password :</label>
                                        <div class="controls">
                                            <input type="password" class="span11" name="password" disabled="" placeholder="**********" />
                                            <span class="help-block">Note: Change password regularly only if it is necessary.</span>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Gender :</label>
                                        <div class="controls">
                                            <select name="gender" required="required" id="select">
                                                <option value="Male" <?php echo $row['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                                                <option value="Female" <?php echo $row['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                                                <option value="Other" <?php echo $row['gender'] == 'Other' ? 'selected' : ''; ?>>Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">D.O.R :</label>
                                        <div class="controls">
                                            <input type="date" name="dor" class="span11" readonly value='<?php echo htmlspecialchars($row['dor']); ?>' />
                                            <span class="help-block">Date of Registration</span>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Email :</label>
                                        <div class="controls">
                                            <input type="email" class="span11" name="email" value='<?php echo htmlspecialchars($row['email']); ?>' />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="contact" class="control-label">Contact Number :</label>
                                        <div class="controls">
                                            <input type="number" id="contact" name="contact" value='<?php echo htmlspecialchars($row['contact']); ?>' class="span11 mask text" maxlength="11" pattern="\d{11}" placeholder="Enter 11-digit number" title="Please enter a 11-digit number" />
                                            <span class="help-block">(+63) 999-999-9999</span>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Address :</label>
                                        <div class="controls">
                                            <input type="text" class="span11" name="address" value='<?php echo htmlspecialchars($row['address']); ?>' />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Access Type :</label>
                                        <div class="controls">
                                            <input type="text" disabled="" value='User-Default Access' class="span11" />
                                        </div>
                                    </div>

                                    <div class="form-actions text-center">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['user_id']); ?>">
                                        <button type="submit" class="btn btn-success">Update Details</button>
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
            <?php include '../includes/footer.php'; ?>
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